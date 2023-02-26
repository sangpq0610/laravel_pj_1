<?php

namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserAdminRequest;
class UserController extends Controller
{
    public function index(Request $request){
    	//$users = \DB::table('users')->get();
    	//$users = User::get();

    	//$users = \App\User::paginate(15);

        $users = \App\User::orderByRaw('id asc');
        if($request->key){
            $users = $users->where('name', 'like', '%'.$request->key.'%')->orWhere('id', 'like', '%'.$request->key.'%')->orWhere('email', 'like', '%'.$request->key.'%');
        }
        $users = $users->paginate(15);
        if($request->key){
            $users = $users->appends(['key' => $request->key]);
        }

    	//$users = User::simplePaginate(15);

    	return view('backend.user.index')->with('users', $users);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('backend.user.show')->with('user',$user);
    }

    public function create(){
    	return view('backend.user.create');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('backend.user.edit')->with([
            'user'=>$user
        ]);
    }
    public function edit1(){
        $user = User::findOrFail(\Auth::user()->id);
        return view('backend.user.edit1')->with([
            'user'=>$user
        ]);
    }
    
    public function showProducts($user_id){
        $products=\App\User::findOrFail($user_id)->products;
        $user = User::findOrFail($user_id);
        return view('backend.user.products')->with([
            'products' => $products,
            'user' => $user
        ]);
    }

    public function test(){
        return view('backend.user.test');
    }

    public function test1(Request $request){
        $sumFood = array();
        $foodRate = array();
        $sumArt = 0;
        $artRate = array();
        $output = array();
        for ($i = 1; $i<=4; $i++){
            $sum = 0;
            $sumArt += $request->get('art'.$i); 
            for($j = 1; $j<=6; $j++){
                $sum += $request->get('food'.$j.$i);
                $request->get('food'.$i.$j);
            }
            $sumFood[$i] = $sum;
        }
        for ($i = 1; $i<=4; $i++){
            $artRate[$i] = $request->get('art'.$i)/$sumArt;
            for($j = 1; $j<=6; $j++){
                $rate = $request->get('food'.$j.$i)/$sumFood[$i];
                $foodRate[$j.$i] = $rate;
            }
        }
        for ($i = 1; $i <= 6; $i++){
            $sumRate = 0;
            for ($j = 1; $j <= 4; $j++){
                $sumRate += $foodRate[$i.$j]*$artRate[$j];
            }
            $output[$i] = $sumRate;
        }
        dd($output);
    }

    public function store(StoreUserAdminRequest $request){
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->role = $request->get('role');
        $user->save();
        Session::flash('msg', 'Tạo mới người dùng '.$user->name.' thành công');

        return redirect()->route('backend.user.index');
    }
    public function update(Request $request, $id ){
        
        $user = User::findOrFail($id);
        $user->role = $request->get('role')==null?\Auth::user()->role:$request->get('role');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->password = $request->get('password')==null?$user->password:bcrypt($request->get('password'));
        $user->save();
        Session::flash('msg', 'Cập nhật người dùng '.$user->name.' thành công');

        return redirect()->route('backend.user.index');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
    }
}
