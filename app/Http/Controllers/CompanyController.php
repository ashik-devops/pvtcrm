<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer_company;
use Illuminate\Http\Request;

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
    protected function validator(array $data, User $user = null)
    {

        return Validator::make($data, [
            'company-name' => 'required|string',
            'company-email' => 'required|string|email|unique:customer_companies,email',
            'company-phone'=>'required|string|unique:customer_companies,phone_no',
            'company-website'=>'required|url|unique:customer_companies,website',
            'street_address_1'=>'required|string',
            'street_address_2'=>'string|nullable',
            'city'=>'required|string',
            'state'=>'required|string',
            'country'=>'required|string',
            'zip'=>'required|string',
        ]);
    }

    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('customer-company.index-datatable');
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
        return Datatables::of(Customer_company::select('id', 'name', 'email', 'phone_no', 'website'))
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

    public function getCompanyQuickDetails(Customer_company $company){
        return $company->toJson();
    }

    public function viewCompany(Customer_company $company){
       return view('customer-company.view')->with([
          'company'=>$company
       ]);
    }


    public function createCompany( Request $request){
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

        $customer_company->addresses()->save($address);


        echo 'Company is created';

    }


    public function editCompany(Request $request){
        $company = Customer_company::findOrFail($request->id);
        $company_address = $company->addresses;

        return response()->json([
            'company' => $company,
            'company_address' => $company_address,
        ], 201);
    }


    public function updateCompany( Request $request){

        $id =  $request->company['companyId'];
        $customer_company = Customer_company::findOrFail($id);
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
        $customer_company->addresses()->save($address);

        echo 'Company Information  is updated';

    }

    public function deleteCompany(Request $request){
        $id =  $request->id;
        $customer_company = Customer_company::findOrFail($id);
        $customer_company->delete();

        echo 'Company is sent to Trash';

    }
}
