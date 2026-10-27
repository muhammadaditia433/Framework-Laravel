<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->get();

        return view('authors.index', ['authors' => $authors]);
    }
}
