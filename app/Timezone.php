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

    public function setGMTOffset() {
        $zone= new \DateTimeZone($this->name);
        $gmt= new \DateTime('now', new \DateTimeZone('Europe/London'));
        $this->gmt_offset =  $zone->getOffset($gmt)/3600;
        return $this;
    }

    /**
     * Returns name with UTC offset
     *
     * @return string
     */
    public function getLabel() : string {
        if($this->gmt_offset >= 0){
            return "(UTC (+".number_format($this->gmt_offset, 2).") - $this->name";
        }
            return "(UTC (".number_format($this->gmt_offset, 2).") - $this->name";
    }
}
