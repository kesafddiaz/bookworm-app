@extends('layouts.app')
@section('title', 'Publisher')

@section('content')
        <div class="container-fluid mx-4">
            <section class="mt-4">
                <h2>Daftar Penerbit</h2>
                <table class="table">
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Penerbit</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($publishers as $publisher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $publisher->nama }}</td>
                                <td>
                                    <a href="{{ route('publishers.list', ['publisherId'=>$publisher->id]) }}" class="icon-link" id="list">
                                        Lihat
                                        <i class="bi bi-caret-right"></i>
                                    </a>
                                </td>
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