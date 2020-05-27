<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::where('user_id', auth()->user()->id)->get();

        return Parent::success($products);
    }

    public function showProductsInShop()
    {
        $shop_products = ProductShop::where('shop_id', auth()->user()->shop_id)->get();

        return Parent::success($shop_products);
    }

    public function store(Request $request)
    {


        $validation = Validator::make($request->all(), $this->rules('post'));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $data = $request->except(['image']);

        $product = Product::create($data);

        if ($request->image) {
            $image = parent::uploadImage($request->image);

            Product::where('id', $product->id)->update(['image' => $image]);
        }

        return Parent::success($product);
    }


    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), $this->rules('put',$id));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $product = Product::findOrFail($id);
        $data = $request->except(['image']);

        if ($request->image) {
            Storage::disk('public_uploads')->delete($product->image);

            $data['image'] = parent::uploadImage($request->image);
        }
        $product->update($data);

        return Parent::success($product);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if (isset($product->image)) {
            Storage::disk('public_uploads')->delete($product->image);
        }
        $product->delete();

        return Parent::success($product);
    }


    private function rules($method, $id = null)
    {
        $rules = [
            'price_to_sell' => ['required', 'numeric'],
            'price_to_buy' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'category_id' => ['required'],
            // 'status' => ['required'],
        ];

        if ($method == 'post') {
            $rules += [
                'name' => ['required', 'string', 'max:255', 'unique:products'],
                'barcode' => ['required', 'string', 'max:255', 'unique:products'],
            ];
        }

        if ($method == 'put') {
            $rules += [
                'name' => [
                    'required',
                    Rule::unique('products')->ignore($id),
                ],
                'barcode' => [
                    'required',
                    Rule::unique('products')->ignore($id),
                ],
            ];
        }

        return $rules;
    }
}
