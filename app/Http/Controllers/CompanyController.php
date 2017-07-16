<?php

namespace App\Http\Controllers;

use App\Address;
use App\Account;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class CompanyController extends Controller
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


    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('customer-company.index-datatable');
    }

    public function listAll(Request $request){
        $companies = new Account();
        if(!empty($request->q)){

            $companies = $companies->where('name', 'like', "%$request->q%");

        }

        return response()->json([
            'items' => $companies->select(['id', 'name'])->get(),
            'total_count'=>$companies->count()
        ],200);
    }

    public function create(Request $request){
        $this->validator($request->all())->validate();
    }

    /**
     * Sends json data to datatable of all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCompaniesAjax(){
        return Datatables::of(Account::select('id', 'name', 'email', 'phone_no', 'website'))
            ->addColumn('action',
                function ($company){
                    return
                        '<a  class="btn btn-xs btn-primary"  onClick="editCompany('.$company->id.')" ><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a  class="btn btn-xs btn-danger"  onClick="deleteCompany('.$company->id.')" ><i class="glyphicon glyphicon-remove"></i> Delete</a>
                         <a href="'.route('view-company', [$company->id]).'" target="_blank" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
                })
            ->addColumn('email', function($company){
                return "<a href='mailto:{$company->email}'>{$company->email}</a>";
            })

            ->addColumn('phone_no', function($company){
                return "<a href='tel:{$company->phone_no}'>{$company->phone_no}</a>";
            })
            ->addColumn('website', function($company){
                return "<a href='{$company->website}'>{$company->website}</a>";
            })
            ->rawColumns(['email', 'action', 'phone_no', 'website'])
            ->make(true);
    }

    /**
     * Sends json data to datatable of all tasks of company falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCompanyTasksAjax(Account $company){
        return Datatables::of(DB::table('tasks_index')->where('company_id', $company->id))
            ->addColumn('customer_name', function ($task){
                return '<a href="'.route('view-customer',[$task->customer_id]).'">'.$task->customer_last_name.', '. $task->customer_first_name.'</a>';
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

    public function getCompanyAppointmentsAjax(Account $company){
        return Datatables::of(DB::table('appointments_index')->where('company_id', $company->id))
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



    public function getCompanyQuickDetails(Account $company){
        return $company->toJson();
    }

    public function viewCompany(Account $company){
       return view('customer-company.view')->with([
          'company'=>$company
       ]);
    }


    public function createCompany( Request $request){



        $customer_company = new Account();
        $customer_company->name = $request->company['companyName'];
        $customer_company->website = $request->company['companyWebsite'];
        $customer_company->phone_no = $request->company['companyPhone'];
        $customer_company->email = $request->company['companyEmail'];


        $address = new Address();
        $address->street_address_1 = $request->company['streetAddress_1'];
        $address->street_address_2 = $request->company['streetAddress_2'];
        $address->city = $request->company['city'];
        $address->state = $request->company['state'];
        $address->country = $request->company['country'];
        $address->zip = $request->company['zip'];
        $address->phone_no = $request->company['companyPhone'];
        $address->email = $request->company['companyEmail'];

        DB::beginTransaction();
        $customer_company->save();
        $address->save();
        $customer_company->addresses()->save($address);
        DB::commit();

        return response()->json([
            'result'=>'Saved',
            'message'=>'Company has been created successfully.'
        ]);

    }


    public function editCompany(Request $request){
        $company = Account::findOrFail($request->id);
        $company_address = $company->addresses;

        return response()->json([
            'company' => $company,
            'company_address' => $company_address,
        ], 201);
    }


    public function updateCompany( Request $request){


        $customer_company = Account::findOrFail($request->company['companyId']);
        $address = Address::findOrFail($request->company['addressId']);

        if(!is_null($customer_company) && !is_null($address)){

            $customer_company->name = $request->company['companyName'];
            $customer_company->website = $request->company['companyWebsite'];
            $customer_company->phone_no = $request->company['companyPhone'];
            $customer_company->email = $request->company['companyEmail'];
            $address->street_address_1 = $request->company['streetAddress_1'];
            $address->street_address_2 = $request->company['streetAddress_2'];
            $address->city = $request->company['city'];
            $address->state = $request->company['state'];
            $address->country = $request->company['country'];
            $address->zip = $request->company['zip'];
            $address->phone_no = $request->company['companyPhone'];
            $address->email = $request->company['companyEmail'];


            DB::beginTransaction();
            $customer_company->save();
            $address->save();
            DB::commit();

            return response()->json([
                'result'=>'Saved',
                'message'=>'Company has been updated successfully.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Failed to update company information.'
        ]);

    }



    public function deleteCompany(Request $request){
        $customer_company = Account::findOrFail($request->id);

        if(!is_null($customer_company)){

            $customer_company->delete();

            return response()->json([
                'result'=>'Success',
                'message'=>'Company has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Company not found.'
        ]);


    }

    public function bulkDeleteCompany(Request $request){
        if(Account::whereIn('id', explode(',', $request->ids))->delete()){
            return response()->json([
                'result'=>'Success',
                'message'=>'Company has been successfully deleted.'
            ]);
        }

        return response()->json([
            'result'=>'Error',
            'message'=>'Invalid Request.'
        ]);

    }
}
