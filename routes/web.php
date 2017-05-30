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