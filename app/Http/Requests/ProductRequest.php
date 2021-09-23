<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueNameRule= Rule::unique('product','name')->ignore($this->id??0)->whereNull('deleted_at');
        $uniqueSkuRule = Rule::unique('product','sku')->ignore($this->id??0)->whereNull('deleted_at');
        return [
            //
            'name'=>['required',$uniqueNameRule],
            'sku' =>['required',$uniqueSkuRule],
            'card_image' =>['nullable','image'],
            'memory_slots' => ['required','min:1'],
            'memory_type' => 'required',
            'memory_capacity' => 'required',
            'case_material' => 'required',
            'bluetooth' => 'required',
            'wifi' => 'required',
            'connection_jacks' => 'required',
            'keyboard' => 'required'
            
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên không được trùng với sản phẩm khác',
            'sku.required' => 'SKU không được bỏ trống',
            'sku.unique' => 'SKU không được trùng với sản phẩm khác',
            'card_image.image' => 'Ảnh không hợp lệ',
            'memory_slots.required' => 'Không được bỏ trống',
            'memory_slots.min' => 'Yêu cầu giá trị tối thiểu là 1',
            'memory_type.required' => 'Không được bỏ trống',
            'memory_capacity.required' => 'Không được bỏ trống',
            'case_material.required' => 'Không được bỏ trống',
            'bluetooth.required' => 'Không được bỏ trống',
            'wifi.required' => 'Không được bỏ trống',
            'connection_jacks.required' => 'Không được bỏ trống',
            'keyboard.required' => 'Không được bỏ trống',
        ];
    }
}
