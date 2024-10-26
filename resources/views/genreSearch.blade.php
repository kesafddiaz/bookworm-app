@extends('layouts.app')
@section('title', 'Publisher')

@section('content')
        <div class="container-fluid mx-4">
            <section class="mt-4">
                <h2>Daftar Buku</h2>
                <br>
                <table class="table">
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Genre</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($genres as $genre)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $genre->nama }}</td>
                                <td>
                                    <a href="{{ route('genres.list', ['genreId'=>$genre->id]) }}" class="icon-link" id="list">
                                        Lihat
                                        <i class="bi bi-caret-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('genres') }}" class="icon-link" id="kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </section>
        </div>
@endsection