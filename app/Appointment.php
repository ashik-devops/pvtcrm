<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
    public  $with = ['customer'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['title','customer_id','description','status','start_time','end_time'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
