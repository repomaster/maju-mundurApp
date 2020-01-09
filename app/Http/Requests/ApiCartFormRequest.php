<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiCartFormRequest extends FormRequest
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
            'products.*.merchant_id' => 'required|numeric',
            'products.*.product_id' => 'required|numeric',
            'products.*.qty' => 'required|numeric',
        ];
    }
}
