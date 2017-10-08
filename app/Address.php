<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\DetectsChanges;

class Address extends Model
{
    use SoftDeletes;
//    , CausesActivity, LogsActivity{
//        LogsActivity::activity insteadof CausesActivity;
//        CausesActivity::activity as log;
//    }

    public $obj_alias = 'Address';

    public function customer(){
        return $this->belongsToMany('App\Customer', 'customer_addresses', 'address_id', 'customer_id');
    }
    public function company(){
        return $this->belongsToMany('App\Account', '`customers_company_addresses`', 'address_id', 'customer_company_id');
    }



    public function getLink(): string {

        return '#';
    }

    public function getActivityTitle(): string{

        if($this->id > 0){
            if(!is_null($this->customer)){
                return "Address of ".$this->customer->getCustomerNameWithAccount();
            }
        }
        return '';
    }


}
