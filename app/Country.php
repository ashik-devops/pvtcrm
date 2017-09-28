<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    public function timezones(): HasMany{
        return $this->hasMany('App\Timezone');
    }

    public function states(): HasMany{
        return $this->hasMany('App\State');
    }
}