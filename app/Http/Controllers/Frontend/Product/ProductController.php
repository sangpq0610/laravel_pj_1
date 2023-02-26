<?php

namespace App\Http\Controllers\Frontend\Product;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function show($id){
    	$product = Product::findOrFail($id);
        $image= Product::findOrFail($id)->images()->first();
        $products = Product::where('category_id', $product->category_id)->take(12)->get();
        $images = array();
        $productsSearched = array();
        foreach ($products as $value) {
            $images[$value->id]=$value->images()->first();
        }
    	return view('frontend.product.show')->with([
            'product'=>$product,
            'products'=>$products,
            'productsSearched'=>$productsSearched,
            'image'=>$image,
            'images'=>$images
        ]);
    }
    
    public function search($search){
        
        $productsSearched = Product::where('name','like','%'.$search.'%')->get();
        Session::flash('result',$productsSearched);
        return redirect()->back();
    }
}
