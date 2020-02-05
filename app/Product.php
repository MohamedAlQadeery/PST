<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //


    public function shops(){
        return $this->belongsToMany('App\Shop','product_shop');
    }
}
