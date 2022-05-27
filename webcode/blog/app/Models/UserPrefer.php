<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrefer extends Model
{
    use HasFactory;
    protected $table = 'user_prefers';
    protected $fillable = ['user_id','sub_category'];
    protected $gaurds = [];

    public function user(){
        $this->belongsTo(User::class,'id','user_id');
    }
}
