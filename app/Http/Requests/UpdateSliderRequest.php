<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'feature_image' => 'image'
        ];
    }

    public function messages()
    {
        return
            [
                'name.required' => 'Vui lòng nhập tên slide',
                'description.required' => 'Vui lòng nhập mô tả slide',
                'feature_image.image' => 'Vui lòng chọn đúng định hình upload'
            ];
    }

}
