<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/books'));

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
