<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PDO;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_reception',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'is_admin'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interests(){
        return $this->belongsTo(interest::class,'user_id','id');
    }

    public function userinfos(){
        return $this->hasOne(UserPrefer::class,'user_id','id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'id','user_id');
    }
    
    public function boards(){
        return $this->belongsTo(Board::class,'id','user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'id','user_id');
    }

    public function getIsAdminAttribute(){
        return $this->attributes['type'] == 'admin';
    }
}
