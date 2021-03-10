<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function criteria(){
        return $this->belongsTo(Criteria::class);
    }

    public function questions(){
        return $this->belongsToMany(Question::class);
    }
}
