<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $guarded = [];

    protected $with = ['replies'];

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

    public function replies()
    {
        return $this->hasMany('App\ContactUs', 'parent_id')->orderBy('id', 'asc');
    }

    //parent relation
    public function parent()
    {
        return $this->belongsTo('App\Contactus', 'parent_id', 'id');
    }
}
