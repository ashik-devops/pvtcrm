<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public function addresses(){
        return $this->hasMany('App\Address');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
