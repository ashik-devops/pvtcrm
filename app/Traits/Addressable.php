<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Addressable{

    public function addresses():MorphMany{
        return $this->morphMany('App\Address', 'addressable');
    }

}