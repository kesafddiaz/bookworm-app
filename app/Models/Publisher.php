<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publisher';
    protected $fillable = ['nama', 'alamat', 'telp', 'email', 'pic'];

    public function books()
    {
        return $this->hasMany(Book::class, 'penerbit');
    }
}

