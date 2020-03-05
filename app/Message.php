<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    protected $with = ['replies'];

    //returns the user that recived the message
    public function user()
    {
        return $this->belongsTo('App\User', 'to_id');
    }

    //returns the user that sent the message
    public function from()
    {
        return $this->belongsTo('App\User', 'from_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Message', 'parent_id');
    }
}
