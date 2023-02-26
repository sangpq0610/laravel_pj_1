<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table='products';

    use SoftDeletes;
    
    protected $fillable=[
    	'name','slug','origin_price','sale_price','content','user_id','category_id','tags_id','amount','rate','rate_count','sold'
    ];

    public function category(){
    	return $this->belongsTo(\App\Category::class,'id','category_id');
    }

    public function images(){
    	return $this->hasMany(\App\Image::class);
    }
    
    public function orders(){
    	return $this->belongsToMany(\App\Order::class);
    }
}
