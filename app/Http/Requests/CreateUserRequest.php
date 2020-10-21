<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password-repeat' => 'required|same:password',
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Vui lòng nhập password',
            'password-repeat.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'password-repeat.same' => 'Xác nhận mật khảu không khớp với mật khẩu',
            'roles.required' => 'Vui lòng chọn ít nhất một role'
        ];
    }
}
