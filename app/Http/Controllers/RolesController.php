<?php

namespace App\Http\Controllers;

use App\Policy;
use App\Scope;
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
        return view('user.role.create');
    }

    public function create(Request $request){
        dd($request->all());
    }

    public function update(){

    }

    public function delete(){

    }
}
