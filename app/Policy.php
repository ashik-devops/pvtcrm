<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    public function users(){
        return $this->belongsToMany('App\User', 'users_policies', 'policy_id', 'user_id');
    }
}
