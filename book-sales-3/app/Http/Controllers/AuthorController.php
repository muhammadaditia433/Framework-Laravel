<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    // GET /api/authors
    public function index(): JsonResponse
    {
        $authors = Author::withCount('books')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data author',
            'data'    => $authors,
        ]);
    }

    // GET /api/authors/{id}
    public function show(int $id): JsonResponse
    {
        $author = Author::with('books')->find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Author tidak ditemukan',
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data author',
            'data'    => $author,
        ]);
    }
}
