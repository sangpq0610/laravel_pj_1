<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Image;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    var $categories;
    function __construct(){
        $this->categories = Category::all();
    }
    public function index(){
        // $array = array();
        // $category = new Category();
        // // $category->id = 1;
        // // $category->parent_id=1;
        // // $category->name='hi';
        // $array=[
        //     '0'=>1,
        //     '1'=>2
        // ];
        // $value = Cache::put('view',1);
        
        // $value =Cache::put('key',$category,now()->addHour(24));
        // dd($value);
        
        $products = Product::all()->sortBy('name');
        
        $productsSearched = array();
        $images = array();
        foreach ($products as $product) {
            $images[$product->id]=$product->images()->first();
        }
        // echo "<pre>";
        //     print_r($images);
        // echo "</pre>";
    	return view('frontend.index')->with([
            'products'=>$products,
            'productsSearched'=>$productsSearched,
            'images'=>$images
        ]);
    }
    public function show(){
    	return view('frontend.product.show');
    }

    public function contact(){
    	return view('frontend.contact');
    }
    public function submitContact(Request $request){
        $contact = new Contact();
        $contact->name = $request->get('name');
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->subject = $request->get('subject');
        $contact->content = $request->get('content');
        $contact->save();
        alert()->success('Gửi thành công', 'Thông tin liên hệ của bạn đã được gửi');
        return redirect()->back();
    }

    public function checkout(){
        $cart = \Cart::content();
        $images = array();
        foreach ($cart as $cartItem) {
            $images[$cartItem->id]=Product::find($cartItem->id)->images()->first();
        }
    	return view('frontend.checkout')->with([
            'cart'=>$cart,
            'images'=>$images
        ]);
    }

    public function find(Request $request){
        $products = Product::where('name', 'like', '%'.$request->key.'%')->get();
        $images = array();
        foreach ($products as $product) {
            $images[$product->id]=$product->images()->first();
        }
        return view('frontend.products')->with([
            'products' => $products,
            'key' => $request->key,
            'images' => $images
        ]);
    }
}
