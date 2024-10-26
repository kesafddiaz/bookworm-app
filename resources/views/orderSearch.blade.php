@extends('layouts.app')
@section('title', 'Publisher')

@section('content')
        <div class="container-fluid mx-4">
            <section class="mt-4">
                <h2>Daftar Order</h2>
                <table class="table">
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->nama }}</td>
                                <td>{{ $order->tanggal }}</td>
                                <td>Rp{{ $order->grandTotal }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('orders.add', ['order'=>$order->id]) }}" class="icon-link" id="edit">
                                            <i class="bi bi-pencil text-warning"></i>
                                            Edit
                                        </a>
                                        <form class="mb-0" action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="icon-link btn btn-link" id="delete">
                                                <i class="bi bi-trash text-danger"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('orders') }}" class="icon-link" id="kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
            </section>
        </div>
@endsection