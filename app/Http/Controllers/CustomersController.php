<?php

namespace App\Http\Controllers;

use App\Customer;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
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
    protected function validator(array $data)
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
        return view('customer.index');
    }

    public function getCustomersAjax(){
        return Datatables::of(Customer::select('id', 'first_name', 'last_name' ,'email', 'phone_no'))
            ->addColumn('action',
                function ($customer){
                    return
                        '<a href="#edit/'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#view/'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a><a href="#quick-view/" data-id="'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Quick View</a>'
                        ;
                })
            ->addColumn('name',
                function ($customer){
                    return '<a href="#view/'.$customer->id.'" >'.implode(', ', [$customer->last_name, $customer->first_name] ).' </a>';
                })
            ->addColumn('email',
                function ($customer){
                    return '<a href="mailto:'.$customer->email.'" >'.$customer->email.' </a>';
                })
            ->addColumn('phone',
                function ($customer){
                    return '<a href="tel:'.$customer->phone_no.'" >'.$customer->phone_no.' </a>';
                })
            ->removeColumn('phone_no')
            ->rawColumns(['name', 'email', 'phone', 'action'])
            ->make(true);
    }

}
