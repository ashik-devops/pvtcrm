<?php

namespace App\Http\Controllers;

use App\Appointment;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
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
    protected function validator(array $data, $isUpdateRequest)
    {
        $rules=[
            'appointmentTitle' => 'required|string',
            'appointmentDescription' => 'required|string',
            'appointmentStatus' => 'required|string',
            'startTime'=>'required|date',
            'endTime'=>'required|date',
            'aptCustomerId'=>'required|integer|exists:customers,id'
        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
            'appointmentId'=>'required|integer|exists:appointments,id',
            ]);
        }

        return Validator::make($data, $rules);
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


        return Datatables::of(Appointment::with('customer','customer.company'))
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a onClick="viewAppointment('.$appointment->id.')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })


            ->addColumn('first_name',
                function ($appointment){

                    $string = '';
                    $string .= '<a href="#">'.$appointment->customer["last_name"].', '. $appointment->customer['first_name'].'</a>';
                    if($appointment->customer['company']['name']){
                        $string .= '@ <a href="#">'.$appointment->customer['company']['name'].'</a>';
                    }
                    if($appointment->customer["last_name"] == null && $appointment->customer["first_name"] == null && $appointment->customer['company']['name'] == null){
                        $string = '';
                    }

                    return $string;
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

            ->rawColumns(['id','title', 'first_name', 'description', 'start_time' ,'end_time',  'action'])
            ->make(true);

    }

    public function getAppointmentsAjaxPending(){


        return Datatables::of(Appointment::with('customer','customer.company')->where('end_time', '<', Carbon::tomorrow())->where('status', '=','Due'))
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                       <a onClick="viewAppointment(\'.$appointment->id.\')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })


            ->addColumn('first_name',
                function ($appointment){

                    $string = '';
                    $string .= '<a href="#">'.$appointment->customer["last_name"].', '. $appointment->customer['first_name'].'</a>';
                    if($appointment->customer['company']['name']){
                        $string .= '@ <a href="#">'.$appointment->customer['company']['name'].'</a>';
                    }
                    if($appointment->customer["last_name"] == null && $appointment->customer["first_name"] == null && $appointment->customer['company']['name'] == null){
                        $string = '';
                    }

                    return $string;
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

            ->rawColumns(['id','title', 'first_name', 'description', 'start_time' ,'end_time',  'action'])
            ->make(true);

    }


    public function createAppointment(Request $request){

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if(is_numeric($request->appointment['aptCustomerId'])){
            $customer=Customer::findOrFail($request->appointment['aptCustomerId']);

            if(is_null($customer)){
                $result['message']='Customer Not Found.';
            }
            else{
                $appointment = new Appointment();

                $appointment->title = $request->appointment['appointmentTitle'];
                $appointment->description = $request->appointment['appointmentDescription'];
                $appointment->status = $request->appointment['appointmentStatus'];
                $appointment->start_time = Carbon::parse($request->appointment['startTime']);
                $appointment->end_time = Carbon::parse($request->appointment['endTime']);
                DB::beginTransaction();
                $customer->appointments()->save($appointment);
                DB::commit();

                $result['result']='Saved';
                $result['message']='Appointment Saved Successfully.';
            }
        }
        else{
            $result['message']='Customer Not Found.';
        }

        return response()->json($result,200);

    }

    public function editAppointment(Request $request){

        $appointment = Appointment::with('customer', 'customer.company')->findOrFail($request->id);


        return response()->json([
            'appointment' => $appointment,
        ], 201);
    }

   public function updateAppointment(Request $request){

       $this->validator($request->appointment, true)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if(is_numeric($request->appointment['aptCustomerId'])) {
            $customer = Customer::findOrFail($request->appointment['aptCustomerId']);


            $appointment = Appointment::findOrFail($request->appointment['appointmentId']);
            $appointment->title = $request->appointment['appointmentTitle'];
            $appointment->description = $request->appointment['appointmentDescription'];
            $appointment->status = $request->appointment['appointmentStatus'];
            $appointment->start_time = Carbon::parse($request->appointment['startTime']);
            $appointment->end_time = Carbon::parse($request->appointment['endTime']);


            DB::beginTransaction();
            $customer->appointments()->save($appointment);
            DB::commit();
            $result['result']= 'Saved';
            $result['message']= 'Appointment has been updated successfully.';
        }
        return response()->json($result, 200);
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
