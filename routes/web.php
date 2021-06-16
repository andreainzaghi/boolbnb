<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('/')->namespace('UI')->group(function () {
    Route::get('', 'BnbController@index')->name('welcome');
    Route::get('search', 'BnbController@search')->name('search');
    Route::get('apartments/{id}', 'BnbController@show')->name('ui.apartments.show');
});

// Route::get('/home', 'HomeController@index'); Pagina Login



Auth::routes();

Route::prefix('ur')->name('ur.')->namespace('UR')->middleware('auth')->group(function () {
    Route::resource('apartments', 'ApartmentController');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

