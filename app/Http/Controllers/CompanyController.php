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

    public function getCompaniesAjax(){
        return Datatables::of(Customer_company::select('id', 'name', 'email', 'phone_no', 'website'))
            ->addColumn('action',
                function ($customer){
                    return
                        '<a href="#edit/'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#view/'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a><a href="#quick-view/" data-id="'.$customer->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Quick View</a>'
                        ;
                })
            ->make(true);
    }
}
