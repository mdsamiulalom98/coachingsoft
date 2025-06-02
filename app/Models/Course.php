<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    
    public function chapters() {
        return $this->hasMany(Chapter::class, 'course_id')->where('status', 1);
    }
    public function lesson() {
        return $this->hasMany(Lesson::class, 'course_id')->where('status', 1);
    }
}
