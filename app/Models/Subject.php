<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }

    public function criteria(){
        return $this->hasOne(Criteria::class);
    }
}
