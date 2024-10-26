<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Genre;

class ProductController extends Controller
{
    public function index()
    {
        $books = Book::all();
        
        return view('product', compact('books'));
    }

    public function insert(Request $request)
    {
        // dd($request);
        $publisher = Publisher::firstOrCreate([
            'nama' => $request->penerbit
        ]);

        $book = Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'penerbit' => $publisher->id
        ]);
        $genreNames = array_map('trim', explode(',', $request->genre));
        $genres = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['nama' => $genreName]);
            $genres[] = $genre->id;
        }
        $book->genres()->attach($genres);

        return redirect()->route('products')->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

        $publisher = Publisher::firstOrCreate([
            'nama' => $request->penerbit
        ]);

        $genreNames = array_map('trim', explode(',', $request->genre));
        $genres = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['nama' => $genreName]);
            $genres[] = $genre->id;
        }
        $book->genres()->sync($genres);

        return redirect()->route('products')->with('success', 'Buku berhasil diubah');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('products')->with('success', 'Buku berhasil dihapus');
    }

    public function search(Request $request)
    {
        $books = Book::where('judul', 'like', '%'.$request->judul.'%')->get();

        return view('bookSearch', compact('books'));
    }
}
