<?php

namespace App\Http\Controllers;

use App\Account;
use App\Appointment;
use App\Customer;
use App\Journal;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JournalController extends Controller
{

    protected function validator(array $data){
        $rules=[
            'journalCustomerId'=>'required|integer|exists:customers,id',
            'journalTitle'=>'required|string',
            'journalDescription'=>'required|string',
            'journalLogDate'=>'required|date',
        ];


        if(isset($data['followup']['type'])){
            if($data['followup']['type']=='task'){
                $rules=array_merge($rules,[
                    'followup.followupTaskTitle'=>'required|string',
                    'followup.followupTaskDescription'=>'required|string',
                    'followup.followupTaskDueDate'=>'required|string',
                    'followup.followupTaskPriority'=>'required|string',
                ]);
            }
            else if($data['followup']['type']=='appointment'){
                $rules=array_merge($rules,[
                    'followup.followupAppointmentTitle'=>'required|string',
                    'followup.followupAppointmentDescription'=>'required|string',
                    'followup.followupAppointmentStartTime'=>'required|string',
                    'followup.followupAppointmentEndTime'=>'required|string',
                ]);
            }
        }

        return Validator::make($data, $rules);
    }

//    public function getAccountJournalsAjax(Account $account){
//        return DataTables::of($account->journals())
//            ->addColumn('action',
//                function ($journal){
//                    return
//                        '<a  class="btn btn-xs btn-warning"  onClick="viewJournal('.$journal->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
//                })
//            ->addColumn('followup',
//                function($journal){
//                    if(get_class($journal->journalable) == 'App\Task'){
//                        return '<a href="javascript:viewTask('.$journal->journalable->id.')">'.$journal->journalable->title;
//                    }elseif(get_class($journal->journalable) == 'App\Appointment'){
//                        return '<a href="javascript:viewAppointment('.$journal->journalable->id.')"'.$journal->journalable->title;
//                    }else{
//                        return '';
//                    }
//                })
//            ->rawColumns(['title', 'description', 'followup', 'log_date','action'])
//            ->make(true);
//    }

    public function getCustomerJournalsAjax(Customer $customer){
        return DataTables::of($customer->journals()->with(['journalable']))
            ->addColumn('action',
                function ($journal){
                    return
                        '<a  class="btn btn-xs btn-warning"  onClick="viewJournal('.$journal->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('followup',
                function($journal){
                    if(get_class($journal->journalable) == 'App\Task'){
                        return '<a href="javascript:viewTask('.$journal->journalable->id.')">'.$journal->journalable->title;
                    }elseif(get_class($journal->journalable) == 'App\Appointment'){
                        return '<a href="javascript:viewAppointment('.$journal->journalable->id.')"'.$journal->journalable->title;
                    }else{
                        return '';
                    }
                })


            ->rawColumns(['id', 'title', 'description', 'followup', 'log_date','action'])
            ->make(true);
    }



    public function getAccountJournalsAjax(Account $account){
        return DataTables::of($account->journals()->with(['journalable']))
            ->addColumn('action',
                function ($journal){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="viewJournal('.$journal->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('followup',
                function($journal){
                    if(get_class($journal->journalable) == 'App\Task'){
                        return '<a href="javascript:viewTask('.$journal->journalable->id.')">'.$journal->journalable->title;
                    }elseif(get_class($journal->journalable) == 'App\Appointment'){
                        return '<a href="javascript:viewAppointment('.$journal->journalable->id.')"'.$journal->journalable->title;
                    }else{
                        return '';
                    }
                })


            ->rawColumns(['title', 'description', 'followup', 'log_date','action'])
            ->make(true);
    }


    public function createJournal(Request $request){
        $this->authorize('create',Journal::class);
        $this->validator($request->journal)->validate();

        $journal = new Journal();
        $journal->customer_id = $request->journal['journalCustomerId'];
        $journal->title = $request->journal['journalTitle'];
        $journal->description = $request->journal['journalDescription'];
        $journal->log_date = Carbon::parse($request->journal['journalLogDate']);


        $followup = null;

        if (isset($request->journal['followup']['type'])) {

            if ($request->journal['followup']['type'] == 'task') {
                $followup = new Task();
                $followup->title = $request->journal['followup']['followupTaskTitle'];
                $followup->customer_id = $request->journal['journalCustomerId'];
                $followup->description = $request->journal['followup']['followupTaskDescription'];
                $followup->due_date = Carbon::parse($request->journal['followup']['followupTaskDueDate']);
                $followup->status = "Due";
                $followup->priority = $request->journal['followup']['followupTaskPriority'];
            } else if ($request->journal['followup']['type'] == 'appointment') {
                $followup = new Appointment();
                $followup->title = $request->journal['followup']['followupAppointmentTitle'];
                $followup->customer_id = $request->journal['journalCustomerId'];
                $followup->description = $request->journal['followup']['followupAppointmentDescription'];
                $followup->status = "Due";
                $followup->start_time = Carbon::parse($request->journal['followup']['followupAppointmentStartTime']);
                $followup->end_time = Carbon::parse($request->journal['followup']['followupAppointmentEndTime']);
            }

        }
        DB::beginTransaction();
        $journal->save();

        if ($followup != null) {
            $followup->save();
            $followup->journal()->save($journal);
        }
        DB::commit();


        return response()->json([
            'result' => 'Saved',
            'message' => 'Journal has been created successfully.'
        ], 200);

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

}
