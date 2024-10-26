<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['judul', 'penulis', 'tahun', 'harga', 'stok', 'penerbit'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_item', 'order_id', 'book_id')
                    ->withPivot('quantity', 'total')
                    ->withTimestamps();
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'penerbit');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id')
                    ->withTimestamps();
    }

    use SoftDeletes;
}
