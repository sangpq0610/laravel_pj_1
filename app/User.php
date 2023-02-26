<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userInfor(){
        return $this->hasOne(UserInfor::class, 'user_id', 'id');
    }
    
    public function products(){
        return $this->hasMany(\App\Product::class, 'user_id', 'id');
    }

    public function orders(){
        return $this->hasMany(\App\Order::class, 'user_id', 'id');
    }

}
