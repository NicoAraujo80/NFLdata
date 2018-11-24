<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function stats()
    {
        return $this->hasMany('App\Stat');
    }
}
