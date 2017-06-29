<?php

namespace App\Http\Controllers;

use App\Appointment;

use Carbon\Carbon;
use Illuminate\Http\Request;




use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class AppointmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|string|email|max:255|unique',
            'title'=>'required|string|max:32',
            'primary_phone_no'=>'required|string|max:32|unique',
            'street_address_1'=>'required|string',
            'street_address_2'=>'string|nullable',
            'city'=>'required|string|max:32',
            'state'=>'required|string|max:32',
            'country'=>'required|string|max:32',
            'zip'=>'required|string|max:8',
        ]);
    }

    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('appointment.index-datatable');
    }

    public function getAppointmentsAjax(){
        return Datatables::of(Appointment::select('id', 'title', 'description', 'start_time' ,'end_time'))
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="#view/'.$appointment->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>
                        <a href="#quick-view/" data-id="'.$appointment->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Quick View</a>'
                        ;
                })


            ->addColumn('description',
                function ($appointment){
                    return  substr($appointment->description,0,70) . ' ....';
                })
            ->addColumn('start_time',
                function ($appointment){
                    return  Carbon::createFromTimeStamp(strtotime($appointment->start_time))->toFormattedDateString();

                })
            ->addColumn('end_time',
                function ($appointment){
                    return  Carbon::createFromTimeStamp(strtotime($appointment->end_time))->toFormattedDateString();

                })

            ->rawColumns(['id','title', 'description', 'start_time' ,'end_time',  'action'])
            ->make(true);
    }

    public function createAppointment(Request $request){


        $appointment = new Appointment();

        $appointment->title = $request->appointment['appointmentTitle'];
        $appointment->description = $request->appointment['appointmentDescription'];
        $appointment->start_time = Carbon::parse($request->appointment['startTime']);
        $appointment->end_time = Carbon::parse($request->appointment['endTime']);





       DB::beginTransaction();
        $appointment->save();

        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Appointment has been created successfully.'
        ]);

    }

    public function editAppointment(Request $request){
        $appointment = Appointment::findOrFail($request->id);


        return response()->json([
            'appointment' => $appointment,
        ], 201);
    }

    public function updateAppointment(Request $request){

        $appointment = Appointment::findOrFail($request->appointment['appointmentId']);

        $appointment->title = $request->appointment['appointmentTitle'];
        $appointment->description = $request->appointment['appointmentDescription'];
        $appointment->start_time = Carbon::parse($request->appointment['startTime']);
        $appointment->end_time = Carbon::parse($request->appointment['endTime']);



        DB::beginTransaction();

        $appointment->save();
        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Appointment has been updated successfully.'
        ]);


    }

    public function deleteAppointment(Request $request){
        $appointment = Appointment::findOrFail($request->id);

        if(!is_null($appointment)){

            $appointment->delete();

            return response()->json([
                'result'=>'Success',
                'message'=>'Appointment has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Appointment not found.'
        ]);

    }
}
