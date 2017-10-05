<?php

namespace App\Http\Controllers;

use App\Traits\PolicyHelpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    use PolicyHelpers;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('activity.index', [
            'from'=>Carbon::today()->firstOfMonth()->startOfDay()->format('m/d/Y H:i A'),
            'to'=>Carbon::today()->endOfDay()->format('m/d/Y H:i A'),
            ]);
    }

    public function getActivities(Request $request){
        $from = is_null($request->from)?Carbon::today()->firstOfMonth()->startOfDay():Carbon::createFromFormat('m/d/Y H:i A', $request->from);
        $to = is_null($request->to)?Carbon::today()->endOfDay():Carbon::createFromFormat('m/d/Y H:i A', $request->to);

        $activities =  Activity::with(['causer', 'subject'])->whereBetween('created_at', [$from, $to]);

        if($this->checkAdmin(Auth::user())){
            if(!is_null($request->user)){
                if($request->user == -1){
                    $activities = $activities->whereNull('causer_id');
                }
                else {
                    $activities = $activities->where('causer_id', '=', $request->user);
                }
            }
        }
        else{
            $activities = $activities->where('causer_id', '=', Auth::user()->id);
        }


        if(!is_null($request->type)){
            $activities = $activities->where('description', '=', $request->type);
        }

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
