<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassRequest extends FormRequest
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
            //
            'email' => 'required|exists:users,email|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return
        [
            'email.required' => 'Vui lòng nhập email',
            'email.exists' => 'Email không tồn tại',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password',
            'password_confirmation.required' => 'Vui lòng nhập xác nhận password',
            'password_confirmation.same' => 'Xác nhận password không giống với password',
        ];
    }
}
