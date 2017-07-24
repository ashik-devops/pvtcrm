<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Sales_team extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Team';

    public function users(){
        return $this->belongsToMany('App\User', 'sales_teams_users');
    }

    public function manager(){
        foreach ($this->users as $user){
            if(!is_null($user->role->policies()->whereIn('scope',['*','team'])->where('action','*')->first()))
                return $user;
        }
    }
}
