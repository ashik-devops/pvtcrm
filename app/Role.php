<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public function profile(){
        return $this->hasMany('App\User');
    }


    public function policies(){
        return $this->belongsToMany('App\Policy', 'roles_policies', 'role_id', 'policy_id');
    }
}
