<?php

namespace App\Http\Controllers\Backend\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Controller\Backend\Product\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
class CategoryController extends Controller
{
    public function index(Request $request){
    	$categories = Category::orderByRaw('created_at DESC');
        if($request->key){
            $categories = $categories->where('name', 'like', '%'.$request->key.'%')->orWhere('id', 'like', '%'.$request->key.'%');
        }
        $categories = $categories->paginate(8);
        if($request->key){
            $categories = $categories->appends(['key' => $request->key]);
        }
    	return view('backend.category.index')->with('categories', $categories);
    }

    public function show($id){
        $category = Category::findOrFail($id);
        return view('backend.category.show')->with('category',$category);
    }

    public function create(){
    	$categories= Category::where('parent_id', null)->get();
    	return view('backend.category.create')->with('categories', $categories);
    }

    public function store(StoreCategoryRequest $request ){
        $images = $request->file('images');
        $status = ProductController::validateImage($images);
        if(!$status){
            return redirect()->route('backend.category.create');
        }else{
            $category = new Category();
            $category->name = $request->get('name');
            $category->slug = $request->get('slug')==null?\Illuminate\Support\Str::slug($request->get('name').time()):$request->get('slug');
            $category->parent_id = $request->get('parent_id');
            $category->user_id = Auth::user()->id;
            $category->save();
            foreach ($images as $image) {
                $image1 = new Image();
                $image1->path = '/storage/images/'.time().$image->getClientOriginalName();
                $image1->category_id = $category->id;
                $image1->type = $image->getClientOriginalExtension();
                $image1->size = $image->getClientSize();
                $image->storeAs('public/images',time().$image->getClientOriginalName());
                $image1->save();
            }
            Session::flash('msg', 'Tạo mới Danh mục '.$category->name.' thành công');
            return redirect()->route('backend.category.index');
        }
    }

    public function edit($id){
    	$categories= Category::where('parent_id', null)->get();
    	$category= Category::findOrFail($id);
    	return view('backend.category.edit')->with([
    		'categories'=> $categories,
    		'category'=>$category
    	]);
    }

    public function update(StoreCategoryRequest $request, $id ){

    	$category = Category::findOrFail($id);
        $category->name = $request->get('name');
        $category->slug = $request->get('slug')==null?\Illuminate\Support\Str::slug($request->get('name').time()):$request->get('slug');
        $category->parent_id = $request->get('parent_id');
        $category->user_id = Auth::user()->id;
        $category->save();
        if ($request->file('images')!=null&&ProductController::validateImage($images)==true) {
            $images=Image::where('category_id',$category->id)->all();
            foreach ($images as $image) {
                Storage::deleteDirectory($image->path);
                $image->delete();
            }
            $images1=$request->file('images');
            foreach ($images1 as $image){
                $image1 = new Image();
                $image1->path = '/storage/images/'.time().$image->getClientOriginalName();
                $image1->category_id = $category->id;
                $image1->type = $image->getClientOriginalExtension();
                $image1->size = $image->getClientSize();
                $image->storeAs('public/images',time().$image->getClientOriginalName());
                $image1->save();
            }
        }else{
            return redirect()->back();
        }
        Session::flash('msg', 'Cập nhật danh mục '.$category->name.' thành công');

        return redirect()->route('backend.category.index');
    }

    public function destroy($id){
    	$category = Category::findOrFail($id);
    	$category->delete();
    }

    public function showProducts($category_id){
    	$products = Category::findOrFail($category_id)->products;
        $category = Category::findOrFail($category_id);
        $images = array();
        foreach ($products as $product) {
            $images[$product->id]=$product->images()->first();
        }
    	return view('backend.category.products')->with([
            'products' => $products,
            'images' => $images,
            'category' => $category
        ]);
    }
}
