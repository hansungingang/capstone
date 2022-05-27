<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory;

    protected $table = 'lectures';
    protected $fillable = ['name','instructor_name','content','category_id','file_id'];
    protected $guards = [];


    public function platform(){
        return $this->hasMany(LecturePlatform::class,'lecture_id','id');
    }

    public function file(){
        return $this->hasOne(File::class,'id','file_id');
    }

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function interests(){
        return $this->belongsTo(Interest::class,'id','lecture_id');
    }

    public function platformReview(){
        return $this->hasMany(platformReview::class,'id','lecture_id');
    }

    public function review(){
        return $this->hasMany(Review::class,'id','lecture_id');
    }

    public function adMapping(){
        return $this->belongsTo(AdMapping::class,'lecture_id','id');
    }
}
