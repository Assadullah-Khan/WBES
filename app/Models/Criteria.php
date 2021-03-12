<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    public function subject(){
        return $this->hasOne(Subject::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
