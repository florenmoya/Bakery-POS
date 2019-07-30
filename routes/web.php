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

Route::resource('items', 'ItemsController');
Route::resource('categories', 'CategoriesController');
Route::resource('sales', 'SalesController');
Route::resource('cart', 'CartController');
Route::resource('deliveries', 'DeliveriesController');
Route::resource('bali', 'BaliController');
Route::resource('refund', 'RefundsController');

Route::get('register/withdraw_amount', 'RegisterController@withdraw_amount');
Route::post('register/withdraw_amount', 'RegisterController@withdraw_amount_store');
Route::get('register/close_register', 'RegisterController@reports_close_register');
Route::post('register/close_register', 'RegisterController@reports_close_register_store');
Route::get('register_amount/', 'RegisterController@index');
Route::post('register_amount/', 'RegisterController@register_amount_store');
Route::get('register/close_register/print', 'RegisterController@reports_close_print');

Route::get('/reports', [
    'as' => 'reports.index',
    'uses' => 'PagesController@reports'
]);

Route::get('/inventory', [
    'as' => 'inventory.index',
    'uses' => 'PagesController@inventory'
]);

Route::post('/inventory/deliveries/item_store', [
    'as' => 'deliveries.item_store',
    'uses' => 'DeliveriesController@item_store'
]);

Route::post('/sales/bali/item_store', [
    'as' => 'bali.item_store',
    'uses' => 'BaliController@item_store'
]);

Route::get('/reports/sales_today', [
    'as' => 'reports.sales_today',
    'uses' => 'ReportsController@sales_today'
]);

Route::get('/reports/inventory', [
    'as' => 'reports.inventory',
    'uses' => 'ReportsController@inventory'
]);
Route::get('/reports/closing_counts', [
    'as' => 'reports.closing_counts',
    'uses' => 'ReportsController@closing_counts'
]);
Route::get('/reports/delivery', [
    'as' => 'reports.deliveries_total',
    'uses' => 'ReportsController@deliveries_total'
]);
Route::get('/reports/activity_logs', [
    'as' => 'reports.activity_logs',
    'uses' => 'ReportsController@activity_logs'
]);
Route::get('/raw', [
    'as' => 'raw.index',
    'uses' => 'rawcontroller@index'
]);

Route::get('/rawall', [
    'as' => 'raw.rawall',
    'uses' => 'rawcontroller@rawall'
]);

Route::get('/settings', [
    'as' => 'settings.index',
    'uses' => 'PagesController@settings'
]);