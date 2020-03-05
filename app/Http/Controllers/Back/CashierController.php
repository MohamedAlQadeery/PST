<?php

namespace App\Http\Controllers\Back;

use App\Shop;
use App\ProductShop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Item;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashierController extends Controller
{
    public function index()
    {
        $shops = Shop::all();

        return view('back.cashier.index')->with([
            'page_name' => 'cashier',
            'shops' => $shops,
        ]);
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        $products = ProductShop::where(['shop_id' => $id, 'status' => 1])->get();

        return view('back.cashier.show')->with([
            'shop' => $shop,
            'products' => $products,
        ]);
    }

    public function store(Request $request, $id)
    {
        // $validation = Validator::make($request->all(), $this->rules());
        // if ($validation->fails()) {
        //     return parent::error($validation->errors(), 404);
        // }

        $date = Carbon::now()->toDateTimeString();

        $invoice = Invoice::create(['date' => $date, 'total' => '0', 'shop_id' => $id]);
        $items_id = array();
        $sum = 0;
        $error_quantity = false;

        foreach ($request->data as $row) {
            $product = ProductShop::where(['product_id' => $row['product_id'], 'shop_id' => $id])->first();

            if ($row['quantity'] >= $product->quantity || $row['quantity'] == 0) {
                $error_quantity = true;
                break;
            }
        }

        if (!$error_quantity) {
            foreach ($request->data as $index => $row) {
                $product = ProductShop::where('product_id', $row['product_id'])->first();
                $product->quantity -= $row['quantity'];
                $product->save();
                $item = Item::create(['product_id' => $row['product_id'], 'quantity' => $row['quantity'], 'price' => $row['price']]);
                $items_id[$index] = $item->id;
                // $item->invoices()->attach($invoice->id);
                $sum += $row['price'];
            }
        } else {
            return response()->json(['error' => 1]);
        }
        $invoice->items()->attach($items_id);
        $invoice->update(['total' => $sum]);

        return response()->json(['id' => $invoice->id, 'error' => 0]);
    }

    // private function rules()
    // {
    //     return   [
    //         'data' => 'required',
    //     ];
    // }
}
