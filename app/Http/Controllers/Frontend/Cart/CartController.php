<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function add($product_id){
    	$product = Product::where('id', $product_id)->first();
    	\Cart::add($product->id, $product->name, 1, $product->sale_price, 0);
        // alert()->warning('Giỏ hàng trống', 'Vui lòng thêm đồ vào giỏ hàng');
    	return redirect()->back();
    }
    public function remove($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
    public function plus($rowId){
        $cartItem = Cart::get($rowId);
        Cart::update($rowId, $cartItem->qty+1);
        return redirect()->back();
    }
    public function minus($rowId){
        $cartItem = Cart::get($rowId);
        Cart::update($rowId, $cartItem->qty-1);
        return redirect()->back();
    }
    public function updateItem(Request $request){
        $cart = \Cart::content();
        foreach ($cart as $cartItem) {
            $cartItem->qty = $request->get($cartItem->id);
        }
        return redirect()->back();
    }
    public function destroy(){
        Cart::destroy();
        return redirect()->back();
    }
    public function total(){
    	dd(\Cart::total());
    }
    public function confirm(){
        $cart = \Cart::content();
        if(\Auth::user()==null){
            return redirect()->route('login');
        }
        if($cart->count() == 0){
            alert()->warning('Giỏ hàng trống', 'Vui lòng thêm đồ vào giỏ hàng');
            return redirect()->route('index');
        }
        $order = new Order;
        $order->user_id = \Auth::user()->id;
        $order->money = \Cart::total();
        $order->save();
        foreach ($cart as $cartItem) {
            \DB::table('order_product')->insert([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->id,
                'amount'=>$cartItem->qty
            ]);
        }
        \Cart::destroy();
        return redirect()->route('index');
    }
}
