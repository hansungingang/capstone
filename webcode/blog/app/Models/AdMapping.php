<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdMapping extends Model
{
    use HasFactory;
    protected $table = 'ad_mappings';
    protected $fillable = ['lecture_id','ad_area_id'];
    protected $guards = [];
    public $with = ['lecture:id,name,instructor_name'];

    public function adArea(){
        return $this->belongsTo(AdArea::class,'id','ad_area_id');
    }

    public function lecture(){
        return $this->hasMany(Lecture::class,'id','lecture_id');
    }
}
