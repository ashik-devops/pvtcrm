<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{

    public $obj_alias = 'User';

    public function user(){
        return $this->belongsTo('App\User');
    }

}
