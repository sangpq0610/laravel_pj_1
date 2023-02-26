<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'origin_price'=>'required|numeric',
            'sale_price'=>'required|numeric',
            'amount'=>'required|numeric|min:0',
            'content'=>'required|min:10',
            'images'=>'required',
            'slug'=>'unique:products'
        ];
        return $rules;
    }
    public function messages(){
        $messages=[
            'required' => ':attribute Không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min',
            'max' => ':attribute Không được lớn hơn :max',
            'image' => ':attribute Không phải file ảnh',
            'unique' => ':attribute Đã tồn tại'
        ];
        return $messages;
    }
    public function attributes(){
        $attributes=[
            'name' => 'Tên sản phẩm',
            'origin_price' => 'Giá gốc',
            'sale_price' => 'Giá bán',
            'amount' =>'Số lượng trong kho',
            'content' =>'Mô tả sản phẩm',
            'images' =>'Ảnh sản phẩm',
            'slug' => 'Đường dẫn sản phẩm'
        ];
        return $attributes;
    }
}
