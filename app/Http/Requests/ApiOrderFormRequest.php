<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiOrderFormRequest extends FormRequest
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
        if ($this->has('status')) {
            return [
                'status' => 'required|string'
            ];
        }

        return [
            'payment_option_id' => 'required|string',
            'shipping_address' => 'required|string',
            'products.*.merchant_id' => 'required|numeric',
            'products.*.product_id' => 'required|numeric',
            'products.*.qty' => 'required|numeric',
        ];
    }
}
