<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;

use App\Account;
use App\User;
use App\User_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Yajra\Datatables\Datatables;
use Validator;

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

    public function viewCustomer(Customer $customer){
        return view('customer.view')->with([
            'customer'=>$customer
        ]);
    }

    public function getCustomersAjax(){

        return Datatables::of(Customer::with('user'))
            ->addColumn('action',
                function ($customer){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editCustomer('.$customer->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteCustomer('.$customer->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="'.route('view-customer',[$customer->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('name',
                function ($customer){
                    return '<a href="'.route('view-customer',[$customer->id]).'" >'.implode(', ', [$customer->last_name, $customer->first_name] ).' </a>';
                })
            ->addColumn('company',
                function ($customer){
                    return '<a href="'.route('view-company', $customer->company->id).'" >'.implode(', ', [$customer->company->name] ).' </a>';
                })
            ->addColumn('user',
                function ($customer){
                    $user_profile = User_profile::findOrFail($customer->user->id);
                    return '<a href="#view/'.$customer->user->id.'" >'.$user_profile->initial .' </a>';
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
            ->rawColumns(['name','user','email', 'phone', 'company', 'action'])
            ->make(true);
    }


    public function createCustomer( Request $request){

            $customer = new Customer();
            $customer->first_name = $request->customer['firstName'];
            $customer->last_name = $request->customer['lastName'];
            $customer->title = $request->customer['customerTitle'];
            $customer->email = $request->customer['customerEmail'];
            $customer->phone_no = $request->customer['customerPhone'];
            $customer->priority = $request->customer['customerPriority'];
            $customer->user_id = $request->customer['userId'];


            $address = new Address();
            $address->street_address_1 = $request->company['streetAddress_1'];
            $address->street_address_2 = $request->company['streetAddress_2'];
            $address->city = $request->company['city'];
            $address->state = $request->company['state'];
            $address->country = $request->company['country'];
            $address->zip = $request->company['zip'];
            $address->phone_no = $request->company['companyPhone'];
            $address->email = $request->company['companyEmail'];

            $customer->addresses()->attach($address);
            $customer_company = Account::findOrFail($request->company['companyId']);
            if (is_null($customer_company)) {

                $customer_company = new Account();
                $customer_company->name = $request->company['companyName'];
                $customer_company->website = $request->company['companyWebsite'];
                $customer_company->phone_no = $request->company['companyPhone'];
                $customer_company->email = $request->company['companyEmail'];

            } else {
                $customer_company = $customer_company->first();
            }
            DB::beginTransaction();
            $customer->save();
            $address->save();
            $customer_company->save();
            $customer_company->addresses()->save($address, ['type' => 'BILLING']);
            $customer->addresses()->save($address, ['type' => 'CONTACT']);
            $customer_company->employees()->save($customer);
            DB::commit();
            return response()->json(['result' => "Saved", 'message' => 'Customer is Saved.'], 200);




    }

    public function getCustomer(Request $request){

        $customer = Customer::findOrFail($request->id);
        $this->authorize('view',$customer);
        $user = User::findOrFail($customer->user_id);


        if($customer->customer_company_id){
            $company = Account::findOrFail($customer->customer_company_id);
            $address = $customer->addresses;

            return response()->json([
                'customer' => $customer,
                'user' => $user,
                'company' => $company,
                'address' => $address,
            ], 201);
        }


        return response()->json([
            'customer' => $customer
        ], 201);


    }

    public function updateCustomer(Request $request){
        $customer = Customer::findOrFail($request->customer['customerId']);
        $this->authorize('update',$customer);
        $address = Address::findOrFail($request->company['addressId']);
        $customer_company = Account::findOrFail($request->company['companyId']);
        if(is_null($customer_company)){
            $customer_company = new Account();

            $customer_company->name = $request->company['companyName'];
            $customer_company->website = $request->company['companyWebsite'];
            $customer_company->phone_no = $request->company['companyPhone'];
            $customer_company->email = $request->company['companyEmail'];

        }

        if(!is_null($customer) && !is_null($address)) {
            $customer->first_name = $request->customer['firstName'];
            $customer->last_name = $request->customer['lastName'];
            $customer->title = $request->customer['customerTitle'];
            $customer->email = $request->customer['customerEmail'];
            $customer->phone_no = $request->customer['customerPhone'];
            $customer->priority = $request->customer['customerPriority'];
            $customer->user_id = $request->customer['userId'];;

            $address->street_address_1 = $request->company['streetAddress_1'];
            $address->street_address_2 = $request->company['streetAddress_2'];
            $address->city = $request->company['city'];
            $address->state = $request->company['state'];
            $address->country = $request->company['country'];
            $address->zip = $request->company['zip'];
            $address->phone_no = $request->company['companyPhone'];
            $address->email = $request->company['companyEmail'];

        }
        else{
            return response()->json(['result'=>'Error'], 403);
        }


        DB::beginTransaction();
        $customer->save();
        $address->save();
        $customer_company->save();
        $customer_company->employees()->save($customer);
        DB::commit();

        return response()->json(['result'=>"Saved", 'message'=>'Customer is Updated.'], 200);
    }

    public function deleteCustomer(Request $request){
        $customer= Customer::findOrFail($request->id);
        $this->authorize('delete',$customer);
        if(!is_null($customer)){
            $customer->delete();
            return response()->json([
                'result'=>'Success',
                'message'=>'Customer has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Customer not found.'
        ]);

    }

    public function bulkDeleteCustomer(Request $request){

        if(Customer::whereIn('id',explode(',', $request->ids))->delete()){
            return response()->json([
                'result'=>'Success',
                'message'=>'Customer has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Invalid Request.'
        ]);

    }

    public function getCustomerOptions(){

        return response()->json([
            'customers' =>Customer::all()->map(
                function($customer){
                $name=implode(', ', [$customer->last_name, $customer->first_name]);
                if($customer->has('company')){
                    $name.='@'.$customer->company->name;
                }

                return ['id'=>$customer->id,'text'=>$name];
            })
        ]);
    }

    public function getCustomerCompanyWise(Request $request){
         if($request->companyId){
             return response()->json([
                 'customers' =>Customer::where('customer_company_id',$request->companyId)->get()->map(
                     function($customer){
                         $name=implode(', ', [$customer->last_name, $customer->first_name]);


                         return ['id'=>$customer->id,'text'=>$name];
                     })
             ]);
         }


    }

    /**
     * Sends json data to datatable of all tasks of company falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCustomerTasksAjax(Customer $customer){
        return Datatables::of(DB::table('tasks_index')->where('customer_id', $customer->id))
            ->addColumn('customer_name', function ($task){
                return '<a href="#">'.$task->customer_last_name.', '. $task->customer_first_name.'</a>';
            })
            ->addColumn('action',
                function ($task){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteTask('.$task->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="#" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->rawColumns(['customer_name', 'action'])
            ->make(true);
    }
    /**
     * Sends json data to datatable of all tasks of company falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCustomerAppointmentsAjax(Customer $customer){
        return Datatables::of(DB::table('appointments_index')->where('customer_id', $customer->id))
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                         <a href="#" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> View</a>';
                })
            ->addColumn('customer_name', function ($appointment){
                return '<a href="#">'.$appointment->customer_last_name.', '. $appointment->customer_first_name.'</a>';
            })
            ->rawColumns(['customer_name', 'action'])
            ->make(true);
    }





}
