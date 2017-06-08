<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;

use App\Customer_company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return view('customer.index-datatable');
    }

    public function getCustomersAjax(){
        return Datatables::of(Customer::select('id', 'first_name', 'last_name' ,'email', 'phone_no'))
            ->addColumn('action',
                function ($customer){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editCustomer('.$customer->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteCustomer('.$customer->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="#view/'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>
                        <a href="#quick-view/" data-id="'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Quick View</a>'
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


    public function createCustomer( Request $request){
        $customer = new Customer();
        $customer->first_name = $request->customer['firstName'];
        $customer->last_name = $request->customer['lastName'];
        $customer->title = $request->customer['customerTitle'];
        $customer->email = $request->customer['customerEmail'];
        $customer->phone_no = $request->customer['customerPhone'];
        $customer->user_id = Auth::user()->id;
        $customer->customer_company_id = null;

        $customer->save();

        if($request->company['companyName'] && $request->company['companyEmail']){

            $customer_company = new Customer_company();
            $customer_company->name = $request->company['companyName'];
            $customer_company->website = $request->company['companyWebsite'];
            $customer_company->phone_no = $request->company['companyPhone'];
            $customer_company->email = $request->company['companyEmail'];
            $customer_company->save();

            $address = new Address();
            $address->street_address_1 = $request->company['streetAddress_1'];
            $address->street_address_2 = $request->company['streetAddress_2'];
            $address->city = $request->company['city'];
            $address->state = $request->company['state'];
            $address->country = $request->company['country'];
            $address->zip = $request->company['zip'];
            $address->phone_no = $request->company['companyPhone'];
            $address->email = $request->company['companyEmail'];

            $customer->addresses()->save($address);




            echo "Customer is saved with company";
        }else{


            echo "Customer is saved";
        }



    }

    public function editCustomer(Request $request){

        $customer = Customer::findOrFail($request->id);

        if($customer->customer_company_id){
            $company = Customer_company::findOrFail($customer->customer_company_id);
            $address = $customer->addresses;
            return response()->json([
                'customer' => $customer,
                'company' => $company,
                'address' => $address,
            ], 201);
        }


        return response()->json([
            'customer' => $customer
        ], 201);


    }

    public function updateCustomer(Request $request){

        $customer_id =  $request->customer['customerId'];
        if($customer_id){
            if($request->company['companyName'] && $request->company['companyEmail']){
                $customer = Customer::findOrFail($customer_id);
                $customer->first_name = $request->customer['firstName'];
                $customer->last_name = $request->customer['lastName'];
                $customer->title = $request->customer['customerTitle'];
                $customer->email = $request->customer['customerEmail'];
                $customer->phone_no = $request->customer['customerPhone'];
                $customer->user_id = Auth::user()->id;
                $customer->customer_company_id = $request->company['companyId'];

                $customer->save();

                $customer_company = Customer_company::findOrFail($request->company['companyId']);
                $customer_company->name = $request->company['companyName'];
                $customer_company->website = $request->company['companyWebsite'];
                $customer_company->phone_no = $request->company['companyPhone'];
                $customer_company->email = $request->company['companyEmail'];
                $customer_company->save();

                if($request->company['addressId']){
                    $address = Address::findOrFail($request->company['addressId']);
                    $address->street_address_1 = $request->company['streetAddress_1'];
                    $address->street_address_2 = $request->company['streetAddress_2'];
                    $address->city = $request->company['city'];
                    $address->state = $request->company['state'];
                    $address->country = $request->company['country'];
                    $address->zip = $request->company['zip'];
                    $address->phone_no = $request->company['companyPhone'];
                    $address->email = $request->company['companyEmail'];
                    $address->save();


                }

                echo "Customer is saved with Company information";

            }else{
                $customer = Customer::findOrFail($customer_id);
                $customer->first_name = $request->customer['firstName'];
                $customer->last_name = $request->customer['lastName'];
                $customer->title = $request->customer['customerTitle'];
                $customer->email = $request->customer['customerEmail'];
                $customer->phone_no = $request->customer['customerPhone'];
                $customer->user_id = Auth::user()->id;
                $customer->customer_company_id = null;

                $customer->save();
                echo "Customer is saved";
            }
        }

    }

    public function deleteCustomer(Request $request){
        $customer_id =  $request->id;
        $customer= Customer::findOrFail($customer_id);
        $customer->delete();
        echo 'Customer is sent to Trash';

    }



}
