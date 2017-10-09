<?php

namespace App\Http\Controllers;

use App\Address;
use App\Policies\UserPolicy;
use App\Role;
use App\Timezone;
use App\User_profile;
use Illuminate\Support\Facades\Auth;
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

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pro_pic' => 'image',
            'email' => 'required|string|email|max:255|unique:users'
            . is_null($user) === false ? ',NULL,' . $user->id : '',
            'password' => 'required|string|min:6|confirmed',
            'primary_phone_no' => 'required|string|max:32|unique:user_profiles'
            . (is_null($user) && is_null($user->profile->id)) === false
                ? ',NULL,' . $user->profile->id : '',
            'secondary_phone_no' => 'string|max:32|nullable',
            'street_address_1' => 'required|string|max:128',
            'street_address_2' => 'string|max:128|nullable',
            'city' => 'required|string|max:32',
            'state' => 'string|max:32',
            'country' => 'required|string|max:32',
            'zip' => 'required|string|max:8',
            'timezone' => 'required|integer|exists:timezones,id',
        ];

        if(Auth::user()->can('create', User::class)){
            $rules=array_merge($rules, [
                'status' => 'required|integer|max:1',
                'role' => 'required|integer|exists:roles,id',

            ]);
        }
        return Validator::make($data, $rules);
    }

    /**
     * Show the all users falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $this->authorize('index', User::class);
        $users = User::paginate(10);
        $roles=Role::all(['id','name']);
        return view('user.index')->with([
            'users' => $users,
            'role' => $roles
        ]);
    }

    public function view(User $user){
        $this->authorize('view', $user);

        return view('user.view-profile')->with(['user'=>$user]);
    }

    public function listAll(Request $request){
//        $this->authorize('index',User::class);
        $users = new User();
        if(!empty($request->q)){

            $users = $users->where('name', 'like', "%$request->q%");

        }

        return response()->json([
            'items' => $users->select(['id', 'name'])->get(),
            'total_count'=>$users->count()
        ],200);
    }

    public function listAllTeamManagers(Request $request){
        $this->authorize('index',User::class);
        $users = new User();
        $users->role->policies()->whereIn('scope',['*', 'team'])->where('action','*');
        if(!empty($request->q)){

            $users = $users->where('name', 'like', "%$request->q%");

        }

        return response()->json([
            'items' => $users->select(['id', 'name'])->get(),
            'total_count'=>$users->count()
        ],200);
    }

    public function listAllTeamMembers(Request $request){
        $this->authorize('index',User::class);
        $users = new User();
        $users->role->policies()->whereIn('scope',['*', 'team'])->whereNotIn('action','*');
        if(!empty($request->q)){

            $users = $users->where('name', 'like', "%$request->q%");

        }

        return response()->json([
            'items' => $users->select(['id', 'name'])->get(),
            'total_count'=>$users->count()
        ],200);
    }

    /**
     * Shows edit form for requested user.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('user.edit-profile')->with([
            'user' => $user,
            'role'=>Role::all()
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
        $this->authorize('update', $user);
        $this->validator($request->all(), $user)->validate();


        /* Update the user */
        $data = $request->all();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        if(Auth::user()->can('create', User::class)) {
            $user->status = $data['status'];
        }
        $user->profile->initial=mb_convert_case($data['first_name'][0].$data['last_name'][0], MB_CASE_UPPER);
        $user->profile->primary_phone_no=$data['primary_phone_no'];
        $user->profile->secondary_phone_no=$data['secondary_phone_no'];

        if(is_null($user->profile->address)){
            $address=new Address();
        }
        else {
            $address=$user->profile->address;
        }

        $address->street_address_1=$data['street_address_1'];
        $address->street_address_2=$data['street_address_2'];
        $address->city=$data['city'];
        $address->state=$data['state'];
        $address->country=$data['country'];
        $address->zip=$data['zip'];
        $address->type='CONTACT';
        $timezone=Timezone::find($data['timezone']);
        /*handle image upload*/
        if ($request->hasFile('pro_pic') && $request->file('pro_pic')->isValid()) {
            $user->profile->profile_pic = $request->file('pro_pic')->storePublicly('assets/images/profiles', ['disk'=>'public']);
        }

        /* Handle password reset*/
        if($data['password']!='unchanged'){
            $user->password = bcrypt($data['password']);
        }
        DB::beginTransaction();

        $user->save();
        $user->profile->address()->save($address);
        $user->profile->save();
        if(Auth::user()->can('create', User::class)) {
            Role::find($data['role'])->users()->save($user);
        }$timezone->profiles()->save($user->profile);
        DB::commit();
        return back()->with(['message'=>'User Updated Successfully.', 'message_class'=>'alert-success']);
    }

    public function delete(User $user){
//        $this->authorize('delete', User::class);
        if($user->customers()->count() == 0){
            $user->delete();
            return redirect(route('users-index'))->with(['message'=>'User deleted Successfully.', 'message_class'=>'alert-success']);
        }
        return back()->with(['result'=>'error', 'message'=>'Please assign all contacts to some other user before deleting.', 'message_class'=>'alert-danger']);

    }

}
