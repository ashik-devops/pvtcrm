<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    protected static $logAttributes = ['name', 'policyjson' ];
    protected static $logOnlyDirty = true;


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

    public function getActivityTitle(): string{

        if($this->id > 0){
            return $this->name;
        }
        return '';
    }

    public function getPolicyjsonAttribute(){
        $this->load(['policies']);


        $policies = $this->policies->map(function ($policy){
                return $policy->load(['action', 'scope']);
        });

        return json_encode($policies);
    }





}
