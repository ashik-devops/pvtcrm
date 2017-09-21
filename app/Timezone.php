<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Timezone extends Model
{
    public function country():BelongsTo{
        return $this->belongsTo('App\Country');
    }

    public function profiles():HasMany{
        return $this->hasMany('App\User_profile');
    }
}
