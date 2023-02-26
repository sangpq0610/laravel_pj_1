<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showResetForm(Request $request){
        $code = $request->code;
        $email = $request->email;

        $checkUser = User::where([
            'code' => $code,
            'email' => $email,
        ])->first();
        if(!$checkUser){
            alert()->warning('Đã xảy ra lỗi', 'Xin lỗi đường dẫn lấy lại mật khẩu không chính xác, xin vui lòng thử lại ');
            return redirect('/');
        }
        return view('backend.auth.recover-password');
    }

    public function ResetPassword(Request $request){
        if($request->password){
            $validator = Validator::make($request->all(), 
                [
                    'password' => ['required', 'min:6', 'confirmed'],
                ],
                [
                    'required'=>'Bắt buộc điền :attribute',
                    'min'=>':attribute không được nhỏ hơn :min kí tự',
                    'confirmed'=>':attribute nhập lại không chính xác',
                ],
                [
                    'password' => 'Mật khẩu',
                ]
            );

            if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
            }

            $code = $request->code;
            $email = $request->email;

            $checkUser = User::where([
                'code' => $code,
                'email' => $email
            ])->first();

            if(!$checkUser){
                alert()->warning('Đã xảy ra lỗi', 'Xin lỗi đường dẫn lấy lại mật khẩu không chính xác, xin vui lòng thử lại ');
                return redirect('/');
            }

            $checkUser->password = Hash::make($request->password);
            $checkUser->save();
            alert()->success('Thành công', 'Bạn đã thay đổi mật khẩu thành công! Vui lòng đăng nhập');
            return redirect()->route('login');
        }
    }
}
