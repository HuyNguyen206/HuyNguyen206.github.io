<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'email' => 'email|required|exists:users,email'
        ];
    }

    public function messages()
    {
        return
        [
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.required' => 'Vui lòng nhập email',
            'email.exists' => 'Email không tồn tại trong DB'
        ];
    }
}
