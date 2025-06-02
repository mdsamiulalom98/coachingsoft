<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $guarded = [];

     public function lesson() {
        return $this->hasMany(Lesson::class, 'chapter_id')->where('status', 1);
    }

}
