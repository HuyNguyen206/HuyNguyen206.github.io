<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBootstrapPermissionRequest extends FormRequest
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
        return [
            'parent_module' => 'required',
            'permission' => 'required'
            //
        ];
    }

    public function messages()
    {
        return [
            'parent_module.required' => 'Vui lòng chọn module cha',
            'permission.required' => 'Vui lòng chọn permission',
        ];
    }
}
