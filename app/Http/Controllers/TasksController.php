<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Index_tasks;
use App\Journal;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
    protected function validator(array $data, $isUpdateRequest=false)
    {


        $rules=[
            'taskTitle' => 'required|string',
            'taskDescription' => 'required|string',
            'taskStatus' => 'required|string',
            'taskDueDate'=>'required|date',
            'taskPriority'=>'required|string',
            'taskCustomerId'=>'required|integer|exists:customers,id'
        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'taskId'=>'required|integer|exists:tasks,id',
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
        return view('task.index-datatable');
    }

    public function getTasksAjax(){
        return DataTables::of(Index_tasks::all())
            ->addColumn('action',
                function ($task){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="cancelTask('.$task->id.')" ><i class="glyphicon glyphicon-remove"></i> Cancel</a>
                        <a  class="btn btn-xs btn-primary"   onClick="viewTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })

            ->addColumn('customer_name',
                function ($task){

                    $string = '';
                    $string .= '<a href="'.route('view-customer', [$task->customer_id]).'">'.$task->customer_last_name.', '. $task->customer_first_name.'</a>';
                    if($task->account_name){
                        $string .= ' @ <a href="'.route("view-account", $task->account_id).'">'.$task->account_name.'</a>';
                    }
                    if($task->customer_last_name == null && $task->customer_first_name == null && $task->account_name == null){
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
            ->rawColumns(['title', 'customer_name', 'description', 'due_date' ,'status', 'priority', 'action'])
            ->make(true);
    }

    public function getTasksAjaxDue(){

        return DataTables::of(Index_tasks::where('status','=','Due')->where('due_date', '<', Carbon::tomorrow())->orderBy('due_date','desc'))

            ->addColumn('action',
                function ($task){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteTask('.$task->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="viewtask('.$task->id.')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';

                })
            ->addColumn('customer_name',
                function ($task){

                    $string = '';
                    $string .= '<a href="'.route('view-customer', [$task->customer_id]).'">'.$task->customer_last_name.', '. $task->customer_first_name.'</a>';
                    if($task->account_name){
                        $string .= ' @ <a href="'.route("view-account", [$task->account_id]).'">'.$task->account_name.'</a>';
                    }
                    if($task->customer_last_name == null && $task->customer_first_name == null && $task->comapny_name == null){
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
            ->rawColumns(['title','customer_name','description','status', 'priority', 'due_date','action' ])
            ->make(true);
    }

    public function createTask( Request $request){
        $this->validator($request->task)->validate();
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
        $this->validator($request->task, true)->validate();
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

    public function completeTask(Request $request){

        $rules=[
            'journalTitle'=>'required|string',
            'journalDescription'=>'required|string',
            'journalLogDate'=>'required|date',
            'originId'=>'required|integer|exists:tasks,id'
        ];

        if(isset($request->journal['followup']['type'])) {
            if ($request->journal['followup']['type'] == 'task') {
                $rules = array_merge($rules, [
                    'followup.followupTaskTitle' => 'required|string',
                    'followup.followupTaskDescription' => 'required|string',
                    'followup.followupTaskDueDate' => 'required|string',
                    'followup.followupTaskPriority' => 'required|string',
                ]);
            } else {
                if ($request->journal['followup']['type'] == 'appointment') {
                    $rules = array_merge($rules, [
                        'followup.followupAppointmentTitle' => 'required|string',
                        'followup.followupAppointmentDescription' => 'required|string',
                        'followup.followupAppointmentStartTime' => 'required|string',
                        'followup.followupAppointmentEndTime' => 'required|string',
                    ]);
                }
            }
        }
        $task= Task::findOrFail($request->journal['originId']);
        $task->status = 'Done';
        Validator::make($request->journal, $rules)->validate();

        $journal = new Journal();
        $journal->customer_id = $task->customer->id;
        $journal->title = $request->journal['journalTitle'];
        $journal->description = $request->journal['journalDescription'];
        $journal->log_date = Carbon::parse($request->journal['journalLogDate']);

        $followup=null;

        if(isset($request->journal['followup']['type'])) {

            if ($request->journal['followup']['type'] == 'task') {
                $followup = new Task();
                $followup->title
                    = $request->journal['followup']['followupTaskTitle'];
                $followup->customer_id = $task->customer->id;
                $followup->description
                    = $request->journal['followup']['followupTaskDescription'];
                $followup->due_date
                    = Carbon::parse($request->journal['followup']['followupTaskDueDate']);
                $followup->status = "Due";
                $followup->priority
                    = $request->journal['followup']['followupTaskPriority'];
            } else {
                if ($request->journal['followup']['type'] == 'appointment') {
                    $followup = new Appointment();
                    $followup->title
                        = $request->journal['followup']['followupAppointmentTitle'];
                    $followup->customer_id
                        = $task->customer->id;
                    $followup->description
                        = $request->journal['followup']['followupAppointmentDescription'];
                    $followup->status = "Due";
                    $followup->start_time
                        = Carbon::parse($request->journal['followup']['followupAppointmentStartTime']);
                    $followup->end_time
                        = Carbon::parse($request->journal['followup']['followupAppointmentEndTime']);
                }
            }
        }

                DB::beginTransaction();
                $journal->save();
                $task->save();
                if(!is_null($task->journal)){
                    $journal->prev_journal()->save($task->journal);
                    $task->journal->next_journal()->save($journal);
                }
                if(!is_null($followup)){
                    $followup->save();
                    $followup->journal()->save($journal);
                }
            DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Task Completed.'
        ],200);
    }
    public function cancelTask(Request $request){

        $rules=[
            'journalTitle'=>'required|string',
            'journalDescription'=>'required|string',
            'journalLogDate'=>'required|date',
            'originId'=>'required|integer|exists:tasks,id'
        ];

        if(isset($request->journal['followup']['type'])) {
            if ($request->journal['followup']['type'] == 'task') {
                $rules = array_merge($rules, [
                    'followup.followupTaskTitle' => 'required|string',
                    'followup.followupTaskDescription' => 'required|string',
                    'followup.followupTaskDueDate' => 'required|string',
                    'followup.followupTaskPriority' => 'required|string',
                ]);
            } else {
                if ($request->journal['followup']['type'] == 'appointment') {
                    $rules = array_merge($rules, [
                        'followup.followupAppointmentTitle' => 'required|string',
                        'followup.followupAppointmentDescription' => 'required|string',
                        'followup.followupAppointmentStartTime' => 'required|string',
                        'followup.followupAppointmentEndTime' => 'required|string',
                    ]);
                }
            }
        }
        $task= Task::findOrFail($request->journal['originId']);
        $task->status = 'Cancelled';
        Validator::make($request->journal, $rules)->validate();

        $journal = new Journal();
        $journal->customer_id = $task->customer->id;
        $journal->title = $request->journal['journalTitle'];
        $journal->description = $request->journal['journalDescription'];
        $journal->log_date = Carbon::parse($request->journal['journalLogDate']);

        $followup=null;

        if(isset($request->journal['followup']['type'])) {

            if ($request->journal['followup']['type'] == 'task') {
                $followup = new Task();
                $followup->title
                    = $request->journal['followup']['followupTaskTitle'];
                $followup->customer_id = $task->customer->id;
                $followup->description
                    = $request->journal['followup']['followupTaskDescription'];
                $followup->due_date
                    = Carbon::parse($request->journal['followup']['followupTaskDueDate']);
                $followup->status = "Due";
                $followup->priority
                    = $request->journal['followup']['followupTaskPriority'];
            } else {
                if ($request->journal['followup']['type'] == 'appointment') {
                    $followup = new Appointment();
                    $followup->title
                        = $request->journal['followup']['followupAppointmentTitle'];
                    $followup->customer_id
                        = $task->customer->id;
                    $followup->description
                        = $request->journal['followup']['followupAppointmentDescription'];
                    $followup->status = "Due";
                    $followup->start_time
                        = Carbon::parse($request->journal['followup']['followupAppointmentStartTime']);
                    $followup->end_time
                        = Carbon::parse($request->journal['followup']['followupAppointmentEndTime']);
                }
            }
        }

                DB::beginTransaction();
                $journal->save();
                $task->save();
                if(!is_null($task->journal)){
                    $journal->prev_journal()->save($task->journal);
                    $task->journal->next_journal()->save($journal);
                }
                if(!is_null($followup)){
                    $followup->save();
                    $followup->journal()->save($journal);
                }
            DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Task Cancelled.'
        ],200);
    }


}
