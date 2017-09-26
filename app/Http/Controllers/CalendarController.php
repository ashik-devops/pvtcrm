<?php

namespace App\Http\Controllers;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){
        return view('calendar.index');
    }

    public function getAjaxEvents(Request $request){
        $start = Carbon::createFromFormat('Y-m-d',$request->start);
        $end = Carbon::createFromFormat('Y-m-d',$request->end);
         $events = Appointment::where('start_time', '>=', $start)
            ->where('end_time', '<=', $end)
            ->get(['id', 'customer_id', 'title', 'description','status', 'start_time AS start', 'end_time AS end'])
            ->map(function($event){
                $event->url="javascript:viewEvent($event->id)";
                $event->start = Carbon::parse($event->start)->toIso8601String();
                $event->end = Carbon::parse($event->end)->toIso8601String();

                return $event;
            });


        return response()->json($events, 200);
    }
}
