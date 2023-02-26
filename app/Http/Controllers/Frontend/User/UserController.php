<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
class UserController extends Controller
{
    public function show(){
    	$user = Auth::user();
    	return view('frontend.user.show')->with([
    		'user'=>$user
    	]);
    }
    public function edit(){
    	$user = Auth::user();
    	return view('frontend.user.edit')->with([
    		'user'=>$user
    	]);
    }
    public function update(Request $request){
    	$user = User::findOrFail(Auth::user()->id);
    	$user->name = $request->get('name');
    	$user->email = $request->get('email');
    	$user->address = $request->get('address');
        $user->password = $request->get('password')==null?$user->password:bcrypt($request->get('password'));
    	$user->save();
        Session::flash('msg','Cập nhật tài khoản thành công');
    	return redirect()->route('index');
    }
    public function changePassword(Request $request){

        $validator = Validator::make($request->all(),
            [
                'password'=>'required',
                'newPassowrd'=>'required|confirmed|max:255'
            ],
            [
                'required' => ':attribute Không được để trống',
                'max' => ':attribute Không được lớn hơn :max',
                'confirmed'=>':attribute nhập lại không chính xác',
            ],
            [
                'password' => 'Mật khẩu cũ',
                'newPassord' => 'Mật khẩu mới'
            ]
        );
        if ($validator->errors()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    	$user = User::findOrFail(Auth::user()->id);
    	if($user->password == bcrypt($request->get('password'))){
            $user->password=bcrypt($request->get('password'));
            $user->save();
            Session::flash('msg','Cập nhật mật khẩu mới thành công');
    	}else{
            Session::flash('msg','Mật khẩu cũ không chính xác');
        }
    	return view('frontend.user.show');
    }

    public function orders(){
        $orders = User::findOrFail(Auth::user())->first()->orders()->get();
        return view('frontend.user.orders')->with([
            'orders'=>$orders
        ]);
    }

    public function showOrder($order_id){
        $order = Order::where('id', $order_id)->firstOrFail();
        $products = $order->products;
        $amount = array();
        foreach ($products as $product) {
            $amount[$product->id] = \DB::table('order_product')->where([
                'order_id' => $order->id,
                'product_id' => $product->id
            ])->value('amount');
        }
        return view('frontend.user.order')->with([
            'order'=>$order,
            'products'=>$products,
            'amount'=>$amount
        ]);
    }
}
