<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('activity.index');
    }

    public function getActivities(Request $request){
        $from = Carbon::today()->startOfDay();
        $to =   Carbon::today()->endOfDay();
        $activities =  Activity::with(['causer', 'subject'])->whereBetween('created_at', [$from, $to]);

        return DataTables::of($activities)
            ->addColumn('user', function ($activity){
                return is_null($activity->causer)?"System": $activity->causer->name;
            })
            ->addColumn('summary', function($activity){
                return $this->getLogMessage($activity);
            })
            ->rawColumns(['summary'])
            ->make();
    }
    public function recentActivities($count=10){
        return response()->json(Activity::with('causer', 'subject')->orderBy('created_at', 'desc')->take($count)->get()->map(function($activity){

            $date =  new Carbon($activity->created_at);
            $log = new \stdClass();
            $log->happened = $date->diffForHumans();


            $log->message= $this->getLogMessage($activity);
            return $log;
        }), 200);
    }

    function getLogMessage(Activity $activity): string
    {
        if (is_null($activity->causer)) {
            return "<strong><a href='#'> System</a></strong> has {$activity->description} {$activity->subject->obj_alias}: <a href='".$activity->subject->getLink()."'>".$activity->subject->getActivityTitle()."</a>";
        }

        return'<strong><a href="' . route('profile-view', [$activity->causer->id]) . '">' . $activity->causer->name . '</a><strong> has ' .$activity->description . ' ' . $activity->subject->obj_alias . ': <a href="' . $activity->subject->getLink() . '">' . $activity->subject->getActivityTitle() . '</a>';

    }
}
