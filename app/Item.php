<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function invoices()
    {
        return $this->belongsToMany('App\Invoice', 'invoice_item');
    }
}
