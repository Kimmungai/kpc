<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//purchases
Route::get('/purchases','PurchasesController@index')->name('purchases');


//users
Route::resource('user-registration','UserRegistrationController');

//depts
Route::resource('dept-registration','DepartmentRegistrationController');

//purchases
Route::resource('purchases-registration','PurchasesRegistrationController');
