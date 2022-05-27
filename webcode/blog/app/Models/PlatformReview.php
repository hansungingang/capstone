<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformReview extends Model
{
    use HasFactory;

    protected $table = 'platform_reviews';
    protected $fillable = ['platform','title','content','user_name','lecture_id'];
    protected $guards = [];

    public function lecture(){
        $this->belongsTo(Lecture::class,'lecture_id','id');
    }
}
