<?php

namespace App\Http\Controllers;

use App\Address;
use App\Account;
use App\Customer;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;
use Yajra\DataTables\DataTables;

class AccountsController extends Controller
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

    public function validator(Array $data, $isUpdate=false){
        $rules=[
            'accountNo'=>'string|required|max:16',
            'accountName'=>'string',
            'accountWebsite'=>'url',
            'accountPhone'=>'string',
            'accountEmail'=>'email',
            'streetAddress_1'=>'string|required',
            'streetAddress_2'=>'string',
            'city'=>'string|required',
            'state'=>'string|required',
            'country'=>'string|required',
            'zip'=>'string|required',
        ];

        if($isUpdate){
            $rules['accountId']='integer|required|exists:accounts,id';
            $rules['addressId']='integer|required|exists:addresses,id';
        }

        return Validator::make($data, $rules);
    }
    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $this->authorize('index', Account::class);
        return view('account.index-datatable');
    }

    public function listAll(Request $request){
        $this->authorize('index', Account::class);
        $accounts = new Account();
        if(!empty($request->q)){

            $accounts = $accounts->where('name', 'like', "%$request->q%")->orWhere('account_no', 'like', "%$request->q%");

        }

        return response()->json([
            'items' => $accounts->select(['id', DB::raw('CONCAT(name, " #", account_no) as name')])->get(),
            'total_count'=>$accounts->count()
        ],200);
    }

    public function create(Request $request){
        $this->authorize('create', $request);
        $this->validator($request->all())->validate();
    }

    /**
     * Sends json data to datatable of all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAccountsAjax(){
        $this->authorize('index', Account::class);
        return DataTables::of(Account::select('id', 'account_no','name', 'email', 'phone_no', 'website'))
            ->addColumn('action',
                function ($account){
                    return
                        '
                        <a href="'.route('view-account', [$account->id]).'" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>
                        <a  class="btn btn-xs btn-primary btn-warning"  onClick="editAccount('.$account->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                         ';
                })
            ->addColumn('name', function($account){
                return "<a href='".route('view-account', [$account->id])."'>{$account->name}</a>";

            })

            ->addColumn('email', function($account){
                return "<a href='mailto:{$account->email}'>{$account->email}</a>";
            })

            ->addColumn('phone_no', function($account){
                return "<a href='tel:{$account->phone_no}'>{$account->phone_no}</a>";
            })
            ->addColumn('website', function($account){
                return "<a href='{$account->website}'>{$account->website}</a>";
            })
            ->rawColumns(['name','email', 'action', 'phone_no', 'website'])
            ->make(true);
    }

    /**
     * Sends json data to datatable of all tasks of account falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAccountTasksAjax(Account $account){
        $this->authorize('create', $account);
        return DataTables::of(DB::table('tasks_index')->where('account_id', $account->id))
            ->addColumn('customer_name', function ($task){
                    return '<a href="'.route('view-customer',[$task->customer_id]).'">'.$task->customer_last_name.', '. $task->customer_first_name.'</a>';
            })
            ->addColumn('action',
                function ($task){
                    if ($task->status == 'Due'){
                        return

                            '<a  class="btn btn-xs btn-primary "   onClick="viewTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>
                        <a  class="btn btn-xs btn-primary btn-warning"  onClick="editTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                    }
                    else {
                        return '<a  class="btn btn-xs btn-primary"   onClick="viewTask('.$task->id.')" ><i class="glyphicon glyphicon-edit"></i> View</a>';
                    }
                })
            ->rawColumns(['customer_name', 'action'])
            ->make(true);
    }
    /**
     * Sends json data to datatable of all tasks of account falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAccountAppointmentsAjax(Account $account){
        $this->authorize('index', $account);
        return DataTables::of(DB::table('appointments_index')->where('account_id', $account->id))
            ->addColumn('action',
                function ($appointment){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteAppointment('.$appointment->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                         <a href="#" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> View</a>';
                })
            ->addColumn('customer_name', function ($appointment){
                return '<a href="'.route('view-customer',[$appointment->customer_id]).'">'.$appointment->customer_last_name.', '. $appointment->customer_first_name.'</a>';
            })
            ->rawColumns(['customer_name', 'action'])
            ->make(true);
    }



    public function getAccountQuickDetails(Account $account){
        $this->authorize('view', $account);
        return $account->toJson();
    }

    public function viewAccount(Account $account){
        $this->authorize('view', $account);
       return view('account.view')->with([
          'account'=>$account
       ]);
    }


    public function createAccount( Request $request){
        $this->authorize('create', $request);
        $this->validator($request->account, false)->validate();

        $customer_account = new Account();
        $customer_account->account_no=$request->account['accountNo'];
        $customer_account->name = $request->account['accountName'];
        $customer_account->website = $request->account['accountWebsite'];
        $customer_account->phone_no = $request->account['accountPhone'];
        $customer_account->email = $request->account['accountEmail'];


        $address = new Address();
        $address->street_address_1 = $request->account['streetAddress_1'];
        $address->street_address_2 = $request->account['streetAddress_2'];
        $address->city = $request->account['city'];
        $address->state = $request->account['state'];
        $address->country = $request->account['country'];
        $address->zip = $request->account['zip'];
        $address->phone_no = $request->account['accountPhone'];
        $address->email = $request->account['accountEmail'];

        DB::beginTransaction();
        $customer_account->save();
        $address->save();
        $customer_account->addresses()->save($address);
        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Account has been created successfully.'
        ]);

    }


    public function editAccount(Request $request){
        $account = Account::findOrFail($request->id);
        $account_address = $account->addresses;

        return response()->json([
            'account' => $account,
            'account_address' => $account_address,
        ], 201);
    }


    public function updateAccount( Request $request){
        $this->authorize('update', $request);
        $this->validator($request->account, true)->validate();
        $customer_account = Account::findOrFail($request->account['accountId']);
        $address = Address::findOrFail($request->account['addressId']);

        if(!is_null($customer_account) && !is_null($address)){

            $customer_account->account_no=$request->account['accountNo'];
            $customer_account->name = $request->account['accountName'];
            $customer_account->website = $request->account['accountWebsite'];
            $customer_account->phone_no = $request->account['accountPhone'];
            $customer_account->email = $request->account['accountEmail'];
            $address->street_address_1 = $request->account['streetAddress_1'];
            $address->street_address_2 = $request->account['streetAddress_2'];
            $address->city = $request->account['city'];
            $address->state = $request->account['state'];
            $address->country = $request->account['country'];
            $address->zip = $request->account['zip'];
            $address->phone_no = $request->account['accountPhone'];
            $address->email = $request->account['accountEmail'];


            DB::beginTransaction();
            $customer_account->save();
            $address->save();
            DB::commit();

            return response()->json([
                'result'=>'Saved',
                'message'=>'Account has been updated successfully.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Failed to update account information.'
        ]);

    }



    public function deleteAccount(Request $request){
        $customer_account = Account::findOrFail($request->id);
        $this->authorize('delete', $request);
        if(!is_null($customer_account)){

            $customer_account->delete();

            return response()->json([
                'result'=>'Success',
                'message'=>'Account has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Account not found.'
        ]);


    }

    public function bulkDeleteAccount(Request $request){

        if(Account::whereIn('id', explode(',', $request->ids))->delete()){
            return response()->json([
                'result'=>'Success',
                'message'=>'Account has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Invalid Request.'
        ]);

    }

    public function getCustomerAccountWise(Request $request){
        $this->authorize('view', Account::find($request->accountId));
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




}
