<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Index_sales_team;
use App\Index_usergroup;
use App\Journal;
use App\Task;
use App\User;
use App\SalesTeam;
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
                'salesTeamId'=>'required|integer|exists:sales_teams,id',
            ]);
        }

        return Validator::make($data, $rules, $messages);
    }


    public function index()
    {
        return view('sales-team.index-datatable');
    }

    public function getSalesTeamsAjax(){

        return DataTables::of(SalesTeam::all())
            ->addColumn('action',
                function ($team){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editSalesTeam('.$team->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteSalesTeam('.$team->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  href="'.route('view-sales-team',['team'=>$team->id]).'"><i class="glyphicon glyphicon-eye"></i> View</a>';
                })

            ->addColumn('name',
                function ($team){
                    return $team->name;
                })
            ->addColumn('manager_name', function($team){
                if($team->managers->count() == 0){
                    return '';
                }
                return '<ul><li>'.implode('</li><li>', $team->managers->map(function ($manager){
                        return '<a href="'.route('profile-view', ['user'=>$manager->id]).'">'.$manager->name.'</a>';

                    })->toArray()).'</li></ul>';
            })
            ->addColumn('user_count', function($team){
                return $team->members->count() + $team->managers->count();
            })
            ->rawColumns(['action','manager_name', 'name'])
            ->make(true);

    }


    public function create(Request $request){
//        $this->authorize('create',Appointment::class);
        $this->validator($request->salesTeam)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        $team = new SalesTeam();
        $team->name = $request->salesTeam['salesTeamName'];

        DB::beginTransaction();

        $team->save();
        $team->members()->attach($request->salesTeam['salesTeamManager'], ['role'=>'MANAGER']);
        $team->managers()->attach(array_diff($request->salesTeam['salesTeamMembers'], [$request->salesTeam['salesTeamManager']]), ['role'=>'MEMBER']);
        DB::commit();

        $result['result']='Saved';
        $result['message']='Sales team has been created Successfully.';


        return response()->json($result,200);
    }


    public function update(Request $request){
        $this->validator($request->salesTeam, true)->validate();

        $result=[
            'result'=>'Error',
            'message'=>'Something went wrong.'
        ];

        $team = SalesTeam::find($request->salesTeam['salesTeamId']);
        $team->name = $request->salesTeam['salesTeamName'];

        $current_members=$team->members->map(function ($member){
            return $member->id;
        })->toArray();

        $member_removals=array_diff($current_members, $request->salesTeam['salesTeamMembers']);
        $member_additions=array_diff($request->salesTeam['salesTeamMembers'], $current_members);
        $current_managers=$team->managers->map(function ($manager){
            return $manager->id;
        })->toArray();

        $manager_removals=array_diff($current_managers, [$request->salesTeam['salesTeamManager']]);
        $manager_additions=array_diff([$request->salesTeam['salesTeamManager']], $current_managers);

        DB::beginTransaction();

        if(count($member_removals)>0){
            $team->members()->detach($member_removals);
        }


        if(count($member_additions)>0){
            $team->members()->attach($member_additions, ['role'=>'MEMBER']);
        }

        if(count($manager_removals)>0){
            $team->managers()->detach($manager_removals);
        }


        if(count($manager_additions)>0){
            $team->managers()->attach($manager_additions, ['role'=>'MANAGER']);
        }

        $team->save();

        DB::commit();

        $result['result']='Saved';
        $result['message']='Sales team has been updated Successfully.';

        return response()->json($result,200);
    }

    public function getSalesTeamAjax(Request $request){

        $data =$this->validate($request, [
            'salesTeamId'=>'required|int|exists:sales_teams,id'
        ]);
        $team= SalesTeam::find($data['salesTeamId']);


        return response()->json([
            'salesTeam'=>[
                'id'=>$team->id,
                'name'=>$team->name,
                'members'=>$team->members->map(function($member){
                    return [
                        'id'=>$member->id,
                        'name'=>$member->name
                    ];
                }),
                'managers'=>$team->managers->map(function($manager){
                    return [
                        'id'=>$manager->id,
                        'name'=>$manager->name
                    ];
                }),
            ]
        ], 200);
    }

    public function delete(Request $request){
        $data =$this->validate($request, [
            'salesTeamId'=>'required|int|exists:sales_teams,id'
        ]);

        $team= SalesTeam::find($data['salesTeamId']);
        DB::beginTransaction();
        $team->members()->detach();
        $team->managers()->detach();
        $team->delete();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'user Group has been deleted successfully.'
        ],200);    }




        public function removeMemberAjax(Request $request){
            $data =$this->validate($request, [
                'salesTeamId'=>'required|int|exists:sales_teams,id',
                'userId'=>'required|int|exists:users,id'
            ]);

            $team= SalesTeam::find($data['salesTeamId']);
            $user = User::find($data['userId']);
            DB::beginTransaction();
            $team->members()->detach([$user->id]);

//            $team->delete();
            DB::commit();

            return response()->json([
                'result'=>'Success',
                'message'=>'Member has been removed successfully.'
            ],200);

        }




    public function newMemberAjax(Request $request){
        $data =$this->validate($request, [
            'salesTeamId'=>'required|int|exists:sales_teams,id',
            'userIds'=>'required|array|exists:users,id'
        ]);

        $team= SalesTeam::find($data['salesTeamId']);
        $current_members=$team->members->map(function ($member){
            return $member->id;
        })->toArray();
        $current_managers = $team->managers->map(function ($manager){
            return $manager->id;
        })->toArray();

        $additions = array_diff($data['userIds'], $current_members, $current_managers);

        $user = User::find($data['userIds']);
        DB::beginTransaction();
        $team->members()->attach($additions, ['role'=>'MEMBER']);

//            $team->delete();
        $team->save();
        DB::commit();

        return response()->json([
            'result'=>'Success',
            'message'=>'Member has been added successfully.'
        ],200);

    }

        public function changeNameAjax(Request $request){
            $response_msg=[
                'result'=>'error',
                'message'=>'Failed to update team name.'
            ];
            $data =$this->validate($request, [
                'salesTeamId'=>'required|int|exists:sales_teams,id',
                'salesTeamName'=>'required|string',
            ]);

            $team= SalesTeam::find($data['salesTeamId']);
            $team->name= $data['salesTeamName'];
            DB::beginTransaction();

            $team->save();

            $response_msg=[
                'result'=>'Success',
                'message'=>'Team name has been updated successfully.'
            ];

            DB::commit();

            return response()->json($response_msg,200);


        }


    public function view(SalesTeam $team){
//        $this->authorize('view', $userGgroup);

        return view('sales-team.sales-team-view')->with(['salesTeam'=>$team]);
    }

    public function changeManagerAjax(Request $request){
        $data =$this->validate($request, [
            'salesTeamId'=>'required|int|exists:sales_teams,id',
            'userId'=>'required|int|exists:users,id'
        ]);

        $team= SalesTeam::find($data['salesTeamId']);
        $user = User::find($data['userId']);
        $response=[
            'result'=>'erorr',
            'message'=>'Opps. Could not perform the request.'
        ];

        $current_managers=$team->managers->map(function ($manager){
            return $manager->id;
        })->toArray();
        DB::beginTransaction();
        $team->members()->detach([$user->id]);
        $team->managers()->detach($current_managers);
        $team->managers()->attach([$user->id], ['role'=>'MANAGER']);
        $team->managers()->attach($current_managers, ['role'=>'MEMBER']);
        $response=[
            'result'=>'Success',
            'message'=>$user->name.' has been made Team Manager.'
        ];
        DB::commit();

        return response()->json($response, 200);
    }


    public function getSalesTeamMemberOptions(Request $request, SalesTeam $team){

        $members = array_merge($team->members->map(function($member){
            return $member->id;
        })->toArray(), $team->managers->map(function($manager){
            return $manager->id;
        })->toArray());

        $users = User::whereNotIn('id', $members)->where('status', '=', 1);

        if($request->q){
            $users = $users->where(function($query) use ($request){
                return $query->where('first_name', 'LIKE', $request->q.'%')
                    ->orWhere('last_name', 'LIKE', $request->q.'%');
            });
        }

        return response()->json(['result'=>'Success','users'=>
            $users->get()->map(function($user){
                return ['value'=>$user->id, 'text'=>$user->name];
            })
        ], 200);
    }
}
