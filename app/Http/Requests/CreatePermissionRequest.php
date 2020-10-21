<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
            'name' => 'required',
            'display_name' => 'required',
            'key_code' => 'required',
        ];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'Vui lòng nhập tên quyền',
            'display_name.required' => 'Vui lòng nhập mô tả quyền',
            'key_code.required' => 'Vui lòng nhập key code cho quyền',
        ];
    }
}
