<?php

namespace App\Http\Controllers\Back;

use App\ProductShop;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getProduct($shop_id, $product_id)
    {
        $product = ProductShop::with(['product', 'shop'])->where(['product_id' => $product_id, 'shop_id' => $shop_id])->first();

        return response()->json([
            'product' => $product,
            'success' => 'Got Sample Ajax Request',
        ]);
    }
}
