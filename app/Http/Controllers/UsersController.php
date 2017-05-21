<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::all(['id','name', 'email']);
        $roles=Role::all(['id','name']);
        return view('user.index')->with([
            'users' => $users,
            'roles'=>$roles
        ]);
    }
}
