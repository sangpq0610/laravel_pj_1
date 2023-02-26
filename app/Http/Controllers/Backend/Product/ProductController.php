<?php

namespace App\Http\Controllers\Backend\Product;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index(Request $request){
    	$products = Product::orderByRaw('created_at DESC');
        if($request->key){
            $products = $products->where('name', 'like', '%'.$request->key.'%')->orWhere('id', 'like', '%'.$request->key.'%');
        }
        $products = $products->paginate(8);
        if($request->key){
            $products = $products->appends(['key' => $request->key]);
        }
        $images = array();
        foreach ($products as $product) {
            $images[$product->id]=$product->images()->first();
        }
    	return view('backend.product.index')->with([
            'products' => $products,
            'images' => $images
        ]);
    }
    public function create(){
        $categories= \App\Category::all();
        return view('backend.product.create')->with([
            'categories'=>$categories
        ]);
    }
    public function store(StoreProductRequest $request){

        // $validator = Validator::make($request->all(),
        //     [
        //         'name'=>'required|min:5|max:255',
        //         'origin_price'=>'required|numeric',
        //         'sale_price'=>'required|numeric|max:$request->origin_price',
        //         'amount'=>'required|numeric|min:0',
        //         'content'=>'required|min:10',
        //     ],
        //     [
        //         'required' => ':attribute Không được để trống',
        //         'min' => ':attribute Không được nhỏ hơn :min',
        //         'max' => ':attribute Không được lớn hơn :max'
        //     ],
        //     [
        //         'name' => 'Tên sản phẩm',
        //         'origin_price' => 'Giá gốc',
        //         'sale_price' => 'Giá bán',
        //         'amount' =>'Số lượng trong kho',
        //         'content' =>'Mô tả sản phẩm'
        //     ]
        // );
        // if ($validator->errors()){
        //     return back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

            // $path = Storage::disk('public')->putFile('images', $request->file('image'));

            // $file = $request->file('image');
            // Lưu vào trong thư mục storage
            // $path = $file->store('public/images');

        $images = $request->file('images');
        $status = $this->validateImage($images);
        if(!$status){
            // dd(1);
            return redirect()->route('backend.product.create');
        }else{
            $product = new Product();
            $product->name = $request->get('name');
            $product->slug = $request->get('slug')==null?\Illuminate\Support\Str::slug($request->get('name').time()):$request->get('slug');
            $product->category_id = $request->get('category_id');
            $product->origin_price = $request->get('origin_price');
            $product->sale_price = $request->get('sale_price');
            $product->amount = $request->get('amount');
            $product->user_id = Auth::user()->id;
            $product->content = $request->get('content');
            $product->save();
            foreach ($images as $image) {   
                $image1 = new Image();
                $image1->path = '/storage/images/'.time().$image->getClientOriginalName();
                $image1->product_id = $product->id;
                $image1->type = $image->getClientOriginalExtension();
                $image1->size = $image->getClientSize();
                $image1->user_id = Auth::user()->id;
                $image->storeAs('public/images',time().$image->getClientOriginalName());
                $image1->save();
            }
            Session::flash('msg', 'Tạo mới Sản phẩm '.$product->name.' thành công');
            return redirect()->route('backend.product.index');
        }
    }


    public function update(Request $request,$id){
        $product=Product::findOrFail($id);
        
        $product->name=$request->get('name');
        $product->slug = $request->get('slug')==null?\Illuminate\Support\Str::slug($request->get('name').time()):$request->get('slug');
        $product->category_id = $request->get('category_id');
        $product->origin_price = $request->get('origin_price');
        $product->sale_price = $request->get('sale_price');
        $product->amount = $request->get('amount');
        $product->user_id = Auth::user()->id;
        $product->content = $request->get('content');
        $product->save();
        if ($request->hasFile('images')) {
            $images=Image::where('product_id',$product->id)->get();
            foreach ($images as $image) {
                Storage::delete($image->path);
                $image->delete();
            }
            $images1=$request->file('images');
            foreach ($images1 as $image){
                $image1 = new Image();
                $image1->path = '/storage/images/'.time().$image->getClientOriginalName();
                $image1->product_id = $product->id;
                $image1->type = $image->getClientOriginalExtension();
                $image1->size = $image->getClientSize();
                $image1->user_id = Auth::user()->id;
                $image->storeAs('public/images',time().$image->getClientOriginalName());
                $image1->save();
            }
        }
        
        Session::flash('msg', 'Cập nhật Sản phẩm '.$product->name.' thành công');

        return redirect()->route('backend.product.index');
    }

    public function edit(Product $product){
        
        // if ($user->can('update', $product)) {
        //     dd('oki')
        // }else return abort(404);

        

        // if(Gate::allows('update-product',$product)){
        //     return view('backend.product.edit')->with([
        //         'product'=>$product,
        //         'categories'=>$categories,
        //         'images'=>$images
        //     ]);
        // }else{
        //     return abort(404);
        // }

        // $product=Product::findOrFail($id);
        $images=\App\Product::findOrFail($product->id)->images()->get();
        $categories=\App\Category::orderByRaw('name ASC')->get();
        $user = Auth::user();
        return view('backend.product.edit')->with([
            'product'=>$product,
            'categories'=>$categories,
            'images'=>$images
        ]);
    }


    public function show($id){
    	$product = Product::findOrFail($id);
    	return view('backend.product.show')->with('product',$product);
    }
    
    public function showImages($product_id){
    	$images=\App\Product::findOrFail($product_id)->images()->paginate(15);
    	return view('backend.product.images')->with('images',$images);
    }
    public function showOrders($product_id){
    	$orders=\App\Product::findOrFail($product_id)->orders;
    	foreach ($orders as $order) {
    		echo $order->id.": ".$order->money."<br>";
    	}
    }
    public function destroy($id){
        $product= Product::findOrFail($id);
        $product->delete();
    }

    public function validateImage($images){
        $flag = true;
        
        $alowedType=[
            'jpg','png','bmp','gif','svg'
        ];

        $size = 0;
        foreach($images as $image){
            if(!in_array($image->getClientOriginalExtension(), $alowedType)){
                Session::flash('images', 'Ảnh của sản phẩm upload không phải file jpg, png, bmp, gif, svg');
                return $flag = false;
            }
            $size += $image->getClientSize();
        }
        if ($size>10*1024*1024) {
            Session::flash('images', 'Ảnh của sản phẩm upload không vượt quá 2 Mb');
            return $flag = false;
        }
        return $flag;
    }
}
