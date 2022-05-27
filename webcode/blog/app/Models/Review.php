<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['platform','title','content','star','difficulty','lecture_id','user_id','parent_review'];
    protected $guards = [];

    public function lecture(){
        return $this->belongsTo(Lecture::class,'id','lecture_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
