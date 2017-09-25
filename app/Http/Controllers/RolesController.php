<?php

namespace App\Http\Controllers;

use App\Action;
use App\Appointment;
use App\Policy;
use App\Role;
use App\Scope;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Zend\Diactoros\Response;

class RolesController extends Controller
{
    public function validator(array $data, $isUpdate=false): \Illuminate\Contracts\Validation\Validator{
        $rules=[
            'name'=>'required|string|max:32|unique:roles',
            'access'=>'required|array'
        ];

        return Validator::make($data, $rules);
    }

    public function index(){
        return view('user.role.index');
    }

    public function getRolesAjax(){
        return DataTables::of(Role::all())
            ->addColumn('count', function($role){
                return $role->users()->count();
            })
            ->addColumn('action',function ($role){
                $buttons =  '<a href="#" class="btn btn-success">View</a>
                        <a href="#" class="btn btn-primary">Edit</a>
                        ';
                if($role->users()->count()==0 ){
                    $buttons.='<button onclick="deleteRole('.$role->id.')" class="btn btn-danger">Delete</button>';
                }
                return $buttons;
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function createForm(){
        return view('user.role.create');
    }

    public function create(Request $request){
        $this->validator($request->all())->validate();
        $role = new Role();
        $role->name=$request->name;

        DB::beginTransaction();
        $role->save();
        foreach ($request->access as $scope=>$actions){
            $scope=Scope::find($scope);
            foreach ($actions as $action=>$value){
                $action=Action::find($action);
                $role->policies()->attach(Policy::whereHas('action', function ($query) use ($action){
                    $query->where('id', $action->id);
                })
                    ->whereHas('scope',function ($query) use ($scope){
                    $query->where('id', $scope->id);
                })
                ->first()
                );
            }

        }

        DB::commit();

       return redirect(route('role-index'))->with(['message'=>'Role Created Succesfully.', 'message_class'=>'alert-success']);
    }

    public function update(){

    }

    public function delete(Request $request): JsonResponse{
        $role=Role::find($request->id);

        $usercount=$role->users()->count();
        if($usercount > 0){
            return response()->json(['result'=>'error', 'message'=>'This role is assigned to '.$usercount.' user(s). Please assign them to another role first.'], 422);
        }
        DB::beginTransaction();
        $role->policies()->delete();
        $role->delete();
        DB::commit();

        return response()->json(['result'=>'Success', 'message'=>'The Role has been deleted.'], 200);
    }
}
