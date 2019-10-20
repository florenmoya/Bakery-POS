<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/logout', 'Api\AuthController@logout');


Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::middleware('auth:api')->get('/isLoggedIn', 'Api\AuthController@isLoggedIn');

Route::middleware('auth:api')->get('/dashboard', 'Api\ReportsController@dashboard');

Route::middleware('auth:api')->get('/items', 'Api\ItemsController@all');
Route::middleware('auth:api')->post('/items/store', 'Api\ItemsController@store');
Route::middleware('auth:api')->post('/items/update', 'Api\ItemsController@update');
Route::middleware('auth:api')->post('/items/delete', 'Api\ItemsController@destroy');

Route::middleware('auth:api')->get('/categories', 'Api\CategoriesController@all');
Route::middleware('auth:api')->post('/categories/store', 'Api\CategoriesController@store');
Route::middleware('auth:api')->post('/categories/update', 'Api\CategoriesController@update');
Route::middleware('auth:api')->post('/categories/delete', 'Api\CategoriesController@destroy');

Route::middleware('auth:api')->get('/sales', 'Api\SalesController@all');
Route::middleware('auth:api')->get('/sales/register', 'Api\SalesController@index');
Route::middleware('auth:api')->post('/sales', 'Api\SalesController@store');
Route::middleware('auth:api')->post('/sales/register', 'Api\SalesController@sale_register_store');
Route::middleware('auth:api')->post('/sales/register/close', 'Api\SalesController@sales_register_close_store');

Route::middleware('auth:api')->get('/deliveries', 'Api\DeliveriesController@select');
Route::middleware('auth:api')->post('/deliveries', 'Api\DeliveriesController@store');

Route::middleware('auth:api')->get('/reports/sales', 'Api\SalesController@report_sales');
Route::middleware('auth:api')->get('/reports/deliveries', 'Api\DeliveriesController@report_deliveries');
Route::middleware('auth:api')->get('/reports/closing_counts', 'Api\ReportsController@closing_counts');

Route::middleware('auth:api')->get('/currents/sales', 'Api\ReportsController@currents_sales');

Route::middleware('auth:api')->get('/refunds', 'Api\RefundsController@select');
Route::middleware('auth:api')->post('/refunds', 'Api\RefundsController@store');


Route::middleware('auth:api')->get('/balis', 'Api\BaliController@select');
Route::middleware('auth:api')->post('/balis', 'Api\BaliController@store');

Route::middleware('auth:api')->get('/employee', 'Api\SettingsController@employee_list');
Route::middleware('auth:api')->post('/employee/store', 'Api\SettingsController@employee_store');
Route::middleware('auth:api')->post('/employee/update', 'Api\SettingsController@employee_update');
Route::middleware('auth:api')->post('/employee/destroy', 'Api\SettingsController@employee_destroy');

Route::middleware('auth:api')->get('/employee/role', 'Api\SettingsController@employee_role');
Route::middleware('auth:api')->post('/employee/role/store', 'Api\SettingsController@employee_role_store');
Route::middleware('auth:api')->post('/employee/role/update', 'Api\SettingsController@employee_role_update');
Route::middleware('auth:api')->post('/employee/role/destroy', 'Api\SettingsController@employee_role_destroy');

Route::middleware('auth:api')->get('/register/activities', 'Api\RegistersActivitiesController@select');
Route::middleware('auth:api')->post('/register/activities/store', 'Api\RegistersActivitiesController@store');
Route::middleware('auth:api')->post('/register/activities/update', 'Api\RegistersActivitiesController@update');
Route::middleware('auth:api')->post('/register/activities/delete', 'Api\RegistersActivitiesController@destroy');

Route::middleware('auth:api')->get('/companies', 'Api\CompaniesController@all');
Route::middleware('auth:api')->post('/companies/store', 'Api\CompaniesController@store');
Route::middleware('auth:api')->post('/companies/update', 'Api\CompaniesController@update');
Route::middleware('auth:api')->post('/companies/delete', 'Api\CompaniesController@destroy');