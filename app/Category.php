<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;
class Category extends Model
{
    protected $table='categories';

    use SoftDeletes;

    protected $fillable=[
    	'name','slug','parent_id','user_id'
    ];
    
    public function products(){
    	return $this->hasMany(Product::class, 'category_id','id');
    }
}
