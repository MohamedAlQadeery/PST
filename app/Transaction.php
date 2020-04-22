<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function provider()
    {
        return $this->belongsTo('App\User', 'provider_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_transaction');
    }
}
