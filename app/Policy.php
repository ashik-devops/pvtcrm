<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    public function users(){
        return $this->belongsToMany('App\Role', 'roles_policies', 'policy_id', 'role_id');
    }
}
