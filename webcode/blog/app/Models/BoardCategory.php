<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCategory extends Model
{
    use HasFactory;
    protected $table = 'board_categories';
    protected $fillable = ['name'];
    protected $guards = [];

    public function board(){
        return $this->belongsTo(BoardCategory::class,'board_category_id','id');
    }
}
