<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSettingRequest extends FormRequest
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
            'config_key' => 'required|unique:settings|max:255',
            'config_value' => 'required'
            //
        ];
    }

    public function messages()
    {
        return  [
            'config_key.required' => 'Vui lòng nhập config key',
            'config_key.unique' => 'Config key này đã tồn tại rồi',
            'config_key.max' => 'Config key có độ dài tối đa 255 ký tự',
            'config_value.required' => 'Vui lòng nhập config value',

            //
        ];
    }
}
