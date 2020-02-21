<?php

namespace App\Http\Controllers\Back;

use App\Invoice;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Shop;

class InvoiceController extends Controller
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }

    public function index($id = null)
    {
        $invoices = Invoice::where([]);
        $shop_name = '';
        if (!is_null($id)) {
            $invoices = $invoices->where('shop_id', $id);
            $shop_name = Shop::findOrFail($id)->name;
        }

        $invoices = $invoices->get();

        return view('back.invoice.index')->with([
            'page_name' => parent::getPluralModelName(),
            'invoices' => $invoices,
            'shop_name' => $shop_name,
        ]);
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

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->items()->sync([]);
        foreach ($invoice->items as $item) {
            $item->delete();
        }
        $invoice->delete();

        return redirect()->route('invoice.index')->with('success', __('site.deleted_successfully'));
    }
}
