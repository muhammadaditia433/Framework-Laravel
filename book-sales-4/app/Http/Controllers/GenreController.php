<?php

namespace App\Http\Controllers;

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
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $genre = Genre::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data genre berhasil ditambahkan',
            'data'    => $genre,
        ], 201);
    }
}
