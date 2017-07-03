<?php

namespace App\Http\Controllers;

use App\Policies\UserPolicy;
use App\Role;
use App\User_profile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use DB;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, User $user = null)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'pro_pic'=>'image',
            'email' => 'required|string|email|max:255|unique:users'.is_null($user)===FALSE?',NULL,'.$user->id:'',
            'password' => 'required|string|min:6|confirmed',
            'initial'=>'required|string|max:8|unique:user_profiles'.(is_null($user) && is_null($user->profile->id))===FALSE?',NULL,'.$user->profile->id:'',
            'primary_phone_no'=>'required|string|max:32|unique:user_profiles'.(is_null($user) && is_null($user->profile->id))===FALSE?',NULL,'.$user->profile->id:'',
            'secondary_phone_no'=>'string|max:32|nullable',
            'street_address_1'=>'required|string|max:128',
            'street_address_2'=>'string|max:128|nullable',
            'city'=>'required|string|max:32',
            'state'=>'required|string|max:32',
            'country'=>'required|string|max:32',
            'zip'=>'required|string|max:8',
            'role'=>'required|integer',
            'status'=>'required|integer|max:1'
        ]);
    }

    /**
     * Show the all users falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::paginate(10);
        $roles=Role::all(['id','name']);
        return view('user.index')->with([
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function createUser(Request $request){
        $user = new User();
        $user->name = $request->user['userName'];
        $user->email = $request->user['userEmail'];
        $user->password = $request->user['userPassword'];
        $user->status = $request->user['userStatus'];
        $user->role_id = $request->user['userRole'];

        $user_profile = new User_profile();
        $user_profile->profile_pic = null;
        $user_profile->initial = $request->user['userInitial'];
        $user_profile->primary_phone_no = $request->user['userPrimaryPhone'];
        $user_profile->secondary_phone_no = $request->user['userSecondaryPhone'];
        $user_profile->address_line_1 = $request->user['userStreetAddress_1'];
        $user_profile->address_line_2 = $request->user['userStreetAddress_2'];
        $user_profile->city = $request->user['userCity'];
        $user_profile->state = $request->user['userState'];
        $user_profile->country = $request->user['userCountry'];
        $user_profile->zip = $request->user['userZip'];


        DB::beginTransaction();
        $user->save();
        $user->profile()->save($user_profile);
        DB::commit();
        return response()->json(['result' => "Saved", 'message' => 'User is Saved.'], 200);
    }
    /**
     * Shows edit form for requested user.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user){
        return view('user.view-profile')->with([
            'user' => $user,
            'roles'=>Role::all()
        ]);
    }


    /**
     * Updates current user.
     *
     * @param \App\User $user
     * @param \Illuminate\Http\Request Request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(User $user, Request $request){
        $this->validator($request->all(), $user)->validate();


        /* Update the user */
        $data = $request->all();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->status=$data['status'];
        $user->role_id=$data['role'];
        $user->profile->initial=$data['initial'];
        $user->profile->primary_phone_no=$data['primary_phone_no'];
        $user->profile->secondary_phone_no=$data['secondary_phone_no'];
        $user->profile->address_line_1=$data['street_address_1'];
        $user->profile->address_line_2=$data['street_address_2'];
        $user->profile->city=$data['city'];
        $user->profile->state=$data['state'];
        $user->profile->country=$data['country'];
        $user->profile->zip=$data['zip'];

        /*handle image upload*/
        if ($request->hasFile('pro_pic') && $request->file('pro_pic')->isValid()) {
            $user->profile->profile_pic = $request->file('pro_pic')->storePublicly('assets/images/profiles', ['disk'=>'public']);

        }

        /* Handle password reset*/
        if($data['password']!='unchanged'){
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        $user->profile->save();
        return back();
    }

}
