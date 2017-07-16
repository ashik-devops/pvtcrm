<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Customer;
use App\Journal;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Yajra\Datatables\Facades\Datatables;

class JournalController extends Controller
{
    public function getJournalsAjax(){
        return Datatables::of(Journal::select('id', 'title', 'description', 'related_obj_type', 'log_date'))
            ->addColumn('action',
                function ($journal){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editJournal('.$journal->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="viewJournal('.$journal->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('related_obj_type',
                function($journal){
                    if($journal->related_obj_type == 'App\Task'){
                        return 'Task';
                    }elseif($journal->related_obj_type == 'App\Appointment'){
                        return 'Appointment';
                    }else{
                        return '';
                    }
            })


            ->rawColumns(['id', 'title', 'description', 'related_obj_type', 'log_date','action'])
            ->make(true);
    }

    public function createJournal(Request $request){
        $journal = new Journal();
        $journal->customer_id = $request->journal['journalCustomerId'];
        $journal->title = $request->journal['journalTitle'];
        $journal->description = $request->journal['journalDescription'];
        $journal->log_date = Carbon::parse($request->journal['journalLogDate']);



        if($request->task['taskTitle']){

            $task = new Task();
            $task->title = $request->task['taskTitle'];
            $task->customer_id = $request->journal['journalCustomerId'];
            $task->description = $request->task['taskDescription'];
            $task->due_date = Carbon::parse($request->task['taskDueDate']);
            $task->status = $request->task['taskStatus'];
            $task->priority = $request->task['taskPriority'];

            DB::beginTransaction();
            $task->save();
            $task = Task::findOrFail($task->id);
            $task->journals()->save($journal);
            DB::commit();
        }
        if($request->appointment['appointmentTitle']){

            $appointment = new Appointment();
            $appointment->title = $request->appointment['appointmentTitle'];
            $appointment->customer_id = $request->journal['journalCustomerId'];
            $appointment->description = $request->appointment['appointmentDescription'];
            $appointment->status = $request->appointment['appointmentStatus'];
            $appointment->start_time = Carbon::parse($request->appointment['startTime']);
            $appointment->end_time = Carbon::parse($request->appointment['endTime']);
            DB::beginTransaction();
            $appointment->save();
            $appointment = Appointment::findOrFail($appointment->id);
            $appointment->journals()->save($journal);
            DB::commit();

            /*DB::beginTransaction();
            $appointment->save();
            $appointment = Task::findOrFail($task->id);
            $task->journals()->save($journal);
            DB::commit(); */
        }
        if(!$request->task['taskTitle'] && !$request->appointment['appointmentTitle']){


            DB::beginTransaction();
            $journal->save();
            DB::commit();
        }


        return response()->json([
            'result'=>'Saved',
            'message'=>'Journal has been created successfully.'
        ]);

    }

    public function editJournal(Request $request){

        $journal = Journal::findOrFail($request->id);
        $customer = Customer::findOrFail($journal->customer_id);
        if($journal->related_obj_type == 'App\Task'){

           $task = Task::findOrFail($journal->related_obj_id);
            return response()->json([
                'journal' => $journal,
                'task' => $task,
                'customer' => $customer
            ], 200);
        }
        if($journal->related_obj_type == 'App\Appointment'){

           $appointment = Appointment::findOrFail($journal->related_obj_id);
            return response()->json([
                'journal' => $journal,
                'customer' => $customer,
                'appointment' => $appointment,

            ], 200);
        }
        if(! $journal->related_obj_type ){

           $appointment = Appointment::findOrFail($request->id);
            return response()->json([
                'journal' => $journal,
                'customer' => $customer


            ], 200);
        }


    }

    public function updateJournal(Request $request){
        $journal = Journal::findOrFail($request->journal['journalId']);

        $journal->customer_id = $request->journal['journalCustomerId'];
        $journal->title = $request->journal['journalTitle'];
        $journal->description = $request->journal['journalDescription'];
        $journal->log_date = Carbon::parse($request->journal['journalLogDate']);
        if($journal->related_obj_type == 'App\Task'){
            $task = Task::findOrFail($journal->related_obj_id);
            $task->customer_id = $request->journal['journalCustomerId'];
            $task->title = $request->task['taskTitle'];
            $task->description = $request->task['taskDescription'];
            $task->due_date = Carbon::parse($request->task['taskDueDate']);
            $task->priority= $request->task['taskPriority'];
            $task->status= $request->task['taskStatus'];

            DB::beginTransaction();
            $task->save();
            $task = Task::findOrFail($task->id);
            $task->journals()->save($journal);
            DB::commit();
            return response()->json([
                'result'=>'Saved',
                'message'=>'Journal has been updated successfully.'
            ]);

        }

        if($journal->related_obj_type == 'App\Appointment'){
            $appointment = Appointment::findOrFail($journal->related_obj_id);
            $appointment->title = $request->appointment['appointmentTitle'];
            $appointment->customer_id = $request->journal['journalCustomerId'];
            $appointment->description = $request->appointment['appointmentDescription'];
            $appointment->status = $request->appointment['appointmentStatus'];
            $appointment->start_time = Carbon::parse($request->appointment['startTime']);
            $appointment->end_time = Carbon::parse($request->appointment['endTime']);

            DB::beginTransaction();
            $appointment->save();
            $appointment = Appointment::findOrFail($appointment->id);
            $appointment->journals()->save($journal);
            DB::commit();
            return response()->json([
                'result'=>'Saved',
                'message'=>'Journal has been updated successfully.'
            ]);
        }
        if(! $journal->related_obj_type ){
            DB::beginTransaction();
            $journal->save();

            DB::commit();
            return response()->json([
                'result'=>'Saved',
                'message'=>'Journal has been updated successfully.'
            ]);
        }




    }
}
