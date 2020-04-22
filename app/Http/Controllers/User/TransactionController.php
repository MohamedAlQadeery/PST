<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
