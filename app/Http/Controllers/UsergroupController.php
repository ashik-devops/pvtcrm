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



}
