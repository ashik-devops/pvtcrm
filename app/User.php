<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

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
        return $this->role->name === 'Administrator' && !is_null($this->role->policies()->where(['action'=>'*', 'scope'=>'*'])->first());
    }
    public function isSuperAdmin(){
        return $this->role->name === 'Super Admin' && $this->role->id==1 && !is_null($this->role->policies()->where(['action'=>'*', 'scope'=>'*'])->first());
    }
}
