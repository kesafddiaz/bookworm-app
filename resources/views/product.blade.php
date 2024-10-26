@extends('layouts.app')
@section('title', 'Products')

@section('content')
    <div class="container-fluid mx-3">
        <section class="mt-4">
            <h2>Data Buku</h2>
            <div class="container-fluid my-4">
                <form action="{{ route('products.search') }}">
                    <span class="input-group">
                        <label class="me-2" for="searchBook">Cari Buku: </label>
                        <input type="text" class="form-control" id="searchBook" name="judul">
                        <button class="btn btn-outline-secondary bg-primary text-primary-emphasis">
                            <i class="bi bi-search text-light"></i>
                        </button>
                    </span>
                </form>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">Tambah Buku</button>

            <div class="modal fade" id="tambahBukuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tambahBukuModalLabel">Tambah Buku</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex">
                            <form action="{{ route('products.insert') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label for="judul"></label>
                                    <input type="text" id="judul" name="judul" placeholder="Judul Buku">
                                </div>
                                <div class="mb-3">
                                    <label for="penulis"></label>
                                    <input type="text" id="penulis" name="penulis" placeholder="Penulis">
                                </div>
                                <div class="mb-3">
                                    <label for="tahun"></label>
                                    <input type="text" id="tahun" name="tahun" placeholder="Tahun Terbit">
                                </div>
                                <div class="mb-3">
                                    <label for="harga"></label>
                                    <input type="text" id="harga" name="harga" placeholder="Harga">
                                </div>
                                <div class="mb-3">
                                    <label for="stok"></label>
                                    <input type="text" id="stok" name="stok" placeholder="Stok">
                                </div>
                                <div class="mb-3">
                                    <label for="penerbit"></label>
                                    <input type="text" id="penerbit" name="penerbit" placeholder="Penerbit">
                                </div>
                                <div class="mb-3">
                                    <label for="genre"></label>
                                    <textarea id="genre" name="genre" placeholder="Genre, pisahkan dengan koma"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-4">
            @if($books->isEmpty())
                <p>Belum ada data buku</p>
            @else
                <table class="table">
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Aksi</th>
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
                                <td>
                                    <div class="btn-group">
                                        <button class="icon-link btn btn-link" id="edit" data-bs-toggle="modal" data-bs-target="#editBukuModal-{{ $book->id }}">
                                            <i class="bi bi-pencil text-warning"></i>
                                            Edit
                                        </button>
                                        <form class="mb-0" action="{{ route('products.destroy', $book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="icon-link btn btn-link" id="delete">
                                                <i class="bi bi-trash text-danger"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal fade" id="editBukuModal-{{ $book->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBukuModalLabel-{{ $book->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editBukuModalLabel-{{ $book->id }}">Edit Buku</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('products.update', $book->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="judul"></label>
                                                            <input type="text" id="judul" name="judul" placeholder="Judul Buku" value="{{ $book->judul}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penulis"></label>
                                                            <input type="text" id="penulis" name="penulis" placeholder="Penulis" value="{{ $book->penulis}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tahun"></label>
                                                            <input type="text" id="tahun" name="tahun" placeholder="Tahun Terbit" value="{{ $book->tahun}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="harga"></label>
                                                            <input type="text" id="harga" name="harga" placeholder="Harga" value="{{ $book->harga}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stok"></label>
                                                            <input type="text" id="stok" name="stok" placeholder="Stok" value="{{ $book->stok}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penerbit"></label>
                                                            <input type="text" id="penerbit" name="penerbit" placeholder="Penerbit" value="{{ $book->publisher->nama}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="genre"></label>
                                                            <textarea id="genre" name="genre" placeholder="Genre, pisahkan dengan koma">{{ $book->genres->pluck('nama')->implode(', ')}}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection