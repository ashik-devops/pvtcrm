<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public $obj_alias = 'Role';

    public function users() : HasMany{
        return $this->hasMany('App\User');
    }


    public function policies() : BelongsToMany{
        return $this->belongsToMany('App\Policy', 'roles_policies', 'role_id', 'policy_id');
    }

    public function getLink(): string {
        return '#';
    }
}
