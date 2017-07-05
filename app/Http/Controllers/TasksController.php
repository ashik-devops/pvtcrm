<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Customer;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class TasksController extends Controller
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
        return view('task.index-datatable');
    }

    public function getTasksAjax(){
        return Datatables::of(Task::with('customer','customer.company'))
            ->addColumn('action',
                function ($task){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="cancelTask('.$task->id.')" ><i class="glyphicon glyphicon-remove"></i> Cancel</a>
                        <a  class="btn btn-xs btn-primary"   onClick="viewTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>'
                        ;
                })

            ->addColumn('customer',
                function ($task){

                    $string = '';
                    $string .= '<a href="#">'.$task->customer["last_name"].', '. $task->customer['first_name'].'</a>';
                    if($task->customer['company']['name']){
                        $string .= '@ <a href="#">'.$task->customer['company']['name'].'</a>';
                    }
                    if($task->customer["last_name"] == null && $task->customer["first_name"] == null && $task->customer['company']['name'] == null){
                        $string = '';
                    }

                    return $string;

                })
            ->addColumn('description',
                function ($task){
                    return  substr($task->description,0,70) . ' ....';
                })
            ->addColumn('due_date',
                function ($task){
                    return  Carbon::createFromTimeStamp(strtotime($task->due_date))->toFormattedDateString();
                })
            ->rawColumns(['title', 'customer', 'description', 'due_date' ,'status', 'priority', 'action'])
            ->make(true);
    }

    public function getTasksAjaxDue(){



        return Datatables::of(Task::with('customer','customer.company')->where('status','like','Due')->orderBy('created_at','desc'))

            ->addColumn('action',
                function ($task){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteTask('.$task->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="#view/'.$task->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>
                        <a href="#quick-view/" data-id="'.$task->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Quick View</a>'
                        ;
                })
            ->addColumn('first_name',
                function ($task){

                    $string = '';
                    $string .= '<a href="#">'.$task->customer["last_name"].', '. $task->customer['first_name'].'</a>';
                    if($task->customer['company']['name']){
                        $string .= '@ <a href="#">'.$task->customer['company']['name'].'</a>';
                    }
                    if($task->customer["last_name"] == null && $task->customer["first_name"] == null && $task->customer['company']['name'] == null){
                        $string = '';
                    }

                    return $string;

                })
            ->addColumn('description',
                function ($task){
                    return  substr($task->description,0,70) . ' ....';
                })
            ->addColumn('due_date',
                function ($task){
                    return  Carbon::createFromTimeStamp(strtotime($task->due_date))->toFormattedDateString();
                })
            ->rawColumns(['title','first_name','description','status', 'priority', 'due_date','action' ])
            ->make(true);
    }

    public function createTask( Request $request){
        $task = new Task();
        $task->title = $request->task['taskTitle'];
        $task->customer_id = $request->task['taskCustomerId'];
        $task->description = $request->task['taskDescription'];
        $task->due_date = Carbon::parse($request->task['taskDueDate']);
        $task->status = $request->task['taskStatus'];
        $task->priority = $request->task['taskPriority'];




        DB::beginTransaction();
        $task->save();

        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Tasks has been created successfully.'
        ]);
    }

    public function editTask(Request $request){


        $task = Task::with('customer')->findOrFail($request->id);


        return response()->json([
            'task' => $task,
        ], 200);
    }

    public function updateTask(Request $request){

        $task = Task::findOrFail($request->task['taskId']);




            $task->customer_id = $request->task['taskCustomerId'];
            $task->title = $request->task['taskTitle'];
            $task->description = $request->task['taskDescription'];
            $task->due_date = Carbon::parse($request->task['taskDueDate']);
            $task->priority= $request->task['taskPriority'];
            $task->status= $request->task['taskStatus'];



            DB::beginTransaction();

            $task->save();
            DB::commit();

            return response()->json([
                'result'=>'Saved',
                'message'=>'Task has been updated successfully.'
            ]);


    }

    public function deleteTask(Request $request){
        $task = Task::findOrFail($request->id);

        if(!is_null($task)){

            $task->delete();

            return response()->json([
                'result'=>'Success',
                'message'=>'Task has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Task not found.'
        ]);

    }

    public function cancelTask(Request $request){
        $task = Task::findOrFail($request->id);

        if(!is_null($task)){

            if($task->status == 'Cancelled'){
                $cancel_message = 'Already Cancelled';
            }else{
                $cancel_message = '';
                $task->status = 'Cancelled';
                $task->save();
            }


            return response()->json([
                'result'=>'Success',
                'message'=>'Task has been cancelled.',
                'cancel_message' => $cancel_message
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Task not found.'
        ]);

    }


}
