<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    // GET /api/books
    public function index(): JsonResponse
    {
        $books = Book::with('author')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data buku',
            'data'    => $books,
        ]);
    }

    // GET /api/books/{id}
    public function show(int $id): JsonResponse
    {
        $book = Book::with('author')->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data buku',
            'data'    => $book,
        ]);
    }
}
