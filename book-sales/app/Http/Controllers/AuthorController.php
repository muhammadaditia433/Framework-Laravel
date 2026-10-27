<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return view('authors.index', ['authors' => Author::all()]);
    }

    public function show(int $id)
    {
        $author = Author::find($id);
        abort_if(is_null($author), 404);

        return view('authors.show', ['author' => $author]);
    }
}
