<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDO;

class SellerController extends Controller
{



    public function store(Request $request)
    {


        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }


        $seller_data = $request->except([
            'shop_name', 'shop_address', 'telephone_number', 'shop_email',
            'password', 'password_confirmation', 'dob', 'image',
        ]);
        $seller_data['password'] = Hash::make($request->password);
        $seller_data['type'] = 1; //1 is seller 2 is provider
        $date = strtotime($request->dob);
        $seller_data['dob'] = date('Y-m-d', $date);

        $user = User::create($seller_data);

        if ($request->image) {
            $image = parent::uploadImage($request->image);
            User::where('id', $user->id)->update(['image' => $image]);
        }
        $shop_data = $request->only(['shop_name', 'shop_address', 'telephone_number', 'shop_email']);
        $shop_data['user_id'] = $user->id;
        $shop = Shop::create([
            'name' => $shop_data['shop_name'],
            'address' => $shop_data['shop_address'],
            'telephone_number' => $shop_data['telephone_number'],
            'email' => $shop_data['shop_email'],
            'user_id' => $shop_data['user_id'],
        ]);
        User::where('id', $user->id)->update(['shop_id' => $shop->id]);
        $user->assignRole('صاحب المتجر');

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
            'address' => ['required'],
            'gender' => ['required'],
            'shop_name' => ['required', 'unique:shops,name'],
            'shop_address' => ['required'],
            'telephone_number' => ['required'],
            'mobile_number' => ['required'],

            'shop_email' => ['required', 'string', 'email', 'max:255', 'unique:shops,email'],
        ];
    }
}
