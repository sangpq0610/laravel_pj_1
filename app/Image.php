<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    protected $table='images';
    use SoftDeletes;
    protected $fillable=[
    	'name', 'type', 'path', 'size', 'category_id', 'user_id', 'product_id'
    ];
}
