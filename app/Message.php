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

    //returns the user that recieved the message
    public function to()
    {
        return $this->belongsTo('App\User', 'to_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Message', 'parent_id')->orderBy('id', 'asc');
    }

    //its a replay message and parent function gets the parent of the replay
    public function parent()
    {
        return $this->belongsTo('App\Message', 'parent_id');
    }
}
