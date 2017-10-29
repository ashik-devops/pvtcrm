<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Index_usergroup;
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
            'UserGroupName' => 'required|string',
            'userIds' =>'required|array|exists:users,id',

        ];

        $messages=[
            'userIds.required'=>'Please select at least one member.',
            'userIds.exists'=>'One of more of selected users not found or could not be added to group.'
        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'UserGroupId'=>'required|integer|exists:user_groups,id',
            ]);
        }

        return Validator::make($data, $rules, $messages);
    }


    public function index()
    {
        return view('user-group.index-datatable');
    }

    public function getUserGroupsAjax(){

        return DataTables::of(Index_usergroup::all())
            ->addColumn('action',
                function ($usergroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editUserGroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteUserGroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  href="'.route('view-user-group',['group'=>$usergroup->id]).'"><i class="glyphicon glyphicon-eye"></i> View</a>';
                })

            ->addColumn('name',
                function ($usergroup){
                    return $usergroup->name;
                })


            ->rawColumns(['action','name','user_id'])
            ->make(true);

    }


    public function create(Request $request){
//        $this->authorize('create',Appointment::class);
        $this->validator($request->UserGroup)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->UserGroup['userIds']){
            $UserGroup = new UserGroup();
            $UserGroup->name = $request->UserGroup['UserGroupName'];

            DB::beginTransaction();

            $UserGroup->save();

            $UserGroup->members()->attach($request->UserGroup['userIds']);
            DB::commit();

            $result['result']='Saved';
            $result['message']='user group has been created Successfully.';

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

        if($request->UserGroup['userIds']){
            $UserGroup = UserGroup::find($request->UserGroup['UserGroupId']);
            $UserGroup->name = $request->UserGroup['UserGroupName'];

            $current_members=$UserGroup->members->map(function ($member){
                return $member->id;
            })->toArray();

            $removals=array_diff($current_members, $request->UserGroup['userIds']);
            $additions=array_diff($request->UserGroup['userIds'], $current_members);

            DB::beginTransaction();




            if(count($removals)>0){
                $UserGroup->members()->detach($removals);
            }


            if(count($additions)>0){
                $UserGroup->members()->attach($additions);
            }

            $UserGroup->members()->attach($request->UserGroup['userIds']);
            $UserGroup->save();

            DB::commit();

            $result['result']='Saved';
            $result['message']='user group has been created Successfully.';

        }
        else{
            $result['message']='Please add at least 1 member';
        }

        return response()->json($result,200);
    }

    public function getUserGroupAjax(Request $request){

        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:user_groups,id'
        ]);
        $group= UserGroup::find($data['groupId']);


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
            'groupId'=>'required|int|exists:user_groups,id'
        ]);

        $group= UserGroup::find($data['groupId']);
        DB::beginTransaction();
        $group->members()->detach();
        $group->delete();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'user Group has been deleted successfully.'
        ],200);    }

    public function view(UserGroup $group){
//        $this->authorize('view', $userGgroup);

        return view('user-group.user-group-view')->with(['UserGroup'=>$group]);
    }

}
