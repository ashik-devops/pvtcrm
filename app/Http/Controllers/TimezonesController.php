<?php

namespace App\Http\Controllers;

use App\Country;
use App\Timezone;
use Illuminate\Http\Request;

class TimezonesController extends Controller
{
    public function index(Request $request){
        $zones=Timezone::select('id', 'name AS text');
        if($request->q){
            $zones=$zones->where('name', 'LIKE', "%$request->q%");
        }
        return response()->json([
            'timezones' =>$zones->get()->map(function($zone){
                if($zone->gmt_offset >= 0){
                    $name = "(UTC +"+number_format($zone->gmt_offset, 2)+" - $zone->name";
                }
                else {
                    $name = "(UTC -"+number_format($zone->gmt_offset, 2)+" - $zone->name";

                }

                return ['id'=>$zone->id, 'name'=> $name];
            })
        ], 200);
    }
}
