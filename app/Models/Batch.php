<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = [];
    
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function class(){
        return $this->belongsTo(Classroom::class);
    }
    public function session(){
        return $this->belongsTo(StudentSession::class);
    }
}
