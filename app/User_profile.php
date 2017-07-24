<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{

    public $obj_alias = 'User';

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getLink(): string {
        if($this->id > 0){
            return route('profile-edit', $this->user->id);
        }

        return '#';
    }
}
