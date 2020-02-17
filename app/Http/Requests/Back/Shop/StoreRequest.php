<?php

namespace App\Http\Requests\Back\Shop;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'telephone_number' => ['required'],
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'name' => ['required', 'string', 'max:255', 'unique:shops'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:shops'],
            ];
        }

        if ($this->getMethod() == 'PATCH') {
            $rules += [
                   'name' => [
                       'required',
                       Rule::unique('shops')->ignore($this->shop),
                   ],
                   'email' => [
                    'required',
                    Rule::unique('shops')->ignore($this->shop),
                ],
               ];
        }

        return $rules;
    }
}
