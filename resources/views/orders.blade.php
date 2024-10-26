@extends('layouts.app')
@section('title', 'Orders')

@section('content')
    <div class="container-fluid mx-3">
        <section class="mt-4">
            <h2>Data Order</h2>
            <div class="container-fluid my-4">
                <form action="{{ route('orders.search') }}" method="GET">
                    <span class="input-group">
                        <label class="me-2" for="searchOrder">Cari Order: </label>
                        <input type="text" class="form-control" id="searchPublisher" name="nama">
                        <button type="submit" class="btn btn-outline-secondary bg-primary text-primary-emphasis">
                            <i class="bi bi-search text-light"></i>
                        </button>
                    </span>
                </form>
            </div>
            <a href="{{ route('orders.add')}}" type="button" class="btn btn-secondary">Tambah Order</a>
            <section class="mt-4">
                @if($orders->isEmpty())
                    <p>Belum ada data order</p>
                @else
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
                                            <form class="mb-0" action="{{ route('orders.delete', ['orderId'=>$order->id])}}" method="POST">
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
                @endif
            </section>
        </section>
    </div>
@endsection