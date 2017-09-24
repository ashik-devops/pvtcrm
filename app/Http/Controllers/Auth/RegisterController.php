<?php

namespace App\Http\Controllers\Auth;

use App\Timezone;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use App\User_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'initial'=>'required|string|max:8|unique:user_profiles',
            'primary_phone_no'=>'required|string|max:32|unique:user_profiles',
            'secondary_phone_no'=>'string|max:32|nullable',
            'street_address_1'=>'required|string|max:128',
            'street_address_2'=>'string|max:128|nullable',
            'city'=>'required|string|max:32',
            'state'=>'required|string|max:32',
            'country'=>'required|string|max:32',
            'zip'=>'required|string|max:8',
            'role'=>'required|integer|exists:roles,id',
            'timezone'=>'required|integer|exists:timezones,id',

        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /*Create the user*/

        $this->authorize('create',User::class);
//        $data = $data['userData'];
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->status = $data['status'];
        $user_profile = new User_profile();
        $user_profile->profile_pic = null;
        $user_profile->initial = $data['initial'];
        $user_profile->primary_phone_no = $data['primary_phone_no'];
        $user_profile->secondary_phone_no = $data['secondary_phone_no'];
        $user_profile->address_line_1 = $data['street_address_1'];
        $user_profile->address_line_2 = $data['street_address_2'];
        $user_profile->city = $data['city'];
        $user_profile->state = $data['state'];
        $user_profile->country = $data['country'];
        $user_profile->zip = $data['zip'];


        DB::beginTransaction();
        $user->save();
        $user->profile()->save($user_profile);
        Role::find($data['role'])->users()->save($user);
        Timezone::find($data['timezone'])->profiles()->save($user->profile);

        DB::commit();

        return $user;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showRegistrationForm()
    {
        $roles=Role::all(['id','name']);
        return view('auth.register')->with([
            'roles'=>$roles
        ]);
    }

    protected  function registered(Request $request, $user)
    {
       return response()->json(['result' => "Saved", 'message' => 'User is Saved.'], 200);
    }


}
