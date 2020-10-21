<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
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
            'name' => 'required',
            'password_register' => 'required',
            'email_register' => 'email|required|unique:users,email',
            'password_confirmation' => 'required|same:password_register',
            'phone' => 'required| digits_between:10, 15',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required'
        ];
    }

    public function messages()
    {
        return [
            //
            'name.required'=> 'Vui lòng nhập tên',
            'password_register.required' => 'Vui lòng nhập password',
            'email_register.unique' => 'Email này đã tồn tại rồi',
            'email_register.required' => 'Vui lòng nhập email',
            'email_register.email' => 'Vui lòng nhập đúng định dạng email',
            'password_confirmation.same' => 'Vui lòng nhập xác nhận password giống với password',
            'password_confirmation.required' => 'Vui lòng nhập xác nhận password'
        ];
    }
}
