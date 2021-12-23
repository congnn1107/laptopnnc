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

        // dd($this->input());
        $uniqueNameRule= Rule::unique('product','name')->ignore($this->id??0)->whereNull('deleted_at');
        $uniqueSkuRule = Rule::unique('product','sku')->ignore($this->id??0)->whereNull('deleted_at');
        return [
            //
            'name'=>['required',$uniqueNameRule],
            'sku' =>['required',$uniqueSkuRule],
            'card_image' =>['nullable','image'],
            'memory' => 'required',
            'memory_capacity' => 'required',
            'case_material' => 'required',
            'bluetooth' => 'required',
            'wifi' => 'required',
            'connection_port' => 'required',
            'keyboard' => 'required',
            'addition' => 'nullable',
            'ssd_storage' => 'nullable'
            
        ];
    }
    public function messages(){
        
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên không được trùng với sản phẩm khác',
            'sku.required' => 'SKU không được bỏ trống',
            'sku.unique' => 'SKU không được trùng với sản phẩm khác',
            'card_image.image' => 'Ảnh không hợp lệ',
            'memory.required' => 'Bộ nhớ ram không được bỏ trống',
            'memory_capacity.required' => 'Dung lượng ram không được bỏ trống',
            'case_material.required' => 'Không được bỏ trống Vỏ',
            'bluetooth.required' => 'Không được bỏ trống bluetooth',
            'wifi.required' => 'Không được bỏ trống wifi',
            'connection_port.required' => 'Không được bỏ trống cổng kết nối',
            'keyboard.required' => 'Không được bỏ trống bàn phím',
        ];
    }
    
}
