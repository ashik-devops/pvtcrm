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
Route::get('/users', 'UsersController@index');
Route::get('/user/profile/edit/{user}', 'UsersController@edit')->name('profile-edit');
Route::patch('/user/profile/update/{user}', 'UsersController@update')->name('profile-update');