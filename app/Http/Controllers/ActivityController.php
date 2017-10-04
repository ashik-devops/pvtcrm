<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getActivities(Request $request){
        $from = Carbon::today()->startOfDay();
        $to =   Carbon::today()->endOfDay();
        $activities =  Activity::with(['causer', 'subject'])->whereBetween('created_at', [$from, $to])->get();
        return $activities;
    }
    public function recentActivities($count=10){
        return response()->json(Activity::with('causer', 'subject')->orderBy('created_at', 'desc')->take($count)->get()->map(function($activity){

            $date =  new Carbon($activity->created_at);
            $log = new \stdClass();
            $log->happened = $date->diffForHumans();
            if(is_null($activity->causer)){
                $log->message = '<strong><a href="#">System</a><strong> has '.ucfirst($activity->description).' '.$activity->subject->obj_alias.': <a href="'.$activity->subject->getLink().'">'.$activity->subject->getActivityTitle().'</a>';
            }
            else
            {
                $log->message = '<strong><a href="'.route('profile-edit', [$activity->causer->id]).'">'.$activity->causer->name. '</a><strong> has '.ucfirst($activity->description).' '.$activity->subject->obj_alias.': <a href="'.$activity->subject->getLink().'">'.$activity->subject->getActivityTitle().'</a>';
            }
            return $log;
        }), 200);
    }
}
