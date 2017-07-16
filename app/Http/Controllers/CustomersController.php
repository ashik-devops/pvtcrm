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

        return Datatables::of(DB::table('customers_index'))
            ->addColumn('action',
                function ($customer){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editCustomer('.$customer->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteCustomer('.$customer->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a href="'.route('view-customer',[$customer->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('name',
                function ($customer){
                    return '<a href="'.route('view-customer',[$customer->id]).'" >'.$customer->name.' </a>';
                })
            ->addColumn('account_no',
                function ($customer){
                    return '<a href="'.route('view-account', $customer->account_id).'" >'.implode(', ', [$customer->account_no] ).' </a>';
                })
            ->addColumn('account_name',
                function ($customer){
                    return '<a href="'.route('view-account', $customer->account_id).'" >'.implode(', ', [$customer->account_name] ).' </a>';
                })
            ->addColumn('user_name',
                function ($customer){
                    return '<a href="#view/'.$customer->user_id.'" >'.$customer->user_name .' </a>';
                })
            ->addColumn('email',
                function ($customer){
                    return '<a href="mailto:'.$customer->email.'" >'.$customer->email.' </a>';
                })
            ->addColumn('phone_no',
                function ($customer){
                    return '<a href="tel:'.$customer->phone_no.'" >'.$customer->phone_no.' </a>';
                })
            ->rawColumns(['name','account_no', 'user_name', 'email', 'phone_no', 'account_name', 'action'])
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
            $address->street_address_1 = $request->account['streetAddress_1'];
            $address->street_address_2 = $request->account['streetAddress_2'];
            $address->city = $request->account['city'];
            $address->state = $request->account['state'];
            $address->country = $request->account['country'];
            $address->zip = $request->account['zip'];
            $address->phone_no = $request->account['accountPhone'];
            $address->email = $request->account['accountEmail'];

            $customer->addresses()->attach($address);
            $account = Account::findOrFail($request->account['accountId']);
            if (is_null($account)) {

                $account = new Account();
                $account->name = $request->account['accountName'];
                $account->website = $request->account['accountWebsite'];
                $account->phone_no = $request->account['accountPhone'];
                $account->email = $request->account['accountEmail'];

            } else {
                $account = $account->first();
            }
            DB::beginTransaction();
            $customer->save();
            $address->save();
            $account->save();
            $account->addresses()->save($address, ['type' => 'BILLING']);
            $customer->addresses()->save($address, ['type' => 'CONTACT']);
            $account->employees()->save($customer);
            DB::commit();
            return response()->json(['result' => "Saved", 'message' => 'Customer is Saved.'], 200);




    }

    public function getCustomer(Request $request){

        $customer = Customer::findOrFail($request->id);
        $this->authorize('view',$customer);
        $user = User::findOrFail($customer->user_id);


        if($customer->account_id){
            $account = Account::findOrFail($customer->account_id);
            $address = $customer->addresses;

            return response()->json([
                'customer' => $customer,
                'user' => $user,
                'account' => $account,
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
        $address = Address::findOrFail($request->account['addressId']);
        $account = Account::findOrFail($request->account['accountId']);
        if(is_null($account)){
            $account = new Account();

            $account->name = $request->account['accountName'];
            $account->website = $request->account['accountWebsite'];
            $account->phone_no = $request->account['accountPhone'];
            $account->email = $request->account['accountEmail'];

        }

        if(!is_null($customer) && !is_null($address)) {
            $customer->first_name = $request->customer['firstName'];
            $customer->last_name = $request->customer['lastName'];
            $customer->title = $request->customer['customerTitle'];
            $customer->email = $request->customer['customerEmail'];
            $customer->phone_no = $request->customer['customerPhone'];
            $customer->priority = $request->customer['customerPriority'];
            $customer->user_id = $request->customer['userId'];;

            $address->street_address_1 = $request->account['streetAddress_1'];
            $address->street_address_2 = $request->account['streetAddress_2'];
            $address->city = $request->account['city'];
            $address->state = $request->account['state'];
            $address->country = $request->account['country'];
            $address->zip = $request->account['zip'];
            $address->phone_no = $request->account['accountPhone'];
            $address->email = $request->account['accountEmail'];

        }
        else{
            return response()->json(['result'=>'Error'], 403);
        }


        DB::beginTransaction();
        $customer->save();
        $address->save();
        $account->save();
        $account->employees()->save($customer);
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
                if($customer->has('account')){
                    $name.='@'.$customer->account->name;
                }

                return ['id'=>$customer->id,'text'=>$name];
            })
        ]);
    }

    public function getCustomerAccountWise(Request $request){
         if($request->accountId){
             return response()->json([
                 'customers' =>Customer::where('account_id',$request->accountId)->get()->map(
                     function($customer){
                         $name=implode(', ', [$customer->last_name, $customer->first_name]);


                         return ['id'=>$customer->id,'text'=>$name];
                     })
             ]);
         }


    }

    /**
     * Sends json data to datatable of all tasks of account falls under current user scope.
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
     * Sends json data to datatable of all tasks of account falls under current user scope.
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
