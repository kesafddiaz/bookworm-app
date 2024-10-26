<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::all();
        return view('publisher', compact('publishers'));
    }

    public function list($publisherId)
    {
        $publisher = Publisher::find($publisherId);
        return view('publisherBookList', compact('publisher'));
    }

    public function search(Request $request)
    {
        $nama = $request->nama;
        $publishers = Publisher::where('nama', 'like', "%$nama%")->get();
        return view('publisherSearch', compact('publishers'));
    }
}
