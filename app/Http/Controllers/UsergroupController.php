<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Index_appointment;
use App\Journal;
use App\Task;
use App\UserGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UsergroupController extends Controller
{
    public function index(){

        return view('user-group.index-datatable');
    }


    public function createUsergroup(){


    }


    public function getUsergroupAjax(){


        return DataTables::of(UserGroup::all())

            ->addColumn('action',
                function ($usergroup){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editUsergroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteUsergroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a class="btn btn-xs btn-primary"  onClick="viewUsergroup('.$usergroup->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('name',
                function ($usergroup){
                    return $usergroup->name;
                })





            ->rawColumns(['action','name'])
            ->make(true);

    }

}
