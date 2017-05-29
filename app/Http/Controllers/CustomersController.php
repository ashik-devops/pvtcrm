<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
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
    public function validate(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|string|email|max:255|unique',
            'title'=>'required|string|max:32',
            'primary_phone_no'=>'required|string|max:32|unique',
            'street_address_1'=>'required|string',
            'street_address_2'=>'string|nullable',
            'city'=>'required|string|max:32',
            'state'=>'required|string|max:32',
            'country'=>'required|string|max:32',
            'zip'=>'required|string|max:8',
        ]);
    }

    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $customers = Customer::paginate(10);
        return view('customer.index')->with([
            'customers' => $customers,
        ]);
    }

}
