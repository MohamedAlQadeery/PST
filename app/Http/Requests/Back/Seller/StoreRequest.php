<?php

namespace App\Http\Requests\Back\Seller;

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
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required', 'numeric'],
            'dob' => ['required'],
            'gender' => ['required'],
            'shop_name' => ['required', 'unique:shops,name'],
            'shop_address' => ['required'],
            'telephone_number' => ['required'],
            'mobile_number' => ['required'],

            'shop_email' => ['required', 'string', 'email', 'max:255', 'unique:shops,email'],
            'bio' => ['required'],
        ];
    }
}
