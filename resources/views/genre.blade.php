@extends('layouts.app')
@section('title', 'Publisher')

@section('content')
        <div class="container-fluid mx-4">
            <section class="mt-4">
                <h2>Daftar Genre</h2>
                <div class="container-fluid my-4">
                    <form action="{{ route('genres.search') }}" method="GET">
                        <span class="input-group">
                            <label class="me-2" for="searchGenre">Cari Genre: </label>
                            <input type="text" class="form-control" id="searchGenre" name="nama">
                            <button type="submit" class="btn btn-outline-secondary bg-primary text-primary-emphasis">
                                <i class="bi bi-search text-light"></i>
                            </button>
                        </span>
                    </form>
                </div>
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
            </section>
        </div>
@endsection