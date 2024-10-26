<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['nama', 'tanggal', 'grandTotal'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'orders_item', 'order_id', 'book_id')
                    ->withPivot('quantity', 'total')
                    ->withTimestamps();
    }

    use SoftDeletes;
}
