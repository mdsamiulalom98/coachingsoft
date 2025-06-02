<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function mentor(){
        return $this->belongsTo(Mentor::class,'mentor_id');
    }
}
