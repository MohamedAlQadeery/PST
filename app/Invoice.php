<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'invoice_item');
    }
}
