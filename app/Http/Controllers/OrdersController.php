<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders', compact('orders'));
    }

    public function addOrder($orderId = null)
    {
        $book = Book::all();
        if (!$orderId) {
            $order = null;
            return view('newOrder', compact('book', 'order'));
        }
        $order = Order::with('books')->find($orderId);
        return view('newOrder', compact('book', 'order'));
    }

    public function insert(Request $request)
    {
        $order = Order::firstOrCreate([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal
        ]);

        $order->update([
            'grandTotal' => $order->grandTotal + $request->total
        ]);

        $order->books()->attach($request->buku, ['quantity' => $request->qty, 'total' => $request->total]);
        return redirect()->route('orders.add', $order->id)->with('success', 'Order berhasil ditambahkan');
    }

    public function delete($orderId)
    {
        $order = Order::find($orderId);
        $order->books()->detach();
        $order->delete();
        return redirect()->route('orders')->with('success', 'Order berhasil dihapus');
    }

    public function updateItem(Request $request, $orderId)
    {
        // dd($request->all());
        $order = Order::find($orderId);
        $book = $order->books()->where('book_id', $request->buku)->first();
        
        $totalBefore = $book->pivot->total;
        // dd($book->pivot);
        $order->books()->updateExistingPivot($request->buku, ['quantity' => $request->qty], ['total' => $request->total]);
        $difference = $request->total - $totalBefore;
        // dd($difference);
        $order->update([
            'grandTotal' => $order->grandTotal + $difference
        ]);
        // dd($order);
        return redirect()->route('orders.add', $order->id)->with('success', 'Order berhasil diubah');
    }

    public function deleteItem($orderId, $bookId)
    {
        $order = Order::find($orderId);
        $order->books()->detach($bookId);
        return redirect()->route('orders.add', $order->id)->with('success', 'Order berhasil dihapus');
    }

    public function search(Request $request)
    {
        $nama = $request->nama;
        $orders = Order::where('nama', 'like', "%$nama%")->get();
        return view('orderSearch', compact('orders'));
    }
}
