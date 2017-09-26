<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Policy extends Model
{

    public $obj_alias = 'Policy';

    public function users() : BelongsToMany{
        return $this->belongsToMany('App\Role', 'roles_policies', 'policy_id', 'role_id');
    }
    public function action() : BelongsTo{
        return $this->belongsTo('App\Action');
    }
    public function scope() : BelongsTo{
        return $this->belongsTo('App\Scope');
    }
    public function getLink(): string {
        return '#';
    }
}
