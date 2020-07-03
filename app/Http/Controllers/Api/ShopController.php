<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\ProductShop;
use App\Shop;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //show shop information based on the user id
    public function show()
    {
        try {
            $shop = Shop::where('user_id', auth()->user()->id)->get()->first();
            $shop_products = ProductShop::where(['shop_id' => $shop->id, 'status' => 1])->get();

            return parent::success($shop, $shop_products);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('shop not found');
        }
    }

    public function update(Request $request)
    {
        $shop = Shop::where('user_id', auth()->user()->id)->get()->first();

        $validation = Validator::make($request->all(), $this->rules('patch', $shop->id));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $data = $request->except(['image']);

        if ($request->image) {
            Storage::disk('public_uploads')->delete($shop->image);

            $data['image'] = parent::uploadImage($request->image);
        }
        $shop->update($data);

        return parent::success($shop);
    }

    //show all shop invoicecs and you can accecss each invoice info
    public function Invoices()
    {
        $shop = Shop::where('user_id', auth()->user()->id)->get()->first();
        $invoices = Invoice::where('shop_id', $shop->id)->get();

        return parent::success($invoices);
    }

    private function rules($method, $id = null)
    {
        $rules = [
            'address' => ['required'],
            'telephone_number' => ['required'],
        ];

        if ($method == 'patch') {
            $rules += [
                'name' => [
                    'required',
                    Rule::unique('shops')->ignore($id),
                ],
                'email' => [
                    'required',
                    Rule::unique('shops')->ignore($id),
                ],
            ];
        }

        return $rules;
    }
}
