<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Index_usergroup;
use App\Journal;
use App\Task;
use App\User;
use App\Sales_team;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SalesTeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function validator(array $data, $isUpdateRequest=false)
    {
        $rules=[
            'salesTeamName' => 'required|string',
            'salesTeamMembers' =>'array|exists:users,id',
            'salesTeamManager'=>'required|int|exists:users,id'
        ];

        $messages=[
            'salesTeamMembers.exists'=>'One of more of selected users not found or could not be added to group.',
            'salesTeamManager.exists'=>'Selected team manager could not be added.'
        ];

        if($isUpdateRequest){
            $rules=array_merge($rules,[
                'salesTeamId'=>'required|integer|exists:user_groups,id',
            ]);
        }

        return Validator::make($data, $rules, $messages);
    }


    public function index()
    {
        return view('sales-team.index-datatable');
    }

    public function getSales_teamsAjax(){

        return DataTables::of(Index_usergroup::all())
            ->addColumn('action',
                function ($usergroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editSales_team('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteSales_team('.$usergroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
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
        $this->validator($request->salesTeam)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

            $team = new Sales_team();
            $team->name = $request->salesTeam['salesTeamName'];

            DB::beginTransaction();

            $team->save();
            $team->members()->attach($request->salesTeam['salesTeamManager'], ['role'=>'MANAGER']);
            $team->members()->attach($request->salesTeam['salesTeamMembers'], ['role'=>'MEMBERS']);
            DB::commit();

            $result['result']='Saved';
            $result['message']='Sales team has been created Successfully.';


        return response()->json($result,200);
    }


    public function update(Request $request){
        $this->validator($request->usersGroup, true)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        if($request->salesTeam['salesTeamMembers']){
            $team = Sales_team::find($request->salesTeam['salesTeamId']);
            $team->name = $request->salesTeam['salesTeamName'];

            $current_members=$team->members->map(function ($member){
                return $member->id;
            })->toArray();

            $removals=array_diff($current_members, $request->salesTeam['salesTeamMembers']);
            $additions=array_diff($request->salesTeam['salesTeamMembers'], $current_members);

            DB::beginTransaction();




            if(count($removals)>0){
                $team->members()->detach($removals);
            }


            if(count($additions)>0){
                $team->members()->attach($additions);
            }

            $team->members()->attach($request->salesTeam['salesTeamMembers']);
            $team->save();

            DB::commit();

            $result['result']='Saved';
            $result['message']='sales team has been created Successfully.';

        }
        else{
            $result['message']='Please add at least 1 member';
        }

        return response()->json($result,200);
    }

    public function getSales_team(Request $request){

        $data =$this->validate($request, [
            'groupId'=>'required|int|exists:user_groups,id'
        ]);
        $group= Sales_team::find($data['groupId']);


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

        $group= Sales_team::find($data['groupId']);
        DB::beginTransaction();
        $group->members()->detach();
        $group->delete();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'user Group has been deleted successfully.'
        ],200);    }

    public function view(Sales_team $group){
//        $this->authorize('view', $userGgroup);

        return view('user-group.user-group-view')->with(['Sales_team'=>$group]);
    }

}
