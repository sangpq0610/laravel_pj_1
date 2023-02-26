<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }
    public function test(){
        // $flag = Storage::move('old2/test1.txt', 'new/test1.txt');
        // dd($flag);
        // $url = Storage::disk('local')->url('test1.txt');
        // dd($url);
        // $files = Storage::files();
        // dd($files);
        // Storage::disk('public')->makeDirectory('images');

        return view('frontend.test');
    }
    public function getTest(Request $request){
        dd($request->get('roles'));
    }
    public function addFeedback(Request $request)
    {
        $input = $request->all();
        Mail::send('mailfb', array('name'=>$input["name"],'email'=>$input["email"], 'content'=>$input['comment']), function($message){
            $message->to(' ĐIỀN EMAIL CỦA BẠN MUỐN NHẬN MAIL VÀO ĐÂY', 'Visitor')->subject('Visitor Feedback!');
        });
        Session::flash('flash_message', 'Send message successfully!');

        return view('backend.auth.form-mail');
    }
}
