<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [];

    //returns the owner of the shop
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_shop');
    }

    public function getImage()
    {
        if (!$this->image) {
            return asset('uploads/no-image.jpg');
        }

        return asset('uploads/'.$this->image);
    }
}
