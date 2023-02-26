<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Image;
class CategoryController extends Controller
{
    public function products(Category $category){
        $sortBy ='name ASC';
        if (isset($_GET['sortBy'])) {
            switch ($_GET['sortBy']) {
                case '0':
                    $sortBy ='name ASC';
                    break;
                case '1':
                    $sortBy ='name DESC';
                    break;
                case '2':
                    $sortBy ='sale_price ASC';
                    break;
                case '3':
                    $sortBy ='sale_price DESC';
                    break;
                default:
                    $sortBy ='name ASC';
                    break;
            }
        }
    	$products= $category->products()->orderByRaw($sortBy)->get();
        $banner= Image::where('category_id', $category->id)->first();
        $banner= $banner==null?'frontend/images/12.jpg':$banner->path;
    	$images = array();
    	foreach ($products as $product) {
    		$images[$product->id]=$product->images()->first();
    	}
    	return view('frontend/category/products')->with([
    		'products'=>$products,
    		'category'=>$category,
            'banner'=>$banner,
    		'images'=>$images
    	]);
    }
}
