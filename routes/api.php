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

Route::middleware('auth:api')->get('/items', 'Api\ItemsController@all');
Route::middleware('auth:api')->post('/items/store', 'Api\ItemsController@store');
Route::middleware('auth:api')->post('/items/update', 'Api\ItemsController@update');
Route::middleware('auth:api')->post('/items/delete', 'Api\ItemsController@destroy');

Route::middleware('auth:api')->get('/categories', 'Api\CategoriesController@all');
Route::middleware('auth:api')->post('/categories/store', 'Api\CategoriesController@store');
Route::middleware('auth:api')->post('/categories/update', 'Api\CategoriesController@update');
Route::middleware('auth:api')->post('/categories/delete', 'Api\CategoriesController@destroy');
