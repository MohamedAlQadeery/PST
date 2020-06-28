<?php

namespace App\Http\Controllers\Back;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Transaction $model)
    {
        $this->middleware('permission:delete-transaction|all')->only('destroy');
        parent::__construct($model);
    }

    public function index()
    {
        $transactions = Transaction::with(['provider', 'shop'])->get();

        return view('back.transaction.index')->with([
            'page_name' => parent::getPluralModelName(),
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

        return view('back.transaction.show')->with([
            'page_name' => 'transaction',
            'transaction' => $transaction,
            'transaction_date' => $transaction_date,
        ]);
    }

    // //change the status of the transaction to delevired or not
    // public function status($id)
    // {
    //     $transaction = Transaction::findOrFail($id);

    //     $transaction->status == 0 ? $transaction->status = 1 : $transaction->status = 0;
    //     //  $transaction->status == 0 ? $transaction->type = 1 : $transaction->status = 0 ; //change tje type of the bill

    //     $transaction->save();
    //     if (auth()->user()->type == 0) {
    //         return redirect()->route('admin.transaction.index')->with('success', __('site.change_status_successfully'));
    //     }

    //     return redirect()->route('user.transaction.index')->with('success', __('site.change_status_successfully'));
    // }

    // //change the paid status of the transaction to paid or not
    // public function paid($id)
    // {
    //     $transaction = Transaction::findOrFail($id);

    //     $transaction->is_paid == 0 ? $transaction->is_paid = 1 : $transaction->is_paid = 0;
    //     // $transaction->status == 0 ? $transaction->type = 1 : $transaction->status = 0 ; //change tje type of the bill

    //     $transaction->save();
    //     if (auth()->user()->type == 0) {
    //         return redirect()->route('admin.transaction.index')->with('success', __('site.change_status_successfully'));
    //     }

    //     return redirect()->route('user.transaction.index')->with('success', __('site.change_status_successfully'));
    // }

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
        $transaction = Transaction::findOrFail($id);
        foreach ($transaction->items as $item) {
            $item->delete();
        }
        $transaction->items()->sync([]);
        $transaction->delete();

        return redirect()->route('admin.transaction.index')->with('success', __('site.deleted_successfully'));
    }
}
