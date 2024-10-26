@extends('layouts.app')
@section('title', 'Publisher')

@section('content')
        <div class="container-fluid mx-4">
            <section class="mt-4">
                <h2>Daftar Buku dari Penerbit Ini</h2>
                <h4>{{ $publisher->nama }}</h4>
                <br>
                <table class="table">
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Buku</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Tahun</th>
                    </thead>
                    <tbody>
                        @foreach($publisher->books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>{{ $book->tahun }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('publishers') }}" class="icon-link" id="kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </section>
        </div>
@endsection