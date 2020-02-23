<?php

namespace App\Http\Requests\Back\Category;

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
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'name' => ['required', 'string', 'unique:categories'],
            ];
        }

        if ($this->getMethod() == 'PATCH') {
            $rules += [
                   'name' => [
                       'required',
                       Rule::unique('categories')->ignore($this->category),
                   ],
               ];
        }

        return $rules;
    }
}
