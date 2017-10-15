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
Route::get('/user/delete/{user}', 'UsersController@delete')->name('user-delete')->middleware('can:delete,App\User');
Route::get('/user/profile/edit/{user}', 'UsersController@edit')->name('profile-edit');//->middleware('can:update,App\User');
Route::get('/user/profile/{user}', 'UsersController@view')->name('profile-view');//->middleware('can:update,App\User');

Route::patch('/user/profile/update/{user}', 'UsersController@update')->name('profile-update');//->middleware('can:update,App\User');
Route::get('/ajax/users/list', 'UsersController@listAll')->name('list-users')->middleware('can:index,App\User');
Route::get('user/roles', 'RolesController@index')->name('role-index')->middleware(['auth', 'can:index,App\Role']);
Route::post('user/roles/create', 'RolesController@create')->name('create-role')->middleware(['auth', 'can:create,App\Role']);
Route::get('user/roles/edit/{role}', 'RolesController@edit')->name('edit-role')->middleware(['auth', 'can:update,App\Role']);
Route::post('user/roles/edit/{role}', 'RolesController@update')->name('update-role')->middleware(['auth', 'can:update,App\Role']);
Route::get('user/roles/create', 'RolesController@createForm')->name('create-role-form')->middleware(['auth', 'can:create,App\Role']);
Route::get('ajax/user/roles/', 'RolesController@getRolesAjax')->name('roles-list-data')->middleware(['auth', 'can:index,App\Role']);
Route::delete('ajax/user/roles/delete/', 'RolesController@delete')->name('delete-role')->middleware(['auth', 'can:delete,App\Role']);
Route::get('/user/groups', 'UserGroupController@index')->name('user-group-index');
Route::get('/user/groups/view/{group}', 'UserGroupController@view')->name('view-user-group');
Route::get('/ajax/user/groups', 'UserGroupController@getUserGroupsAjax')->name('user-group-index.data');
Route::post('ajax/user/group/create', 'UserGroupController@create')->name('user-group-create');
Route::post('ajax/user/group/update', 'UserGroupController@update')->name('user-group-update');
Route::post('ajax/user/group/edit', 'UserGroupController@edit')->name('user-group-edit');
Route::get('ajax/user/group/delete', 'UserGroupController@delete')->name('user-group-delete');
Route::get('ajax/user/group/', 'UserGroupController@getGroup')->name('single-user-group.data');

Route::get('/customers', 'CustomersController@index')->name('customer-index')->middleware('can:index,App\Customer');
Route::get('/ajax/customers/data', 'CustomersController@getCustomersAjax')->name('customers-data')->middleware('can:index,App\Customer');
Route::post('/ajax/customer/create', 'CustomersController@createCustomer')->name('create.customer')->middleware('can:create,App\Customer');
Route::get('/ajax//customer/get', 'CustomersController@getCustomer')->name('get.customer.data');
Route::post('/ajax/customer/update', 'CustomersController@updateCustomer')->name('update.customer.data');
Route::post('/ajax/customer/delete', 'CustomersController@deleteCustomer')->name('delete.customer.data');
Route::post('/ajax/customer/bulk/delete', 'CustomersController@bulkDeleteCustomer')->name('bulk.delete.customer.data');
Route::get('/ajax/get-customer-options', 'CustomersController@getCustomerOptions')->name('get-customer-options')->middleware('can:index,App\Customer');
Route::get('/ajax/customer/tasks/{customer}', 'CustomersController@getCustomerTasksAjax')->name('customer-tasks-list');//->middleware('can:list,App\Customer');
Route::get('/ajax/customer/appointments/{customer}', 'CustomersController@getCustomerAppointmentsAjax')->name('customer-appointments-list');//->middleware('can:list,App\Customer');
Route::get('/customer/view/{customer}', 'CustomersController@viewCustomer')->name('view-customer');//->middleware('can:list,App\Customer');


Route::get('/tasks', 'TasksController@index')->name('task-index');//->middleware('can:index,App\Task');
Route::get('/ajax/tasks/data', 'TasksController@getTasksAjax')->name('task-data');//->middleware('can:index,App\Task');

Route::get('/ajax/tasks/data-due', 'TasksController@getTasksAjaxDue')->name('task-data-with-due');//->middleware('can:index,App\Task');

Route::post('/task/create', 'TasksController@createTask')->name('create.task');//->middleware('can:create,App\Task');
Route::get('/task/edit', 'TasksController@editTask')->name('edit.task.data');
Route::post('/task/update', 'TasksController@updateTask')->name('update.task');
Route::post('/task/close', 'TasksController@closeTask')->name('close.task');
Route::post('/task/delete', 'TasksController@deleteTask')->name('delete.task');


Route::get('/appointments', 'AppointmentsController@index')->name('appointment-index');//->middleware('can:index,App\Appointment');
Route::get('/ajax/appointment/data', 'AppointmentsController@getAppointmentsAjax')->name('appointment-data');//->middleware('can:index,App\Appointment');

Route::get('/ajax/appointment/data-current-date', 'AppointmentsController@getAppointmentsAjaxPending')->name('appointment-data-current-date');//->middleware('can:index,App\Appointment');

Route::post('/appointment/create', 'AppointmentsController@createAppointment')->name('create.appointment');//->middleware('can:create,App\Appointment');
Route::get('/appointment/edit', 'AppointmentsController@editAppointment')->name('edit.appointment');
Route::post('/appointment/update', 'AppointmentsController@updateAppointment')->name('update.appointment');
Route::post('/appointment/delete', 'AppointmentsController@deleteAppointment')->name('delete.appointment');
Route::post('/appointment/close', 'AppointmentsController@closeAppointment')->name('close.appointment');

Route::get('/sales-teams', 'SalesteamsController@index')->name('sales-team-index');
Route::get('/sales-teams-options', 'UsersController@listAll')->name('get-sales-team-options');
Route::post('/sales-team/create', 'SalesteamsController@createSalesTeam')->name('create.sales.team');
Route::get('/sales-team/edit', 'SalesteamsController@editSalesTeam')->name('edit.sales.team.data');
Route::post('/sales-team/update', 'SalesteamsController@updateSalesTeam')->name('update.sales.team.data');
Route::post('/sales-team/delete', 'SalesteamsController@deleteSalesTeam')->name('delete.sales.team');
Route::get('/ajax/sales-team/data', 'SalesteamsController@getSalesTeamAjax')->name('sales-team-data');




Route::get('/tag-names', 'TagsController@index')->name('tag-index');
Route::post('/tag/create', 'TagsController@createTag')->name('create.tag');
Route::get('/tag/edit', 'TagsController@editTag')->name('edit.tag');
Route::post('/tag/update', 'TagsController@updateTag')->name('update.tag');
Route::post('/tag/delete', 'TagsController@deleteTag')->name('delete.tag');
Route::get('/ajax/tag/data', 'TagsController@getTagsAjax')->name('tag-data');




Route::get('/accounts', 'AccountsController@index')->name('account-index');//->middleware('can:index,App\Customer');

Route::post('/accounts/create', 'AccountsController@createAccount')->name('create.account');//->middleware('can:list,App\Customer');
Route::get('/accounts/view/{account}', 'AccountsController@viewAccount')->name('view-account');//->middleware('can:list,App\Customer');
Route::get('/accounts/edit/', 'AccountsController@editAccount')->name('edit.modal.data');//->middleware('can:list,App\Customer');
Route::post('/accounts/update', 'AccountsController@updateAccount')->name('update.account');//->middleware('can:list,App\Customer');
Route::get('/ajax/get-customer-account-wise', 'AccountsController@getCustomerAccountWise')->name('get-customer-account-wise');//->middleware('can:index,App\Customer');

Route::post('/accounts/delete', 'AccountsController@deleteAccount')->name('delete.account');//->middleware('can:list,App\Customer');
Route::get('/ajax/accounts/data', 'AccountsController@getAccountsAjax')->name('account-data');//->middleware('can:list,App\Customer');
Route::get('/ajax/accounts/tasks/{account}', 'AccountsController@getAccountTasksAjax')->name('account-tasks-list');//->middleware('can:list,App\Customer');
Route::get('/ajax/accounts/appointments/{account}', 'AccountsController@getAccountAppointmentsAjax')->name('account-appointments-list');//->middleware('can:list,App\Customer');
Route::get('/ajax/account/data/{account}', 'AccountsController@getAccountAjax')->name('get-account');
Route::post('/ajax/accounts/create', 'AccountsController@create')->name('create-account');//->middleware('can:list,App\Customer');
Route::get('/ajax/accounts/list', 'AccountsController@listAll')->name('list-accounts');
Route::post('/accounts/bulk/delete', 'AccountsController@bulkDeleteAccount')->name('bulk.delete.account.data');


Route::get('/calendar', 'CalendarController@index')->name('calendar');
Route::get('/ajax/calendar/events', 'CalendarController@getAjaxEvents')->name('ajax-get-events');


Route::get('/ajax/account/journals/data/{account}', 'JournalController@getAccountJournalsAjax')->name('account-journal-data');
Route::get('/ajax/customer/journals/data/{customer}', 'JournalController@getCustomerJournalsAjax')->name('customer-journal-data');
Route::post('/create-journal', 'JournalController@createJournal')->name('create.journal');
Route::get('/journals/edit/', 'JournalController@editJournal')->name('edit.journal.data');
Route::post('/journals/update', 'JournalController@updateJournal')->name('update.journal');


Route::get('activities', 'ActivityController@index')->name('activities-index');
Route::get('/ajax/activities/recent/{count?}', 'ActivityController@recentActivities')->name('recent-activities');
Route::get('/ajax/activities/', 'ActivityController@getActivities')->name('activities.all.data');

Route::get('/ajax/timezones/', 'TimezonesController@index')->name('timezones')->middleware('auth');

Route::get('/ajax/timezones/', 'TimezonesController@index')->name('timezones')->middleware('auth');

Route::get('/ajax/countries/', 'CountriesController@index')->name('countries')->middleware('auth');
Route::get('/ajax/country/states/', 'CountriesController@states')->name('country-states')->middleware('auth');
