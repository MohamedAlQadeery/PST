<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductShop extends Model
{
    protected $table = 'product_shop';

    protected $with = ['product'];
    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
