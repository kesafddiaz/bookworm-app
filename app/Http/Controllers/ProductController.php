<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $books = Book::all();
        
        return view('product', compact('books'));
    }

    public function insert(Request $request)
    {
        $publisher = Publisher::firstOrCreate([
            'nama' => $request->penerbit
        ]);

        $path = null;
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('img', 'public');
        }

        $book = Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'penerbit' => $publisher->id,
            'image' => $path
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

        $path = null;
        if ($request->hasFile('cover')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $path = $request->file('cover')->store('images', 'public');
        } else {
            $path = $book->image;
        }
        // dd($path);
        $publisher = Publisher::firstOrCreate([
            'nama' => $request->penerbit
        ]);
        
        $book->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'penerbit' => $publisher->id,
            'image' => $path
        ]);

        $genreNames = array_map('trim', explode(',', $request->genre));
        $genres = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['nama' => $genreName]);
            $genres[] = $genre->id;
        }
        $book->genres()->sync($genres);
        // dd($book);
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
