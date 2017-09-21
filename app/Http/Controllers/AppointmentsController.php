<?php

namespace App\Http\Controllers;

use App\Appointment;

use App\Customer;
use App\Index_appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
    protected function validator(array $data, $isUpdateRequest=false)
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
        $this->authorize('index', Appointment::class);
        return view('appointment.index-datatable');
    }

    public function getAppointmentsAjax(){
        $this->authorize('index',Appointment::class);

        return DataTables::of(Index_appointment::all())
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  onClick="viewAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })


            ->addColumn('customer_name',
                function ($appointment){

                    $string = '';
                    $string .= '<a href="'.route('view-customer', [$appointment->customer_id]).'">'.$appointment->customer_last_name.', '. $appointment->customer_first_name.'</a>';
                    if($appointment->account_name){
                        $string .= ' @ <a href="'.route("view-account", $appointment->account_id).'">'.$appointment->account_name.'</a>';
                    }
                    if($appointment->customer_last_name == null && $appointment->customer_first_name == null && $appointment->account_name == null){
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

            ->rawColumns(['customer_name', 'description',  'action'])
            ->make(true);

    }

    public function getAppointmentsAjaxPending(){
        $this->authorize('index',Appointment::class);

        return DataTables::of(Index_appointment::where('end_time', '<', Carbon::tomorrow())->where('status', '=','Due'))
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                       <a onClick="viewAppointment(\'.$appointment->id.\')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })


            ->addColumn('customer_name',
                function ($appointment){

                    $string = '';
                    $string .= '<a href="'.route('view-customer', [$appointment->customer_id]).'">'.$appointment->customer_last_name.', '. $appointment->customer_first_name.'</a>';
                    if($appointment->account_name){
                        $string .= ' @ <a href="'.route("view-account", $appointment->account_id).'">'.$appointment->account_name.'</a>';
                    }
                    if($appointment->customer_last_name == null && $appointment->customer_first_name == null && $appointment->account_name == null){
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

            ->rawColumns(['id','title', 'customer_name', 'description', 'start_time' ,'end_time',  'action'])
            ->make(true);

    }


    public function createAppointment(Request $request){
        $this->authorize('create',Appointment::class);
        $this->validator($request->appointment)->validate();

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
        $appointment = Appointment::with('customer', 'customer.account')->findOrFail($request->id);
        $this->authorize('update',$appointment);


        return response()->json([
            'appointment' => $appointment,
        ], 201);
    }

   public function updateAppointment(Request $request){
       $this->authorize('update',Appointment::class);
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
        $this->authorize('delete',$request);
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
