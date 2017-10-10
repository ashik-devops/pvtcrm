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
            'userGroupName' => 'required|string',
//            'userIds.*' =>'required|integer|exists:users,id',

        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'userGroupId'=>'required|integer|exists:userGroup,id',
            ]);
        }

        return Validator::make($data, $rules);
    }


    public function index(){

        return view('user-group.index-datatable');
    }

    public function getUserGroupsAjax(){

        return DataTables::of(Index_usergroup::all())
            ->addColumn('action',
                function ($usergroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editUsergroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteUsergroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  onClick="viewUsergroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
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

            $userGroup->users()->attach($request->userGroup['userIds']);
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

    }


}
