<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'=>'required|min:5|max:255',
            'slug'=>'unique:categories'
        ];
        return $rules;
    }
    public function messages(){
        $messages=[
            'required' => ':attribute Không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min',
            'max' => ':attribute Không được lớn hơn :max',
            'unique' => ':attribute Đã tồn tại'
        ];
        return $messages;
    }
    public function attributes(){
        $attributes=[
            'name' => 'Tên danh mục',
            'slug' => 'Đường dẫn danh mục'
        ];
        return $attributes;
    }
}
