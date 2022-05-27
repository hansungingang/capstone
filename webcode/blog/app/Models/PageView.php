<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $table = 'page_views';
    protected $fillable = ['current_url','referer','ip_address','agent','session_id'];
    protected $guards = [];
}
