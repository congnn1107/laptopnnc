<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GPURequest extends FormRequest
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
        $uniqueNameRule = Rule::unique('gpu','name')->ignore($this->id??0)->whereNull('deleted_at');
        return [
            //
            'name' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Không được bỏ trống tên!",
            'name.unique' => "Tên \"$this->name\" đã được sử dụng!"
        ];
    }
}
