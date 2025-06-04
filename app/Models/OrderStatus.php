<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $guarded = [];

    public function orders(){
        return $this->hasMany(Order::class, 'order_status')->select('id','order_status');
    }
}
