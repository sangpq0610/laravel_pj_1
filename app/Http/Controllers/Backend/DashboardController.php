<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Order;
use App\User;

class DashboardController extends Controller
{
	public function __construct(){

	}
    public function index(){
    	$products = Product::all()->count();
        $recent_products = Product::orderByRaw('created_at DESC')->get();
    	$orders = Order::all()->count();
    	$users = User::where('role', 0)->count();
        $finished_orders = Order::where('status', 2)->get();
        $revenue = 0;
        foreach($finished_orders as $order){
            $revenue = $revenue + $order->money;
        }
        $images = array();
        foreach ($recent_products as $product) {
            $images[$product->id] = $product->images()->first();
        }

    	if (Auth::user()->role==0) {
			return redirect()->route('index');
		}else
    	return view('backend.dashboard')->with([
    		'products' => $products,
            'recent_products' => $recent_products,
            'images' => $images,
    		'orders' => $orders,
    		'users' => $users,
            'revenue' => $revenue
    	]);
    }
}
