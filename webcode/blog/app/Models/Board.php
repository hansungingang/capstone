<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $table = 'boards';
    protected $fillable = ['title','content','user_id','board_category_id'];
    protected $guards = [];

    public function user(){
        return $this->hasMany(User::class,'id','user_id');
    }

    public function boardcategory(){
        return $this->hasOne(BoardCategory::class,'id','board_category_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'id','comment_id');
    }
}
