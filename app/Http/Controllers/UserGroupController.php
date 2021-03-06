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
use Illuminate\Support\Facades\Auth;
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
            'userIds' =>'required|array|exists:users,id',

        ];

        $messages=[
            'userIds.required'=>'Please select at least one member.',
            'userIds.exists'=>'One of more of selected users not found or could not be added to group.'
        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'userGroupId'=>'required|integer|exists:user_groups,id',
            ]);
        }

        return Validator::make($data, $rules, $messages);
    }


    public function index()
    {
        return view('user-group.index-datatable');
    }

    public function getUserGroupsAjax(){
        $groups=Auth::user()->groups;
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
            $groups=UserGroup::all();
        }
        return DataTables::of($groups)
            ->addColumn('action',
                function ($group){
                $buttons='';
                    if(Auth::user()->can('update', $group)){
                        $buttons.='<a  class="btn btn-xs btn-primary"  onClick="editUserGroup('.$group->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                    }
                    if(Auth::user()->can('delete', $group)){
                        $buttons.='<a  class="btn btn-xs btn-danger"  onClick="deleteUserGroup('.$group->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                    }
                    if(Auth::user()->can('view', $group)) {
                        $buttons .= '<a class="btn btn-xs btn-primary"  href="'.route('view-user-group',['group'=>$group->id]).'"><i class="glyphicon glyphicon-eye"></i> View</a>';
                    }
                    return $buttons;

                })

            ->addColumn('name',
                function ($group){
                    return $group->name;
                })

            ->addColumn('user_count', function($groups){
                return $groups->members->count();
            })

            ->rawColumns(['action','name','user_id'])
            ->make(true);

    }


    public function create(Request $request){
        $this->authorize('create',UserGroup::class);
        $this->validator($request->userGroup)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->userGroup['userIds']){
            $userGroup = new userGroup();
            $userGroup->name = $request->userGroup['userGroupName'];

            DB::beginTransaction();

            $userGroup->save();

            $userGroup->members()->attach($request->userGroup['userIds']);
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
        $this->validator($request->userGroup, true)->validate();
        $userGroup = userGroup::find($request->userGroup['userGroupId']);
        $this->authorize('update',$userGroup);
        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];
            $userGroup->name = $request->userGroup['userGroupName'];

            $current_members=$userGroup->members->map(function ($member){
                return $member->id;
            })->toArray();

            $removals=array_diff($current_members, $request->userGroup['userIds']);
            $additions=array_diff($request->userGroup['userIds'], $current_members);

            DB::beginTransaction();




            if(count($removals)>0){
                $userGroup->members()->detach($removals);
            }


            if(count($additions)>0){
                $userGroup->members()->attach($additions);
            }
            $userGroup->save();

            DB::commit();

            $result['result']='Saved';
            $result['message']='user group has been created Successfully.';


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





    public function changeNameAjax(Request $request, UserGroup $group){
        $response_msg=[
            'result'=>'error',
            'message'=>'Failed to update team name.'
        ];
        $data =$this->validate($request, ['userGroupName'=>'required|string',
        ]);

        $group->name= $data['userGroupName'];
        DB::beginTransaction();

        $group->save();

        $response_msg=[
            'result'=>'Success',
            'message'=>'Team name has been updated successfully.'
        ];

        DB::commit();

        return response()->json($response_msg,200);


    }



    public function getUserGroupMemberOptions(Request $request, UserGroup $group){

        $members = $group->members->map(function($member){
            return $member->id;
        })->toArray();

        $users = User::whereNotIn('id', $members)->where('status', '=', 1);

        if($request->q){
            $users = $users->where(function($query) use ($request){
                return $query->where('first_name', 'LIKE', $request->q.'%')
                    ->orWhere('last_name', 'LIKE', $request->q.'%');
            });
        }

        return response()->json(['result'=>'Success','users'=>
            $users->get()->map(function($user){
                return ['id'=>$user->id, 'text'=>$user->name];
            })
        ], 200);
    }




    public function addMemberAjax(Request $request, UserGroup $group){
        $data =$this->validate($request, [
            'userIds'=>'required|array|exists:users,id'
        ]);

        $current_members=$group->members->map(function ($member){
            return $member->id;
        })->toArray();


        $additions = array_diff($data['userIds'], $current_members);

        $user = User::find($data['userIds']);
        DB::beginTransaction();
        $group->members()->attach($additions);

        $group->save();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'Member has been added successfully.'
        ],200);

    }




    public function removeUserAjax(Request $request, UserGroup $group){
        $data =$this->validate($request, [
            'userId'=>'required|int|exists:users,id'
        ]);

        $user = User::find($data['userId']);
        DB::beginTransaction();
        $group->members()->detach([$user->id]);

//            $team->delete();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'Member has been removed successfully.'
        ],200);

    }




    public function delete(Request $request){
        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:user_groups,id'
        ]);

        $group= UserGroup::find($data['groupId']);
        $this->authorize('delete',$group);

        DB::beginTransaction();
        $group->members()->detach();
        $group->delete();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'user Group has been deleted successfully.'
        ],200);    }

    public function view(UserGroup $group){

        return view('user-group.user-group-view')->with(['userGroup'=>$group]);
    }

}
