<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Journal;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UsergroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function validator(array $data, $isUpdateRequest=false)
    {
        $rules=[
            'userGroupName' => 'required|string',
            'userId' =>'required|integer|exists:users,id',

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










    public function getUserGroupAjaxPending(){
//        $this->authorize('index',userGroup::class);

        return DataTables::of(Index_userGroupre)
            ->addColumn('action',
                function ($userGroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editUserGroup('.$userGroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteUserGroup('.$userGroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                       <a onClick="viewUserGroup($userGroup->id)" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })



            ->addColumn('user_group_name',
                function ($userGroup){
                    return  substr($userGroup->name,0,70) . ' ....';
                })

            ->rawColumns(['id','name', 'user_name'])
            ->make(true);

    }



    public function createUserGroup(Request $request){
//        $this->authorize('create',Appointment::class);
        $this->validator($request->userGroup)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if(is_numeric($request->userGroup['userId'])){
            $user=User::findOrFail($request->userGroup['userId']);

            if(is_null($user)){
                $result['message']='Customer Not Found.';
            }
            else{
                $userGroup = new userGroup();

                $userGroup->name = $request->userGroup['userGroupName'];
                $userGroup->userId = $request->userGroup['userGroupUserId'];
                DB::beginTransaction();
                $user->userGroup()->save($userGroup);
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



}
