<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('backend.auth.forgot-password');
    }

    public function sendCodeResetPassword(Request $request){
        $email = $request->email;

        $checkUser = User::where('email', $email)->first();

        if(!$checkUser){
            alert()->warning('Đã xảy ra lỗi', 'Email không tồn tại');

            return redirect()->route('password.request');
        }

        $code = bcrypt(md5(time().$email));

        $checkUser->code = $code;
        $checkUser->time_code = Carbon::now();
        $checkUser->save();

        $url = route('get.link.reset.password', ['code' => $checkUser->code, 'email' => $email]);

        Mail::send('backend.auth.mailfb', array('name'=>$checkUser->name, 'url'=>$url), function($message) use ($checkUser){
            $message->to($checkUser->email, 'Visitor')->subject('Lấy lại mật khẩu');
        });

        alert()->success('Gửi email thành công', 'Link lấy lại mật khẩu đã được gửi vào email của bạn');

        return redirect()->route('password.request');
    }
}
