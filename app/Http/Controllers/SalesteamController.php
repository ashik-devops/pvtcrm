<?php

namespace App\Http\Controllers;

use App\Sales_team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
class SalesteamController extends Controller
{
    public function index(){
        return view('sales-team.index-datatable');
    }

    public function getSalesTeamAjax(){


        return Datatables::of(Sales_team::all())

            ->addColumn('action',
                function ($salesTeam){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editSalesTeam('.$salesTeam->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteSalesTeam('.$salesTeam->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="viewtask('.$salesTeam->id.')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';

                })
            ->addColumn('user',
                function ($salesTeam){
                   if(!is_null($manager= $salesTeam->manager()))
                       return $manager->name;
                   return '';
                })
             ->addColumn('description',
                function ($salesTeam){
                    return  substr($salesTeam->note,0,70) . ' ....';
                })
            ->rawColumns(['name','user','note','action' ])
            ->make(true);
    }



    public function createSalesTeam(Request $request){
        $sales_team = new Sales_team();

        $user_id = $request->salesTeam['userId'];
        $sales_team->name = $request->salesTeam['salesTeamName'];
        $sales_team->note = $request->salesTeam['salesTeamNote'];


        DB::beginTransaction();
        $sales_team->save();

        DB::table('sales_teams_users')->insert([
            'user_id' => $user_id,
            'team_id' => $sales_team->id
        ]);
        DB::commit();

        return response()->json(['result' => "Saved", 'message' => 'Sales Team  is Saved.'], 200);


    }

    public function editSalesTeam(Request $request){


        $salesTeam = Sales_team::findOrFail($request->id);
        $current_user = DB::table('sales_teams_users')->where('team_id',$request->id)->first();
        $user = User::findOrFail($current_user->user_id);


        return response()->json([
            'salesTeam' => $salesTeam,
            'user' => $user,
        ], 200);
    }

    public function updateSalesTeam(Request $request){

        $salesTeam = Sales_team::findOrFail($request->salesTeam['salesTeamId']);
        $salesTeam->name = $request->salesTeam['salesTeamName'];
        $salesTeam->note = $request->salesTeam['salesTeamNote'];


        DB::beginTransaction();

        $salesTeam->save();
        DB::table('sales_teams_users')
            ->where('team_id','=',$request->salesTeam['salesTeamId'])
            ->update(['user_id'=> $request->salesTeam['userId']]);
        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Sales Team has been updated successfully.'
        ]);

    }

    public function deleteSalesTeam(Request $request){
        $sales_team = Sales_team::findOrFail($request->id);

        if(!is_null($sales_team)){

            $sales_team->delete();

            return response()->json([
                'result'=>'Success',
                'message'=>'Sales Team has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Sales Team not found.'
        ]);
    }

}
