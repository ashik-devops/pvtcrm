<?php

namespace App\Http\Controllers;

use App\Customer_company;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the all customers falls under current user scope.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('customer-company.index-datatable');
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

    }
}
