<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|`
*/

//Route::group(['middleware'=>'web'])
Route::get('/', 'HomeController@dashboard')->name('dashboard');
Auth::routes();
Route::get('/users', 'UsersController@index')->middleware('can:list,App\User');
Route::get('/user/profile/edit/{user}', 'UsersController@edit')->name('profile-edit')->middleware('can:update,user');
Route::patch('/user/profile/update/{user}', 'UsersController@update')->name('profile-update')->middleware('can:update,user');
Route::get('/customers', 'CustomersController@index')->name('customer-index')->middleware('can:list,App\Customer');
Route::get('/ajax/customers/data', 'CustomersController@getCustomersAjax')->name('customers-data')->middleware('can:list,App\Customer');
Route::get('/companies', 'CompanyController@index')->name('company-index');//->middleware('can:list,App\Customer');
Route::post('/companies/create', 'CompanyController@createCompany')->name('create.company');//->middleware('can:list,App\Customer');
Route::get('/companies/edit/', 'CompanyController@editCompany')->name('edit.modal.data');//->middleware('can:list,App\Customer');
Route::post('/companies/update', 'CompanyController@updateCompany')->name('update.company');//->middleware('can:list,App\Customer');
Route::post('/companies/delete', 'CompanyController@deleteCompany')->name('delete.company');//->middleware('can:list,App\Customer');
Route::get('/ajax/companies/data', 'CompanyController@getCompaniesAjax')->name('company-data');//->middleware('can:list,App\Customer');
Route::post('/ajax/companies/create', 'CompanyController@create')->name('create-company');//->middleware('can:list,App\Customer');
Route::get('/company/view/{company}', 'CompanyController@getCompanyQuickDetails')->name('view-company');//->middleware('can:list,App\Customer');
