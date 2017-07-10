<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_team extends Model
{
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
