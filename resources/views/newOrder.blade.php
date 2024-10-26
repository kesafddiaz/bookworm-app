@extends('layouts.app')
@section('title', 'New Order')

@section('content')
    <div class="container-fluid mx-4">
        <section class="mt-4">
            <h2>Order Baru</h2>
            @if(!$order)
                <div class="mb-3">
                    <label for="customer">Customer</label>
                    <input type="text" id="customer" name="customer" placeholder="Nama Customer" value="">
                </div>
                <div class="mb-3">
                    <label for="date">Tanggal</label>
                    <input type="date" id="date" name="date" value="">
                </div>
            @else
                <div class="mb-3">
                    <label for="customer">Customer</label>
                    <input type="text" id="customer" name="customer" placeholder="Nama Customer" value="{{ $order->nama }}">
                </div>
                <div class="mb-3">
                    <label for="date">Tanggal</label>
                    <input type="date" id="date" name="date" value="{{ $order->tanggal }}">
                </div>
            @endif
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahItemModal">Tambah Item</button>
                <div class="modal fade" id="tambahItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahItemModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahItemModalLabel">Tambah Buku</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('orders.insert') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="buku">Buku:</label>
                                        <select class="form-select" id="buku" name="buku">
                                            <option selected>Pilih Buku</option>
                                            @foreach($book as $book)
                                                <option value="{{ $book->id }}" data-bs-price="{{ $book->harga }}">{{ $book->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" id="nama" name="nama">
                                    <input type="hidden" id="tanggal" name="tanggal">
                                    <div class="mb-3">
                                        <label class="d-flex" for="harga">Harga:</label>
                                        <input type="text" id="harga" name="harga" value="" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="d-flex" for="qty">Qty:</label>
                                        <input type="number" id="qty" name="qty" value="0">
                                    </div>
                                    <div class="mb-3">
                                        <label class="d-flex" for="total">Total:</label>
                                        <input type="text" id="total" name="total" value="" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section>
            @if(!$order)
                <p>Belum ada data order</p>
            @else
            <table class="table">
                <thead>
                    <th scope="col">No.</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga Total</th>
                    <th scope="col">Aksi</th>
                </thead>
                <tbody>
                    @foreach($order->books as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>Rp{{ $item->harga }}</td>
                            <td>{{ $item->pivot->quantity }}</td>
                            <td>Rp{{ ($item->harga)*($item->pivot->quantity)}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="icon-link btn btn-link" id="edit" data-bs-toggle="modal" data-bs-target="#editItemModal-{{ $item->id }}">
                                        <i class="bi bi-pencil text-warning"></i>
                                        Edit
                                    </button>
                                    <form class="mb-0" action="{{ route('orders.item.delete', ['orderId'=>$order->id, 'bookId'=>$item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="icon-link btn btn-link" id="delete">
                                            <i class="bi bi-trash text-danger"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                <div class="modal fade" id="editItemModal-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                aria-labelledby="editItemModalLabel-{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editItemModalLabel-{{ $item->id }}">Edit Order Buku</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('orders.item.update', ['orderId'=>$order->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="bukuEdit">Buku:</label>
                                                        <select class="form-select" id="bukuEdit" name="buku" readonly>
                                                            <option value="{{ $item->pivot->book_id }}" data-bs-price="{{ $item->harga }}" 
                                                                selected>{{ $item->judul }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="d-flex" for="hargaEdit">Harga:</label>
                                                        <input type="text" id="hargaEdit-{{ $item->id }}" name="harga" value="{{ $item->harga}}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="d-flex" for="qtyEdit">Qty:</label>
                                                        <input type="number" id="qtyEdit-{{ $item->id }}" name="qty" value="{{ $item->pivot->quantity}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="d-flex" for="totalEdit">Total:</label>
                                                        <input type="text" id="totalEdit-{{ $item->id }}" name="total" value="" readonly>
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
        <a href="{{ route('orders') }}" type="button" class="btn btn-secondary">Selesai</a>
    </div>
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        const harga = document.getElementById('harga');
        const bukuSelect = document.getElementById('buku');
        bukuSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-bs-price');
            harga.value = price;
        });
        const total = document.getElementById('total');
        const qty = document.getElementById('qty');
        qty.addEventListener('change', function() {
            total.value = harga.value * qty.value;
        });
        document.querySelectorAll('[id^="editItemModal-"]').forEach(modal => {
            const modalId = modal.id.split('-')[1];
            const hargaEdit = document.getElementById(`hargaEdit-${modalId}`);
            const qtyEdit = document.getElementById(`qtyEdit-${modalId}`);
            const totalEdit = document.getElementById(`totalEdit-${modalId}`);
            
            if (qtyEdit && hargaEdit && totalEdit) {
                qtyEdit.addEventListener('change', function () {
                    totalEdit.value = hargaEdit.value * qtyEdit.value;
                });
            }
        });
        const customer = document.getElementById('customer');
        const nama = document.getElementById('nama');
        const date = document.getElementById('date');
        const tanggal = document.getElementById('tanggal');

        function copyValue() {
            nama.value = customer.value;
            tanggal.value = date.value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            copyValue();
            
            customer.addEventListener('change', copyValue);
            date.addEventListener('change', copyValue);
        });
        
    </script>
@endsection