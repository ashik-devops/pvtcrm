<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User_profile extends Model
{

    public $obj_alias = 'User Profile';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function timezone():BelongsTo{
        return $this->belongsTo('App\Timezone');
    }

    public function getLink(): string {
        if($this->id > 0){
            return route('profile-edit', $this->user->id);
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
