<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // GET /api/authors : tampilkan semua data author
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar data author',
            'data'    => Author::all(),
        ]);
    }

    // POST /api/authors : tambah data author
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            'bio'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $author = Author::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil ditambahkan',
            'data'    => $author,
        ], 201);
    }

    // GET /api/authors/{author} : tampilkan satu data author
    public function show($id): JsonResponse
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->notFound();
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data author',
            'data'    => $author,
        ]);
    }

    // PUT/PATCH /api/authors/{author} : ubah data author
    public function update(Request $request, $id): JsonResponse
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->notFound();
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            'bio'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $author->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil diubah',
            'data'    => $author,
        ]);
    }

    // DELETE /api/authors/{author} : hapus data author
    public function destroy($id): JsonResponse
    {
        $author = Author::find($id);

        if (!$author) {
            return $this->notFound();
        }

        // Author yang masih memiliki buku tidak boleh dihapus.
        if ($author->books()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Author tidak dapat dihapus karena masih memiliki buku',
                'data'    => null,
            ], 409);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil dihapus',
            'data'    => null,
        ]);
    }

    private function notFound(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Author tidak ditemukan',
            'data'    => null,
        ], 404);
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
