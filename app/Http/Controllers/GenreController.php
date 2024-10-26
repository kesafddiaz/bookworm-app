<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genre', compact('genres'));
    }

    public function list($genreId)
    {
        $genre = Genre::find($genreId);
        return view('genreBookList', compact('genre'));
    }

    public function search(Request $request)
    {
        $nama = $request->nama;
        $genres = Genre::where('nama', 'like', "%$nama%")->get();
        return view('genreSearch', compact('genres'));
    }
}
