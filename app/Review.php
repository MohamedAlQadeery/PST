<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    //the seller who wrote the review
    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id', 'id');
    }
}
