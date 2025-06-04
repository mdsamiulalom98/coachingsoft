<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function orderdetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
