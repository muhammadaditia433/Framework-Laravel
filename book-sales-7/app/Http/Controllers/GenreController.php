<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // GET /api/genres : tampilkan semua data genre
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar data genre',
            'data'    => Genre::all(),
        ]);
    }

    // POST /api/genres : tambah data genre
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $genre = Genre::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil ditambahkan',
            'data'    => $genre,
        ], 201);
    }

    // GET /api/genres/{genre} : tampilkan satu data genre
    public function show($id): JsonResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return $this->notFound();
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data genre',
            'data'    => $genre,
        ]);
    }

    // PUT/PATCH /api/genres/{genre} : ubah data genre
    public function update(Request $request, $id): JsonResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return $this->notFound();
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $genre->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil diubah',
            'data'    => $genre,
        ]);
    }

    // DELETE /api/genres/{genre} : hapus data genre
    public function destroy($id): JsonResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return $this->notFound();
        }

        // Genre yang masih dipakai oleh buku tidak boleh dihapus.
        if (Book::where('genre_id', $genre->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak dapat dihapus karena masih dipakai oleh buku',
                'data'    => null,
            ], 409);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil dihapus',
            'data'    => null,
        ]);
    }

    private function notFound(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Genre tidak ditemukan',
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
