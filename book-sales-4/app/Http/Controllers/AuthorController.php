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
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $author = Author::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data author berhasil ditambahkan',
            'data'    => $author,
        ], 201);
    }
}
