<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;

class Address extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Address';

    public function addressable():MorphTo{
        return $this->morphTo('addressable');
    }
    public function getLink(): string {

        return '#';
    }

    public function getActivityTitle(): string{

        if($this->id > 0){
            if(!is_null($this->addressable)){
                return "Address of ".$this->addressable->getActivityTitle();
            }
        }
        return '';
    }


}
