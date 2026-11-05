<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

// Semua route di file ini otomatis berawalan /api

// apiResource membuat 5 route sekaligus untuk tiap resource:
// GET /genres, POST /genres, GET /genres/{genre}, PUT|PATCH /genres/{genre}, DELETE /genres/{genre}
Route::apiResource('genres', GenreController::class);
Route::apiResource('authors', AuthorController::class);
