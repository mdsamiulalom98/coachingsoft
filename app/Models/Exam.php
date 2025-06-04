<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function class(){
        return $this->belongsTo(Classroom::class);
    }
    public function session(){
        return $this->belongsTo(StudentSession::class);
    }
    public function batch(){
        return $this->belongsTo(Batch::class);
    }
}
