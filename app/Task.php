<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
