<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table='orders';
    use SoftDeletes;
    protected $fillable=[
    	'money','user_id','status'
    ];
    
    public function products(){
    	return $this->belongsToMany(\App\Product::class);	
    }
}
