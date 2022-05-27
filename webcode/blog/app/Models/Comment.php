<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['content','user_id','board_id','parent_comment_id'];
    protected $guards = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function board(){
        return $this->hasOne(Board::class,'id','board_id');
    }

    public function subcomments(){
        return $this->hasMany(Comment::class,'parent_comment_id','id');
    }
}
