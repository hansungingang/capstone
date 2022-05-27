<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name','extension','path','size','mime_type','user_id'];
    protected $guards = [];

    public function lecture(){
        return $this->belongsTo(Lecture::class,'file_id','id');
    }
}
