<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{

    protected $table = 'students';

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
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

}
