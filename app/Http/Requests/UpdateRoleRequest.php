<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
//            'permission' => 'required',
            'display_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên role',
//            'permission.required' => 'Vui lòng assign permission cho role',
            'display_name.required' => 'Vui lòng nhập mô tả role'
        ];
    }
}
