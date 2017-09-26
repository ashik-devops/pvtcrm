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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'=>'required|integer|exists:roles,id',
            'status'=>'required|integer|max:1'

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
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->status = $data['status'];
        $user_profile = new User_profile();
        $user_profile->profile_pic = null;
        $user_profile->initial=mb_convert_case($data['first_name'][0].$data['last_name'][0], MB_CASE_UPPER);

        DB::beginTransaction();
        $user->role()->associate(Role::find($data['role']));
        $user->save();
        $user->profile()->save($user_profile);

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
            'role'=>$roles
        ]);
    }

    protected  function registered(Request $request, $user)
    {
       return response()->json(['result' => "Saved", 'message' => 'User is Saved.'], 200);
    }


}
