<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens ,Notifiable, SoftDeletes, CausesActivity, LogsActivity{
    LogsActivity::activity insteadof CausesActivity;
    CausesActivity::activity as log;
}

    public $obj_alias = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\User_profile');
    }
    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function customers(){
        return $this->hasMany('App\Customer');
    }

    public function isAdmin(){
        return !is_null($this->role->policies()->where('action','*')->where('scope','*')->first());
    }
    public function isSuperAdmin(){
        return $this->role->id==1 && !is_null($this->role->policies()->where('action','*')->where('scope','*')->first());
    }

    public function salesTeams(){
        return $this->belongsToMany('App\Sales_team', 'sales_teams_users');
    }
    public function getLink(): string {
        if($this->id > 0){
            return route('profile-edit', $this->id);
        }

        return '#';
    }

    public function getActivityTitle(): string {
        if($this->id > 0){
            return $this->user->name;
        }

        return "";
    }
}
