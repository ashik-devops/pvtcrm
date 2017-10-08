<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Customer;
use App\Task;
use App\Traits\PolicyHelpers;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $activities = $this->applyRequestFilters($request);
        $activities = $activities->select('description', 'created_at');

        return DataTables::of($activities)
            ->addColumn('created_at', function ($activity){
                $date =  new Carbon($activity->created_at);
                return $date->format('M d, Y h:i:s A');
            })
            ->rawColumns(['description'])
            ->make();
    }
    public function recentActivities($count=10){
        return response()->json($this->applyUserFilters(Activity::with('causer', 'subject'))->orderBy('created_at', 'desc')->take($count)->get()->map(function($activity){

            $date =  new Carbon($activity->created_at);
            $log = new \stdClass();
            $log->happened = $date->diffForHumans();


            $log->message= $activity->description;
            return $log;
        }), 200);
    }


    public function customerActivity(Request $request, Customer $customer){

        $activities = $this->applyRequestFilters($request);
        $activities = $activities->select('description', 'created_at');

        return DataTables::of($activities)
            ->addColumn('created_at', function ($activity){
                $date =  new Carbon($activity->created_at);
                return $date->toFormattedDateString();
            })
            ->rawColumns(['description'])
            ->make();

    }

    /**
     * Applies filter according to user scope
     *
     * @param $activities
     * @param $user int
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function applyUserFilters($activities, int $user=null): Builder
    {
        if ($this->checkAdmin(Auth::user())) {
            if (!is_null($user)) {
                if ($user == -1) {
                    $activities = $activities->whereNull('causer_id');
                } else {
                    $activities = $activities->where('causer_id', '=', $user);
                }
            }
        } else {
            $activities = $activities->where('causer_id', 'IN', Auth::user()->getSubordinates());
        }
        return $activities;
    }

    /**
     * Applies request filters
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function applyRequestFilters(Request $request): Builder
    {
        $from = is_null($request->from) ? Carbon::today()->firstOfMonth()->startOfDay() : Carbon::createFromFormat('m/d/Y H:i A', $request->from);
        $to = is_null($request->to) ? Carbon::today()->endOfDay() : Carbon::createFromFormat('m/d/Y H:i A', $request->to);

        $activities = Activity::whereBetween('created_at', [$from, $to]);

        $activities = $this->applyUserFilters($activities, $request->user);


        if (!is_null($request->type)) {
            $activities = $activities->where('type', '=', $request->type);
        }
        return $activities;
    }
}
