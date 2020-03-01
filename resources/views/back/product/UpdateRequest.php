<?php

namespace App\Http\Requests\Back\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'price_to_sell' => ['required', 'numeric'],
            'price_to_buy' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'category' => ['required'],
            'status' => ['required'],
            
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'name' => ['required', 'string', 'max:255', 'unique:products'],
                'barcode' => ['required', 'string', 'barcode', 'max:255', 'unique:products'],
            ];
        }

        if ($this->getMethod() == 'PATCH') {
            $rules += [
                'name' => [
                    'required',
                    Rule::unique('products')->ignore($this->product),
                ],
                'barcode' => [
                    'required',
                    Rule::unique('products')->ignore($this->product),
                ],
            ];
        }

        return $rules;


      
    }
}
