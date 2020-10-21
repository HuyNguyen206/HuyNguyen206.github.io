<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

class UpdateUserRequest extends FormRequest
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
        if (request()->has('change-pass')) {
            return [
                'name' => 'required',
                'password' => 'required',
                'password-repeat' => 'required|same:password',
                'roles' => 'required'
            ];
        }
        else
        {
            return [
                'name' => 'required',
                'roles' => 'required'
            ];

        }

    }

    public function messages()
    {
        if (request()->has('change-pass')) {
            return [
                'name.required' => 'Vui lòng nhập tên',
                'password.required' => 'Vui lòng nhập password',
                'password-repeat.required' => 'Vui lòng nhập xác nhận mật khẩu',
                'password-repeat.same' => 'Xác nhận mật khảu không khớp với mật khẩu',
                'roles.required' => 'Vui lòng chọn ít nhất một role'
            ];
        }
        else
        {
            return [
                'name.required' => 'Vui lòng nhập tên',
                'roles.required' => 'Vui lòng chọn ít nhất một role'
            ];
        }
    }
}
