<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Semua route di file ini otomatis berawalan /api

// ---------------------------------------------------------------
// 1. Autentikasi (bebas diakses)
// ---------------------------------------------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Dibutuhkan oleh middleware auth: jika belum login, Laravel mengarahkan ke route
// bernama "login". Route ini membalas JSON 401 supaya tidak muncul error HTML.
Route::get('/login', function () {
    return response()->json([
        'success' => false,
        'message' => 'Silakan login terlebih dahulu',
        'data'    => null,
    ], 401);
})->name('login');

// ---------------------------------------------------------------
// 2. Read All dan Show: bisa diakses SEMUA ORANG (tanpa login)
// ---------------------------------------------------------------
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);

// ---------------------------------------------------------------
// 3. Wajib login (token)
// ---------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // -----------------------------------------------------------
    // 4. Create, Update, Destroy: HANYA ADMIN
    // -----------------------------------------------------------
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::apiResource('genres', GenreController::class)->except(['index', 'show']);
        Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
    });
});
