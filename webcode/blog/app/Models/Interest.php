<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $table = 'interests';
    protected $fillable = ['user_id','lecture_id'];
    protected $guards = [];

    function user()
    {
        $this->hasMany(User::class, 'id', 'user_id');
    }

    function lecture()
    {
        $this->hasMany(Lecture::class, 'lecture_id', 'id');
    }
}
