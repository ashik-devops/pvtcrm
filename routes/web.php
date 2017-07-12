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
Route::post('/user/create', 'UsersController@createUser')->name('create-user')->middleware('can:create,App\User');
Route::get('/user/profile/edit/{user}', 'UsersController@edit')->name('profile-edit')->middleware('can:update,App\User');
Route::patch('/user/profile/update/{user}', 'UsersController@update')->name('profile-update')->middleware('can:update,App\User');
Route::get('/ajax/users/list', 'UsersController@listAll')->name('list-users')->middleware('can:index,App\User');;

Route::get('/customers', 'CustomersController@index')->name('customer-index')->middleware('can:index,App\Customer');
Route::get('/ajax/customers/data', 'CustomersController@getCustomersAjax')->name('customers-data')->middleware('can:index,App\Customer');
Route::post('/customer/create', 'CustomersController@createCustomer')->name('create.customer')->middleware('can:create,App\Customer');
Route::get('/customer/get', 'CustomersController@getCustomer')->name('get.customer.data');
Route::post('/customer/update', 'CustomersController@updateCustomer')->name('update.customer.data');
Route::post('/customer/delete', 'CustomersController@deleteCustomer')->name('delete.customer.data');
Route::post('/customer/bulk/delete', 'CustomersController@bulkDeleteCustomer')->name('bulk.delete.customer.data');
Route::get('/get-customer-options', 'CustomersController@getCustomerOptions')->name('get-customer-options')->middleware('can:index,App\Customer');



Route::get('/tasks', 'TasksController@index')->name('task-index');//->middleware('can:index,App\Task');
Route::get('/ajax/tasks/data', 'TasksController@getTasksAjax')->name('task-data');//->middleware('can:index,App\Task');

Route::get('/ajax/tasks/data-due', 'TasksController@getTasksAjaxDue')->name('task-data-with-due');//->middleware('can:index,App\Task');

Route::post('/task/create', 'TasksController@createTask')->name('create.task');//->middleware('can:create,App\Task');
Route::get('/task/edit', 'TasksController@editTask')->name('edit.task.data');
Route::post('/task/update', 'TasksController@updateTask')->name('update.task');
Route::post('/task/cancel', 'TasksController@cancelTask')->name('cancel.task');
Route::post('/task/delete', 'TasksController@deleteTask')->name('delete.task');


Route::get('/appointments', 'AppointmentsController@index')->name('appointment-index');//->middleware('can:index,App\Appointment');
Route::get('/ajax/appointment/data', 'AppointmentsController@getAppointmentsAjax')->name('appointment-data');//->middleware('can:index,App\Appointment');

Route::get('/ajax/appointment/data-current-date', 'AppointmentsController@getAppointmentsAjaxPending')->name('appointment-data-current-date');//->middleware('can:index,App\Appointment');

Route::post('/appointment/create', 'AppointmentsController@createAppointment')->name('create.appointment');//->middleware('can:create,App\Appointment');
Route::get('/appointment/edit', 'AppointmentsController@editAppointment')->name('edit.appointment');
Route::post('/appointment/update', 'AppointmentsController@updateAppointment')->name('update.appointment');
Route::post('/appointment/delete', 'AppointmentsController@deleteAppointment')->name('delete.appointment');

Route::get('/sales-teams', 'SalesteamController@index')->name('sales-team-index');
Route::get('/sales-teams-options', 'UsersController@listAll')->name('get-sales-team-options');
Route::post('/sales-team/create', 'SalesteamController@createSalesTeam')->name('create.sales.team');
Route::get('/sales-team/edit', 'SalesteamController@editSalesTeam')->name('edit.sales.team.data');
Route::post('/sales-team/update', 'SalesteamController@updateSalesTeam')->name('update.sales.team.data');
Route::post('/sales-team/delete', 'SalesteamController@deleteSalesTeam')->name('delete.sales.team');
Route::get('/ajax/sales-team/data', 'SalesteamController@getSalesTeamAjax')->name('sales-team-data');

Route::get('/tag-names', 'TagsController@index')->name('tag-index');
Route::post('/tag/create', 'TagsController@createTag')->name('create.tag');
Route::get('/tag/edit', 'TagsController@editTag')->name('edit.tag');
Route::post('/tag/update', 'TagsController@updateTag')->name('update.tag');
Route::post('/tag/delete', 'TagsController@deleteTag')->name('delete.tag');
Route::get('/ajax/tag/data', 'TagsController@getTagsAjax')->name('tag-data');




Route::get('/companies', 'CompanyController@index')->name('company-index');//->middleware('can:index,App\Customer');

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
Route::post('/companies/bulk/delete', 'CompanyController@bulkDeleteCompany')->name('bulk.delete.company.data');


Route::get('/calendar', 'CalendarController@index')->name('calendar');
Route::get('/ajax/calendar/events', 'CalendarController@getAjaxEvents')->name('ajax-get-events');