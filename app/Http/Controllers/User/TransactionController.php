<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductShop;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:all-shoppermissions|index-usertransaction')->only('index');
        $this->middleware('permission:all-shoppermissions|pay-usertransaction')->only('paid');
        $this->middleware('permission:all-shoppermissions|status-usertransaction')->only('status');
    }

    public function index()
    {
        $transactions = Transaction::where([]);
        if (auth()->user()->type == 1) {
            $transactions = $transactions->where('shop_id', auth()->user()->shop->id);
        } else {
            $transactions = $transactions->where('provider_id', auth()->user()->id);
        }

        $transactions = $transactions->get();

        return view('users.transaction.index')->with([
            'page_name' => 'transactions',
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $carbon = new Carbon($transaction->date);
        $transaction_date = $carbon->toFormattedDateString();

        return view('users.transaction.show')->with([
            'page_name' => 'transaction',
            'transaction' => $transaction,
            'transaction_date' => $transaction_date,
        ]);
    }

    //change the status of the transaction to delevired or not
    public function status($id)
    {
        $transaction = Transaction::findOrFail($id);
        //first update the user shop Product and the product sell count
        foreach ($transaction->items as $item) {
            $product = Product::where('id', $item->product_id)->get()->first();
            ++$product->sell_count;
            $product->update();
            $productExist = ProductShop::where('product_id', $item->product_id)->get()->first();
            if ($productExist) {
                $productShop = ProductShop::where('product_id', $item->product_id)->get()->first();
                $productShop->quantity += $item->quantity; //just increment quantity
               $productShop->price = $item->price / $item->quantity; //update price if changed
               $productShop->update();
            } else {
                ProductShop::create([
                   'product_id' => $item->product_id,
                   'quantity' => $item->quantity,
                   'shop_id' => auth()->user()->shop_id,
                   'status' => 1,
                   'sell_count' => 0,
                   'price' => $item->price / $item->quantity,
               ]);
            }
        }
        $transaction->status == 0 ? $transaction->status = 1 : $transaction->status = 0;
        //  $transaction->status == 0 ? $transaction->type = 1 : $transaction->status = 0 ; //change tje type of the bill
        $transaction->save();
        if (auth()->user()->type == 0) {
            return redirect()->route('transactions.index')->with('success', __('site.change_status_successfully'));
        }

        return redirect()->route('user.transactions.index')->with('success', __('site.change_status_successfully'));
    }

    //change the paid status of the transaction to paid or not
    public function paid($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->is_paid == 0 ? $transaction->is_paid = 1 : $transaction->is_paid = 0;
        // $transaction->status == 0 ? $transaction->type = 1 : $transaction->status = 0 ; //change tje type of the bill

        $transaction->save();
        if (auth()->user()->type == 0) {
            return redirect()->route('transactions.index')->with('success', __('site.change_status_successfully'));
        }

        return redirect()->route('user.transactions.index')->with('success', __('site.change_status_successfully'));
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        foreach ($transaction->items as $item) {
            $item->delete();
        }
        $transaction->items()->sync([]);
        $transaction->delete();

        return redirect()->route('user.transactions.index')->with('success', __('site.deleted_successfully'));
    }
}
