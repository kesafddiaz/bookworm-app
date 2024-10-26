@extends('layouts.app')
@section('title', 'Publisher')

@section('content')
        <div class="container-fluid mx-4">
            <section class="mt-4">
                <h2>Daftar Buku</h2>
                <br><table class="table">
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Genre</th>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>{{ $book->tahun }}</td>
                                <td>Rp{{ $book->harga }}</td>
                                <td>{{ $book->stok }}</td>
                                <td>{{ $book->publisher->nama }}</td>
                                <td>{{ $book->genres->pluck('nama')->implode (', ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('products') }}" class="icon-link" id="kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </section>
        </div>
@endsection