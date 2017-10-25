<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
//use Spatie\Activitylog\Traits\LogsActivity;

class Sales_team extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Team';

    public function members(){
        return $this->belongsToMany('App\User', 'sales_teams_users')->withPivot(['role']);
    }

    public function getLink(): string {

        return '#';
    }
    public function getActivityTitle(): string {
        if($this->id > 0){
            return $this->name;
        }
    }
}
