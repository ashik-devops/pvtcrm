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
            'timezones' =>$zones->get()
        ], 200);
    }
}
