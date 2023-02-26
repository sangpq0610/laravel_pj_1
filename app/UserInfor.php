<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class UserInfor extends Model
{
    protected $table='user_infor';
    protected $fillable=[
    	'user_id','fullname'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
