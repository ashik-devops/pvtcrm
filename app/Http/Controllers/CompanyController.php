<?php

namespace App\Http\Controllers;

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
                        '<a href="#edit/'.$company->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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

    public function view(Company $company){
        return $this->view('customer-company.view')->with([
            'company'=>$company,
            'default_customer'=>$company->employees()->where('customers.id', $company->default_customer)->first()
        ]);
    }
}
