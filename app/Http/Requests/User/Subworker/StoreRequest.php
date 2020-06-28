<?php

namespace App\Http\Requests\User\Subworker;

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
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'third_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'numeric'],
            'dob' => ['required'],
            'gender' => ['required'],
            'mobile_number' => ['required'],
            'roles' => 'required',
            'roles.*' => 'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        } elseif ($this->getMethod() == 'PATCH') {
            $user = $this->subworker;
            $rules += [
                   'email' => [
                       'required',
                       Rule::unique('users')->ignore($user),
                   ],
               ];
        }

        return $rules;
    }
}
