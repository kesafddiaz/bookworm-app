<!DOCTYPE html>
<html>
<head>
    <title>Order #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table th, .items-table td { border: 1px solid #ddd; padding: 8px; }
        .items-table th { background-color: #f2f2f2; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Order #{{ $order->id }}</h2>
        <p>Tanggal: {{ $order->tanggal }}</p>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->books as $book)
            <tr>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->pivot->quantity }}</td>
                <td>Rp{{ number_format($book->harga, 2) }}</td>
                <td>Rp{{ number_format($book->pivot->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Grand Total: Rp{{ number_format($order->grandTotal, 2) }}</p>
</body>
</html>
