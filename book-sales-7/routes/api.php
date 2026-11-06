<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
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
// 2. Genre dan Author: Read All dan Show bisa diakses semua orang
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
    // 4. Khusus ADMIN
    // -----------------------------------------------------------
    Route::middleware(AdminMiddleware::class)->group(function () {
        // Genre dan Author: Create, Update, Destroy
        Route::apiResource('genres', GenreController::class)->except(['index', 'show']);
        Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);

        // Transaksi: Read All dan Destroy
        Route::apiResource('transactions', TransactionController::class)->only(['index', 'destroy']);
    });

    // -----------------------------------------------------------
    // 5. Khusus CUSTOMER (yang sudah login)
    // -----------------------------------------------------------
    Route::middleware(CustomerMiddleware::class)->group(function () {
        // Transaksi: Create, Update, Show
        Route::apiResource('transactions', TransactionController::class)->only(['store', 'update', 'show']);
    });
});
