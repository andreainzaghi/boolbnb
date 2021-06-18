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

// AREA PUBBLICA
Route::prefix('/')->namespace('UI')->group(function () {
    Route::get('', 'BnbController@index')->name('welcome');
    Route::get('search', 'BnbController@search')->name('search');
    Route::get('apartments/{id}', 'BnbController@show')->name('ui.apartments.show');
});
//////////////////////////////////////////////////////////////////////


// BRAINTREE - TRANSAZIONI
Route::prefix('/')->namespace('Transactions')->group(function () {
    Route::get('apartments/{apartment}/payment', 'PaymentController@form')->name('payment.form');
    
    Route::get('apartments/payment/process', 'PaymentController@process')->name('payment.process');

});

// Route::namespace('Transactions')->get('ui/apartments/{apartment}/payment/process', 'PaymentController@process')->name('payment.process');
// Route::namespace('Transactions')->get('ui/apartments/{apartment}/payment/process', 'PaymentController@process')->name('payment.process');
//////////////////////////////////////////////////////////////////////


// Route::get('/home', 'HomeController@index'); Pagina Login

Auth::routes();


// AREA PRIVATA
Route::prefix('admin')->name('admin.')->namespace('ADMIN')->middleware('auth')->group(function () {
    Route::resource('apartments', 'ApartmentController');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//////////////////////////////////////////////////////////////////////





