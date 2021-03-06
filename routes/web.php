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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::redirect('/home','/');

//purchases
Route::get('purchases','PurchasesController@index')->name('purchases');


//users
Route::get('users','UserController@users_top')->name('users');
Route::get('users/{type}','UserRegistrationController@index')->name('usersByType');
Route::post('search-user/{type?}','UserAjaxController@search_user');
Route::post('search-any-user/','UserAjaxController@search_any_user');
Route::post('get-purchases-user','UserAjaxController@get_purchases_user');
Route::post('get-user','UserAjaxController@get_user');
Route::post('create-user','UserAjaxController@create_user');
Route::post('create-customer','UserAjaxController@create_customer');
Route::post('change-user-status','UserAjaxController@change_user_status');
Route::get('profile/{id}','UserController@profile')->name('profile');
Route::post('remove-customer','UserAjaxController@remove_customer');



Route::resource('user-registration','UserRegistrationController');

//depts
Route::get('dept-report/{id?}','DepartmentRegistrationController@report')->name('dept report');
Route::resource('dept-registration','DepartmentRegistrationController');
Route::get('dept-filtered-report','DepartmentRegistrationController@report');
Route::post('add-dept-service','DepartmentAjaxController@add_service');
Route::post('remove-dept-service','DepartmentAjaxController@remove_service');
Route::post('add-dept-room','DepartmentAjaxController@add_room');
Route::post('update-has-rooms','DepartmentAjaxController@update_has_room');
Route::post('remove-dept-room','DepartmentAjaxController@remove_room');
Route::post('add-dept-booking-type','DepartmentAjaxController@add_booking_type');
Route::post('remove-dept-booking-type','DepartmentAjaxController@remove_booking_type');
Route::post('add-dept-menu','DepartmentAjaxController@add_menu');
Route::post('remove-dept-menu','DepartmentAjaxController@remove_menu');

//purchases

Route::post('create-supplier','PurchasesAjaxController@create_supplier');
Route::post('restore-purchases','PurchasesAjaxController@restore_purchase');
Route::post('update-purchase','PurchasesAjaxController@update_purchase');
Route::get('sort-purchases','PurchasesRegistrationController@index');
Route::get('download-purchase/{id}','PurchasesRegistrationController@download');
Route::resource('purchases-registration','PurchasesRegistrationController');
Route::post('share-purchase','PurchasesAjaxController@share');

//products
Route::post('create-product','ProductsAjaxController@create_product');
Route::post('search-product','ProductsAjaxController@search_product');
Route::post('get-product','ProductsAjaxController@get_product');
Route::post('update-product','ProductsAjaxController@update_product');
Route::get('product-requisition/{id}','ProductRegistrationController@requisition')->name('requisition');
Route::get('product-requisition/{id}','ProductRegistrationController@requisition')->name('requisition');
Route::get('product-registration-type','ProductRegistrationController@prod_reg_type')->name('prod_reg_type');
Route::resource('product-registration','ProductRegistrationController');
Route::post('find-product','ProductsAjaxController@find_product');
Route::post('save-cart','ProductsAjaxController@save_cart');
Route::post('make-sale','ProductsAjaxController@make_sale');

//Bookings
Route::post('save-booking','BookingsAjaxController@save_booking');
Route::post('update-booking','BookingsAjaxController@update_booking');
Route::get('sort-bookings','BookingsRegistrationController@index');
Route::get('download-booking/{id}','BookingsRegistrationController@download');
Route::resource('bookings-registration','BookingsRegistrationController');
Route::post('share-booking','BookingsAjaxController@share');
Route::put('booking-payment/{id}','BookingsRegistrationController@booking_payment')->name('booking-payment');

//Transfers
Route::post('save-transfer','TransfersAjaxController@save_transfer');
Route::get('stock-transfer/{id}','TransferController@index')->name('transfer');
Route::resource('transfer','TransferController');


//Reports
Route::resource('booking-report','BookingReportController');
Route::resource('procurement-report','ProcurementReportController');
Route::resource('inventory-report','InventoryReportController');
Route::resource('sales-report','SalesReportController');
Route::resource('expenditure-report','ExpenditureReportController');
Route::resource('revenue-report','RevenueReportController');
Route::resource('profit-loss-report','ProfitLossReportController');
Route::resource('balance-sheet-report','BalanceSheetReportController');

Route::get('booking-filtered-report','BookingReportController@report');
Route::get('download-booking-report','BookingReportController@download');
Route::get('download-procurement-report','ProcurementReportController@download');
Route::get('download-inventory-report','InventoryReportController@download');
Route::post('share-booking-report','BookingReportController@share');
Route::post('share-procurement-report','ProcurementReportController@share');
Route::post('share-inventory-report','InventoryReportController@share');

Route::get('purchase-filtered-report','ProcurementReportController@report');
Route::get('inventory-filtered-report','InventoryReportController@report');

Route::get('profit-loss-filtered-report','ProfitLossReportController@report');
Route::get('download-profit-loss-report','ProfitLossReportController@download');
Route::post('share-profit-loss-report','ProfitLossReportController@share');

Route::get('balance-sheet-filtered-report','BalanceSheetReportController@report');
Route::get('download-balance-sheet-report','BalanceSheetReportController@download');
Route::post('share-balance-sheet-report','BalanceSheetReportController@share');


//Notifications
Route::resource('notifications','NotificationsController');

//Tasks
Route::resource('tasks','TasksController');

//Requisition
Route::resource('requisition','RequisitionController');
Route::post('requisition-approval','RequisitionAjaxController@requisition_approval');
Route::post('requisition-goods-received','RequisitionAjaxController@requisition_goods_received');

//Sale
Route::get('sort-sales','SaleController@index');
Route::resource('sale','SaleController');
Route::get('download-sales-report','SaleController@download');
Route::post('share-sales-report','SaleController@share');

//Expenditure
Route::resource('expenditure','ExpenditureController');
Route::get('download-expenditure-report','ExpenditureReportController@download');
Route::post('share-expenditure-report','ExpenditureReportController@share');
Route::put('expenditure-payment/{expense}','ExpenditureController@expense_payment')->name('expenditure.payment');

//Revenue
Route::resource('revenue','RevenueController');
Route::get('download-revenue-report','RevenueReportController@download');
Route::post('share-revenue-report','RevenueReportController@share');
Route::put('revenue-payment/{revenue}','RevenueController@revenue_payment')->name('revenue.payment');

//Bank
Route::resource('bank','BankController');
