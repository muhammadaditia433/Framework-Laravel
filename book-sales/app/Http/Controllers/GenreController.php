<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        return view('genres.index', ['genres' => Genre::all()]);
    }

    public function show(int $id)
    {
        $genre = Genre::find($id);
        abort_if(is_null($genre), 404);

        return view('genres.show', ['genre' => $genre]);
    }
}
