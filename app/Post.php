<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function Notes()
    {
        return $this->hasMany('App\Note');
    }
}
