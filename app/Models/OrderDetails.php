<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id')->select('id', 'title', 'image', 'price');
    }
}
