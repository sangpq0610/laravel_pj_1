<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role==1||Auth::user()->role==2){
            return true;
        }
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules=[
            'name'=>'required|min:5|max:50',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed|min:6',
            'address'=>'required|min:5|max:50',
            'phone'=>'required|numeric|min:10',
        ];
        return $rules;
    }
    public function attributes(){
        $attributes=[
            'name'=>'Tên người dùng',
            'email'=>'Email liên hệ',
            'password'=>'Mật khẩu',
            'address'=>'Địa chỉ',
            'phone'=>'Số điện thoại',
        ];
        return $attributes;
    }
    public function messages(){
        $messages=[
            'required'=>'Bắt buộc điền :attribute',
            'min'=>':attribute không được nhỏ hơn :min',
            'max'=>':attribute không được quá :max',
            'confirmed'=>':attribute nhập lại không chính xác',
            'numeric'=>':attribute phải là số',
            'unique'=>':attribute Đã tồn tại'
        ];
        return $messages;
    }
}
