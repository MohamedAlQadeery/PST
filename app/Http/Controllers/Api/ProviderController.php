<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $data = $request->except(['password', 'image', 'dob', 'password_confirmation']);

        $data['password'] = Hash::make($request->password);
        $data['type'] = 2; // 2 is provider

        $date = strtotime($request->dob);
        $data['dob'] = date('Y-m-d', $date);
        $user = User::create($data);
        if ($request->image) {
            $image = parent::uploadImage($request->image);
            User::where('id', $user->id)->update(['image' => $image]);
        }

    
        return parent::success($user);

    }


     private function rules($method, $id = null)
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
            'address' => ['required'],
            'mobile_number' => ['required'],


        ];
    }

}
