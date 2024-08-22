<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "book";

    public function classC(){
        return $this->belongTo(ClassModel::class, 'class_id');
    }

    public function subject(){
        return $this->belongTo(subject::class, 'subject_id');
    }
}
