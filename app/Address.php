<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Address extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Address';

    public function customer(){
        return $this->belongsToMany('App\Customer', 'customer_addresses', 'address_id', 'customer_id');
    }
    public function company(){
        return $this->belongsToMany('App\Customer', '`customers_company_addresses`', 'address_id', 'customer_company_id');
    }
    public function getLink(): string {

        return '#';
    }

}
