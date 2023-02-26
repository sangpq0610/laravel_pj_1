<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
class OrderController extends Controller
{
    //Danh sách
	public function index(Request $request){
        $orders= Order::orderByRaw('created_at DESC');
        if($request->key){
            $orders = $orders->where('id', 'like', '%'.$request->key.'%');
        }
        $orders = $orders->paginate(8);
        if($request->key){
            $orders = $orders->appends(['key' => $request->key]);
        }
    	return view('backend.order.index')->with('orders', $orders);
    }

    //tạo mới
    public function store(Request $request){

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->money = $request->get('money');
            $order->save();
            return redirect()->route('index');
    }

    //xem danh sách sản phẩm trong đơn hàng
    public function showProducts($order_id){
        $order = Order::findOrFail($order_id);
    	$products= $order->products()->get();
        $amount = array();
        foreach ($products as $product) {
            $amount[$product->id] = \DB::table('order_product')->where([
                'order_id' => $order->id,
                'product_id' => $product->id
            ])->value('amount');
        }

    	return view('backend.order.products')->with([
            'products'=>$products,
            'order'=>$order,
            'amount'=>$amount
        ]);
    }

    //Xác nhận đơn hàng
    public function confirm($order_id){
        $order = Order::findOrFail($order_id);
        $products= $order->products()->get();
        $amount = array();
        foreach ($products as $product) {
            $amount[$product->id] = \DB::table('order_product')->where([
                'order_id' => $order->id,
                'product_id' => $product->id
            ])->value('amount');
            if($amount[$product->id] > $product->amount) {
                alert()->warning('Xác nhận thất bại', 'số lượng sản phẩm '. $product->name .' trong kho không đủ');
                return redirect()->back();
            }
        }
        foreach ($products as $products) {
            $product->amount -= $amount[$product->id];
            $product->sold += $amount[$product->id];
            $product->save();
        }
        $order->status = 1;
        $order->save();
        return redirect()->route('backend.order.index');
    }

    //Hoàn thành đơn hàng
    public function complete($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = 2;
        $order->save();
        $products = $order->products;
        foreach ($products as $product) {
            $sold = \DB::table('order_product')->where([
                'order_id'=>$order->id,
                'product_id'=>$product->id
            ])->value('amount');
            $product->amount = $product->amount -$sold;
            $product->sold =$product->sold +$sold; 
            $product->save();
        } 
        Session::flash('msg','Đã hoàn thành đơn hàng '.$order->id);
        return redirect()->back();
    }

    //Xem đơn hàng của tôi
    public function myOrder($user_id){
    	$orders = Order::findOrFail($user_id);
    }

    //Xem đơn hàng mới
    public function newOrders(){
        $orders = Order::where('status', 0)->orderByRaw('created_at DESC')->paginate(8);
        return view('backend.order.index')->with([
            'orders'=>$orders
        ]);
    }

    //Doanh thu
    public function revenue(Request $request){
        $orders = Order::where('status', 2);
        if($request->sort == 'month'){
            $orders = $orders->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year);
        }
        if($request->sort == 'year'){
            $orders = $orders->whereYear('created_at', '=', Carbon::now()->year);
        }

        
        $orders = $orders->orderByRaw('created_at DESC')->get();
        $revenue = 0;
        foreach($orders as $order){
            $revenue = $revenue + $order->money;
        }
        return view('backend.order.revenue')->with([
            'orders' => $orders,
            'sort' => $request->sort,
            'revenue' => $revenue
        ]);
    }

    public function destroy($id){
        $order= Order::findOrFail($id);
        if($order->status == 1){
            $products= $order->products()->get();
            $amount = array();
            foreach ($products as $product) {
                $amount[$product->id] = \DB::table('order_product')->where([
                    'order_id' => $order->id,
                    'product_id' => $product->id
                ])->value('amount');
            }
            foreach ($products as $products) {
                $product->sold -= $amount[$product->id];
                $product->save();
            }
        }
        $order->delete();
    }
}
