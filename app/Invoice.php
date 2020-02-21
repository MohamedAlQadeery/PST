<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    protected $with = ['items', 'shop'];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'invoice_item');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
}
