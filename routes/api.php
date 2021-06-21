<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/user/{apartment}', 'Api\ApartmentController@apartment');
Route::get('/user/{apartment}/views', 'Api\ApartmentController@apartmentViews');
Route::get('/user/{apartment}/messages', 'Api\ApartmentController@apartmentMessages');
Route::get('/user/{apartment}/messages/json', 'Api\ApartmentController@messagesJson');


Route::get('/search' , 'Api\ApartmentController@search');