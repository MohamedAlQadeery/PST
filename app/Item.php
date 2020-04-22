<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    protected $with = ['product'];

    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'invoice_item');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function transactions()
    {
        return $this->belongsToMany('App\Transaction', 'item_transaction');
    }
}
