<?php

namespace App\Http\Controllers;

use App\Action;
use App\Appointment;
use App\Policy;
use App\Role;
use App\Scope;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Zend\Diactoros\Response;

class RolesController extends Controller
{
    public function validator(array $data, Role $role=null): \Illuminate\Contracts\Validation\Validator{
        $rules=[
            'name'=>'required|string|max:32|unique:roles,name',
            'access'=>'required|array'
        ];

        if(!is_null($role)){
            $rules['name']='required|string|max:32|unique:roles,name,'.$role->id;
        }
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
                $buttons =  '<a href="'.route('edit-role', [$role->id]).'" class="btn btn-primary">Edit</a>
                        ';
                if($role->users()->count()==0 ){
                    $buttons.='<button onclick="deleteRole('.$role->id.')" class="btn btn-danger">Delete</button>';
                }
                return $buttons;
            })
            ->addColumn('permissions', function ($role){
                $content = "<ul class='list-unstyled'><li>".$role->policies->map(
                    function($policy){
                        return $policy->scope->name." : ".$policy->action->name;
                    })
//                    ->implode('</li><li>').'</li></ul>';
                ->implode('</li><li>').'</li></ul>';
                return str_replace('*', 'all', $content);
            })
            ->rawColumns(['action', 'permissions'])
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
        $this->createPolicies($request->access, $role);

        DB::commit();

       return redirect(route('role-index'))->with(['message'=>'Role Created Succesfully.', 'message_class'=>'alert-success']);
    }
    public function edit(Role $role){
        $access=[];
        $role->policies()->get()->map(function ($policy) use (&$access){
            $access[$policy->scope_id][$policy->action_id]=true;
        });

        return view('user.role.edit')->with(['role'=>$role, 'access'=>$access]);
    }

    public function update(Request $request, Role $role){
        $this->validator($request->all(), $role)->validate();
        DB::beginTransaction();
        $role->name=$request->name;
        $role->policies()->detach();
        $this->createPolicies($request->access, $role);
        $role->save();
        DB::commit();

        return redirect(route('role-index'))->with(['message'=>'Role Updated Succesfully.', 'message_class'=>'alert-success']);
    }

    public function delete(Request $request): JsonResponse{
        $role=Role::find($request->id);
        $usercount=$role->users()->count();
        if($usercount > 0){
            return response()->json(['result'=>'error', 'message'=>'This role is assigned to '.$usercount.' user(s). Please assign them to another role first.'], 422);
        }
        DB::beginTransaction();
        $role->policies()->detach();
        $role->delete();
        DB::commit();

        return response()->json(['result'=>'Success', 'message'=>'The Role has been deleted.'], 200);
    }

    /**
     * Created policies based on user input
     *
     * @param Request $request
     * @param         $role
     */
    private function createPolicies(array $access, Role $role)
    {
        foreach ($access as $scope => $actions) {
            $scope = Scope::find($scope);
            foreach ($actions as $action => $value) {
                $action = Action::find($action);
                $policy=Policy::whereHas('action',
                    function ($query) use ($action) {
                        $query->where('id', $action->id);
                    })
                    ->whereHas('scope', function ($query) use ($scope) {
                        $query->where('id', $scope->id);
                    })
                    ->first();

                $role->policies()->attach($policy);
            }

        }
    }
}
