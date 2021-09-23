<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CPURequest extends FormRequest
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
        $uniqueNameRule = Rule::unique('cpu','name')->ignore($this->id??0)->whereNull('deleted_at');
        return [
            //
            'name' => ['required',$uniqueNameRule]
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên CPU không được để trống!",
            "name.unique" => "Tên CPU không được trùng, \"$this->name\" đã được sử dụng!"
        ];
    }
}
