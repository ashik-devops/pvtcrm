<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;

use App\Account;
use App\Index_customer;
use App\User;
use App\User_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Yajra\DataTables\DataTables;

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
    protected function validator(array $data, $isUpdate=false)
    {
        $rules=[
            'customer.firstName' => 'required|string|max:32',
            'customer.lastName' => 'required|string|max:32',
            'customer.customerTitle'=>'required|string|max:32',
            'customer.customerPhone'=>'required|string|max:32|unique:customers,phone_no,'.$data['customer']['customerId'],
            'customer.customerEmail' => 'required|string|email|max:255|unique:customers,email,'.$data['customer']['customerId'],
            'customer.customerPriority'=>'required|string|max:32',
            'customer.userId'=>'required|integer|exists:users,id',
            'account.streetAddress_1'=>'required|string',
            'account.streetAddress_2'=>'required|string',
            'account.city'=>'string|nullable',
            'account.state'=>'required|string|max:32',
            'account.country'=>'required|string|max:32',
            'account.zip'=>'required|string|max:26',
        ];

        if($isUpdate) {
            $rules['customer.customerId']='required|integer|exists:customers,id';
        }

        if($data['account']['accountId'] > 0){
            $rules=array_merge($rules, [
                'account.accountId' => 'required|integer|exists:accounts,id',
            ]);

            if($isUpdate){
                $rules['account.addressId'] = 'required|integer|exists:addresses,id';
            }
        }

        else{
            $rules=array_merge($rules, [
                'account.accountNo' => 'required|unique:accounts,account_no,'.$data['account']['accountId'],
            ]);
        }
        return Validator::make($data, $rules);
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

        return DataTables::of(Index_customer::get())
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
            $this->validator(['customer'=>$request->customer, 'account'=>$request->account])->validate();

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

            $account = Account::find($request->account['accountId']);
            if (is_null($account)) {

                $account = new Account();
                $account->account_no = $request->account['accountNo'];
                $account->name = $request->account['accountName'];
                $account->website = $request->account['accountWebsite'];
                $account->phone_no = $request->account['accountPhone'];
                $account->email = $request->account['accountEmail'];

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
        $this->validator(['customer'=>$request->customer, 'account'=>$request->account], true)->validate();

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
            'customers' =>Customer::with(['account'])->get()->map(
                function($customer){
                $name=implode(', ', [$customer->last_name, $customer->first_name]);
                if(!is_null($customer->account)){
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

    public function     getCustomerTasksAjax(Customer $customer){
        return DataTables::of(DB::table('tasks_index')->where('customer_id', $customer->id))
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
        return DataTables::of(DB::table('appointments_index')->where('customer_id', $customer->id))
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
