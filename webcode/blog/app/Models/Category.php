<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guards = [];
    
    public function lecture(){
        return $this->belongsTo(Lecture::class,'category_id','id');
    }

    public function subcategory(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }
}
