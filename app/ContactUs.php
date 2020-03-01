<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getImage()
    {
        if (!$this->image) {
            return asset('uploads/no-image.jpg');
        }

        return asset('uploads/'.$this->image);
    }
}
