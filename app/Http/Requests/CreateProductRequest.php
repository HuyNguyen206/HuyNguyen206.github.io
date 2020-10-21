<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'bail|required',
            'price' => 'required',
            'contents' => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'contents.required' => 'Vui lòng nhập nội dung sản phẩm',
            'category_id.required' => 'Vui lòng nhập danh mục sản phẩm'
        ];
    }
}
