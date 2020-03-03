<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function reciever_id()
    {
        return $this->belongsTo('App\User', 'reciever_id');
    }
}
