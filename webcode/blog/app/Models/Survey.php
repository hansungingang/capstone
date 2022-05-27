<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table='survey';
    protected $fillable = ['question1','question1_reason','question2','question2_reason'];
}
