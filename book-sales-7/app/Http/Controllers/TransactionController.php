<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // GET /api/transactions : Read All (hanya admin)
    public function index(): JsonResponse
    {
        $transactions = Transaction::with(['customer:id,name,email', 'book:id,title,price'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data transaksi',
            'data'    => $transactions,
        ]);
    }

    // POST /api/transactions : Create (hanya customer)
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|integer|exists:books,id',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $book = Book::find($request->book_id);

        $transaction = Transaction::create([
            'order_number' => 'TRX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'customer_id'  => $request->user()->id, // diambil dari user yang login
            'book_id'      => $book->id,
            'total_amount' => $book->price,
        ]);

        $transaction->load(['customer:id,name,email', 'book:id,title,price']);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'data'    => $transaction,
        ], 201);
    }

    // GET /api/transactions/{transaction} : Show (hanya customer pemilik transaksi)
    public function show(Request $request, $id): JsonResponse
    {
        $transaction = Transaction::with(['customer:id,name,email', 'book:id,title,price'])->find($id);

        if (!$transaction) {
            return $this->notFound();
        }

        if ($transaction->customer_id !== $request->user()->id) {
            return $this->forbidden();
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data transaksi',
            'data'    => $transaction,
        ]);
    }

    // PUT/PATCH /api/transactions/{transaction} : Update (hanya customer pemilik transaksi)
    public function update(Request $request, $id): JsonResponse
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->notFound();
        }

        if ($transaction->customer_id !== $request->user()->id) {
            return $this->forbidden();
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|integer|exists:books,id',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $book = Book::find($request->book_id);

        $transaction->update([
            'book_id'      => $book->id,
            'total_amount' => $book->price,
        ]);

        $transaction->load(['customer:id,name,email', 'book:id,title,price']);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diubah',
            'data'    => $transaction,
        ]);
    }

    // DELETE /api/transactions/{transaction} : Destroy (hanya admin)
    public function destroy($id): JsonResponse
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->notFound();
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus',
            'data'    => null,
        ]);
    }

    private function notFound(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Transaksi tidak ditemukan',
            'data'    => null,
        ], 404);
    }

    private function forbidden(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Anda tidak berhak mengakses transaksi ini',
            'data'    => null,
        ], 403);
    }

    private function validationError($validator): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors'  => $validator->errors(),
        ], 422);
    }
}
