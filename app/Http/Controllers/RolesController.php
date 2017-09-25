<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function validator(array $data, $isUpdate=false): Validator{
        $rules=[
            'name'=>'required|string|max:32|unique:rules'
        ];

        return Validator::make($data, $rules);
    }

    public function index(){
        return view('user.role.index');
    }

    public function createForm(){
        $structure = [];
        Policy::distinct()->select(['scope'])->get()->map(function($policy) use (&$structure) {
            $structure[$policy->scope]=Policy::distinct()->select('action')
                ->where('scope', '=', $policy->scope)->get()->map(function($action){
                    return $action->action;
                });
        });
        return view('user.role.create')->with('policy_structure', $structure);
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }
}
