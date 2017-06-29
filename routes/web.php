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

Route::get('/users', 'UsersController@index')->name('users-index')->middleware('can:index,App\User');
Route::get('/user/profile/edit/{user}', 'UsersController@edit')->name('profile-edit')->middleware('can:update,user');
Route::patch('/user/profile/update/{user}', 'UsersController@update')->name('profile-update')->middleware('can:update,user');

Route::get('/customers', 'CustomersController@index')->name('customer-index')->middleware('can:index,App\Customer');
Route::get('/ajax/customers/data', 'CustomersController@getCustomersAjax')->name('customers-data')->middleware('can:index,App\Customer');
Route::post('/customer/create', 'CustomersController@createCustomer')->name('create.customer');
Route::get('/customer/get', 'CustomersController@getCustomer')->name('get.customer.data');
Route::post('/customer/update', 'CustomersController@updateCustomer')->name('update.customer.data');
Route::post('/customer/delete', 'CustomersController@deleteCustomer')->name('delete.customer.data');



Route::get('/tasks', 'TasksController@index')->name('task-index');//->middleware('can:index,App\Customer');
Route::get('/get-customer-options', 'CustomersController@getCustomerOptions')->name('get-customer-options');
Route::get('/ajax/tasks/data', 'TasksController@getTasksAjax')->name('task-data');
Route::post('/task/create', 'TasksController@createTask')->name('create.task');
Route::get('/task/edit', 'TasksController@editTask')->name('edit.task.data');
Route::post('/task/update', 'TasksController@updateTask')->name('update.task');
Route::post('/task/delete', 'TasksController@deleteTask')->name('delete.task');


Route::get('/appointments', 'AppointmentsController@index')->name('appointment-index');
Route::get('/ajax/appointment/data', 'AppointmentsController@getAppointmentsAjax')->name('appointment-data');
Route::post('/appointment/create', 'AppointmentsController@createAppointment')->name('create.appointment');
Route::get('/appointment/edit', 'AppointmentsController@editAppointment')->name('edit.appointment');
Route::post('/appointment/update', 'AppointmentsController@updateAppointment')->name('update.appointment');
Route::post('/appointment/delete', 'AppointmentsController@deleteAppointment')->name('delete.appointment');





Route::get('/companies', 'CompanyController@index')->name('company-index')->middleware('can:index,App\Customer');
Route::post('/companies/create', 'CompanyController@createCompany')->name('create.company');//->middleware('can:list,App\Customer');
Route::get('/companies/view/{company}', 'CompanyController@viewCompany')->name('view-company');//->middleware('can:list,App\Customer');
Route::get('/companies/edit/', 'CompanyController@editCompany')->name('edit.modal.data');//->middleware('can:list,App\Customer');
Route::post('/companies/update', 'CompanyController@updateCompany')->name('update.company');//->middleware('can:list,App\Customer');
Route::post('/companies/delete', 'CompanyController@deleteCompany')->name('delete.company');//->middleware('can:list,App\Customer');
Route::get('/ajax/companies/data', 'CompanyController@getCompaniesAjax')->name('company-data');//->middleware('can:list,App\Customer');
Route::get('/ajax/companies/tasks/{company}', 'CompanyController@getCompanyTasksAjax')->name('company-tasks-list');//->middleware('can:list,App\Customer');
Route::get('/ajax/companies/appointments/{company}', 'CompanyController@getCompanyAppointmentsAjax')->name('company-appointments-list');//->middleware('can:list,App\Customer');
Route::get('/ajax/company/data/{company}', 'CompanyController@getCompanyAjax')->name('get-company');
Route::post('/ajax/companies/create', 'CompanyController@create')->name('create-company');//->middleware('can:list,App\Customer');
Route::get('/ajax/companies/list', 'CompanyController@listAll')->name('list-companies');

Route::get('/calendar', 'CalendarController@index')->name('calendar');
Route::get('/ajax/calendar/events', 'CalendarController@getAjaxEvents')->name('ajax-get-events');