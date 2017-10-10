<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Journal;
use App\Task;
use App\User;
use App\UserGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function validator(array $data, $isUpdateRequest=false)
    {
        $rules=[
            'userGroupName' => 'required|string',
//            'userIds.*' =>'required|integer|exists:users,id',

        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'userGroupId'=>'required|integer|exists:user_groups,id',
            ]);
        }

        return Validator::make($data, $rules);
    }


    public function index(){

        return view('user-group.index-datatable');
    }
    public function getUserGroupsAjax(){

        return DataTables::of(UserGroup::all())
            ->addColumn('action',
                function ($usergroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editUserGroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteUserGroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  onClick="viewUserGroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('name',
                function ($usergroup){
                    return $usergroup->name;
                })
            ->rawColumns(['action','name'])
            ->make(true);

    }


    public function create(Request $request){
//        $this->authorize('create',Appointment::class);
        $this->validator($request->userGroup)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->userGroup['userIds']){
            $userGroup = new UserGroup();
            $userGroup->name = $request->userGroup['userGroupName'];

            DB::beginTransaction();

            $userGroup->save();

            $userGroup->members()->attach($request->userGroup['userIds']);
            DB::commit();

            $result['result']='Saved';
            $result['message']='User group has been created Successfully.';

        }
        else{
            $result['message']='Please add at least 1 member';
        }

        return response()->json($result,200);
    }


    public function update(Request $request){
        $this->validator($request->userGroup, true)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->userGroup['userIds']){
            $userGroup = UserGroup::find($request->userGroup['userGroupId']);
            $userGroup->name = $request->userGroup['userGroupName'];

            $current_members=$userGroup->members->map(function ($member){
                return $member->id;
            });

            $removals=array_diff($current_members, $request->userGroup['userIds']);
            $additions=array_diff($request->userGroup['userIds'], $current_members);

            DB::beginTransaction();




            if(count($removals)>0){
                $userGroup->members()->detach($removals);
            }


            if(count($additions)>0){
                $userGroup->members()->attach($removals);
            }

            $userGroup->members()->attach($request->userGroup['userIds']);
            $userGroup->save();

            DB::commit();

            $result['result']='Saved';
            $result['message']='User group has been created Successfully.';

        }
        else{
            $result['message']='Please add at least 1 member';
        }

        return response()->json($result,200);
    }

    public function getGroup(Request $request){

        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:user_groups,id'
        ]);
        $group= UserGroup::find($data['groupId']);


        return response()->json(['group'=>[
            'id'=>$group->id,
            'name'=>$group->name,
            'members'=>$group->members->map(function($member){
                return [
                    'id'=>$member->id,
                    'name'=>$member->name
                ];
            })
        ], 200);
    }

    public function delete(Request $request){
        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:user_groups,id'
        ]);

        $group= UserGroup::find($data['groupId']);
        DB::beginTransaction();
        $group->members()->detach();
        $group->delete();
        DB::commit();

        return response()->json([
            'result'=>'success',
            'message'=>'Group has been deleted successfully.'
        ],200);    }


}
