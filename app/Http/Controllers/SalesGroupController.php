<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Index_usergroup;
use App\Journal;
use App\Task;
use App\User;
use App\UserGroup;
use App\SalesGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SalesGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function validator(array $data, $isUpdateRequest=false)
    {
        $rules=[
            'salesGroupName' => 'required|string',
//            'userIds.*' =>'required|integer|exists:users,id',

        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'salesGroupId'=>'required|integer|exists:sales_groups,id',
            ]);
        }

        return Validator::make($data, $rules);
    }


    public function index()
    {
        return view('sales-group.index-datatable');
    }

    public function getSalesGroupsAjax(){

        return DataTables::of(Index_salesgroup::all())
            ->addColumn('action',
                function ($salesgroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editSalesGroup('.$salesgroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteSalesGroup('.$salesgroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  href="'.route('view-sales-group',['group'=>$salesgroup->id]).'"><i class="glyphicon glyphicon-eye"></i> View</a>';
                })

            ->addColumn('name',
                function ($salesgroup){
                    return $salesgroup->name;
                })


            ->rawColumns(['action','name','user_id'])
            ->make(true);

    }


    public function create(Request $request){
//        $this->authorize('create',Appointment::class);
        $this->validator($request->salesGroup)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->salesGroup['userIds']){
            $salesGroup = new SalesGroup();
            $salesGroup->name = $request->salesGroup['salesGroupName'];

            DB::beginTransaction();

            $salesGroup->save();

            $salesGroup->members()->attach($request->salesGroup['userIds']);
            DB::commit();

            $result['result']='Saved';
            $result['message']='Sales group has been created Successfully.';

        }
        else{
            $result['message']='Please add at least 1 member';
        }

        return response()->json($result,200);
    }


    public function update(Request $request){
        $this->validator($request->usersGroup, true)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->salesGroup['userIds']){
            $salesGroup = SalesGroup::find($request->salesGroup['salesGroupId']);
            $salesGroup->name = $request->salesGroup['salesGroupName'];

            $current_members=$salesGroup->members->map(function ($member){
                return $member->id;
            })->toArray();

            $removals=array_diff($current_members, $request->salesGroup['userIds']);
            $additions=array_diff($request->salesGroup['userIds'], $current_members);

            DB::beginTransaction();




            if(count($removals)>0){
                $salesGroup->members()->detach($removals);
            }


            if(count($additions)>0){
                $salesGroup->members()->attach($additions);
            }

            $salesGroup->members()->attach($request->salesGroup['userIds']);
            $salesGroup->save();

            DB::commit();

            $result['result']='Saved';
            $result['message']='Sales group has been created Successfully.';

        }
        else{
            $result['message']='Please add at least 1 member';
        }

        return response()->json($result,200);
    }

    public function getSalesGroup(Request $request){

        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:sales_groups,id'
        ]);
        $group= SalesGroup::find($data['groupId']);


        return response()->json([
            'group'=>[
                'id'=>$group->id,
                'name'=>$group->name,
                'members'=>$group->members->map(function($member){
                    return [
                        'id'=>$member->id,
                        'name'=>$member->name
                    ];
                })
            ]
        ], 200);
    }

    public function delete(Request $request){
        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:sales_groups,id'
        ]);

        $group= SalesGroup::find($data['groupId']);
        DB::beginTransaction();
        $group->members()->detach();
        $group->delete();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'Sales Group has been deleted successfully.'
        ],200);    }

    public function view(SalesGroup $group){
//        $this->authorize('view', $userGgroup);

        return view('sales-group.sales-group-view')->with(['salesGroup'=>$group]);
    }

}
