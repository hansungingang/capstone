<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturePlatform extends Model
{
    use HasFactory;

    protected $table = 'lecture_platforms';
    protected $fillable = ['lecture_id','platform_name','url','price','end_time','watch_time'];
    protected $guards = [];

    public function lecture(){
        return $this->belongsTo(Lecture::class,'id','lecture_id');
    }   
}
