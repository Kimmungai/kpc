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
Route::get('users','UserController@users_top')->name('users');
Route::get('users/{type}','UserRegistrationController@index')->name('usersByType');
Route::post('search-user/{type?}','UserAjaxController@search_user');
Route::post('search-any-user/','UserAjaxController@search_any_user');
Route::post('get-purchases-user','UserAjaxController@get_purchases_user');
Route::post('get-user','UserAjaxController@get_user');
Route::post('create-user','UserAjaxController@create_user');



Route::resource('user-registration','UserRegistrationController');

//depts
Route::resource('dept-registration','DepartmentRegistrationController');

//purchases
Route::resource('purchases-registration','PurchasesRegistrationController');
Route::post('create-supplier','PurchasesAjaxController@create_supplier');
Route::post('restore-purchases','PurchasesAjaxController@restore_purchase');
Route::post('update-purchase','PurchasesAjaxController@update_purchase');

//products
Route::post('create-product','ProductsAjaxController@create_product');
Route::post('search-product','ProductsAjaxController@search_product');
Route::post('get-product','ProductsAjaxController@get_product');
Route::post('update-product','ProductsAjaxController@update_product');

//Bookings
Route::post('save-booking','BookingsAjaxController@save_booking');

//Transfers
Route::post('save-transfer','TransfersAjaxController@save_transfer');
