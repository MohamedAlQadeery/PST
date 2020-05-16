<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Product;
use App\Transaction;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('shop_id', auth()->user()->shop_id)->get();

        return view('site.transaction.index')->with('transactions', $transactions);
    }

    public function storeTransaction(Request $request, $provider_id, $type)
    {
        $date = Carbon::now()->toDateTimeString();

        $transaction = Transaction::create(['date' => $date, 'shop_id' => auth()->user()->shop->id,
         'provider_id' => $provider_id, 'total' => 0, 'type' => $type, 'status' => 0, ]); //invoice
        $items_id = array();
        $sum = 0;
        $error_quantity = false;

        foreach ($request->data as $row) {
            $product = Product::where(['id' => $row['productId']])->first();

            if ($row['productQuantity'] >= $product->quantity || $row['productQuantity'] == 0) {
                $error_quantity = true;
                break;
            }
        }

        if (!$error_quantity) {
            foreach ($request->data as $index => $row) {
                $product = Product::where('id', $row['productId'])->first();
                $product->quantity -= $row['productQuantity']; //substract the quantity from the databse
                $product->save();

                $item = Item::create(['product_id' => $row['productId'], 'quantity' => $row['productQuantity'], 'price' => $row['productTotal']]);
                $items_id[$index] = $item->id;
                $sum += $row['productTotal'];
                \Cart::remove($row['productId']); //empty the cart with that item
            }
        } else {
            return response()->json(['error' => 1]);
        }

        $transaction->items()->attach($items_id);
        $transaction->update(['total' => $sum]);

        return response()->json(['error' => 0]);
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $carbon = new Carbon($transaction->date);
        $transaction_date = $carbon->toFormattedDateString();

        return view('site.transaction.show')->with([
                'transaction' => $transaction,
                'transaction_date' => $transaction_date,
            ]);
    }
}
