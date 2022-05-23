<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
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
Route::group([
    'namespace'=>'App\Http\Controllers\Api',
    'prefix' => '/rn',
    
], function () {

    Route::get('/cities', 'CityController@list' );
    Route::post('/adress/store', 'AdressController@store' );
    Route::get('/adress/list', 'AdressController@list' );
    Route::get('/adress/edit/{adress_id}', 'AdressController@edit' );
    Route::post('/{adress_id}/adress/update', 'AdressController@update' );
    Route::post('/{adress_id}/adress/destroy', 'AdressController@delete' );

    

 });
