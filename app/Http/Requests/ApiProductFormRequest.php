<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiProductFormRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric|digits_between:1,10',
            'description' => 'required|string',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpg,jpeg,png';
        }

        return $rules;
    }
}
