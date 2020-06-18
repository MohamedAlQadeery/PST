<?php

namespace App\Http\Controllers\User;

use App\Shop;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Shop::findOrFail(auth()->user()->shop_id);

        $invoices = Invoice::where('shop_id', $shop->id)->get();

        return view('back.invoice.index')->with([
            'page_name' => 'invoices',
            'invoices' => $invoices,
            'shop_name' => $shop->name,
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

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $carbon = new Carbon($invoice->date);
        $invoice_date = $carbon->toFormattedDateString();

        return view('back.invoice.show')->with([
            'page_name' => parent::getPluralModelName(),
            'invoice' => $invoice,
            'invoice_date' => $invoice_date,
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

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $shop = Shop::findOrFail($invoice->shop_id);
        foreach ($invoice->items as $item) {
            $item->delete();
        }
        $invoice->items()->sync([]);
        $invoice->delete();

        return redirect()->route('user.invoice.index', $shop->id)->with('success', __('site.deleted_successfully'));
    }
}
