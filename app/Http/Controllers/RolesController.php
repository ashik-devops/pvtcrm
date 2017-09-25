<?php

namespace App\Http\Controllers;

use App\Action;
use App\Appointment;
use App\Policy;
use App\Role;
use App\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    public function validator(array $data, $isUpdate=false): \Illuminate\Contracts\Validation\Validator{
        $rules=[
            'name'=>'required|string|max:32|unique:roles'
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
                return '<a href="#" class="btn btn-success">View</a>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                        ';
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
    }

    public function update(){

    }

    public function delete(){

    }
}
