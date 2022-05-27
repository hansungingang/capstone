<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdArea extends Model
{
    use HasFactory;
    protected $table = 'ad_areas';
    protected $fillable = ['area_name'];
    protected $guards = [];

    public function adMapping(){
        return $this->hasMany(AdMapping::class,'ad_area_id','id');
    }
}
