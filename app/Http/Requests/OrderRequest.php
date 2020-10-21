<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'transport_company' => 'required',
            'payment_method' => 'required'
        ];
    }

    public function messages()
    {
        return [
            //
            'transport_company.required' => 'Vui lòng chọn đơn vị vận chuyển',
            'payment_method.required' => 'Vui lòng chọn hình thức thanh toán'
        ];
    }
}
