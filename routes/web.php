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


Route::get('test', function(){
    return view('paypal');
});


//paypal
Route::get('payment', 'PayPalController@index')->name('checkout.payment');
//payment
Route::get('pay-with-payment','PayPalController@payWithPaypal')->name('payment.paypal');
//save user info
Route::get('paypal-callback', 'PayPalController@paypaySuccess')->name('payment.paypalSuccess');

//2C2P
Route::get('credit', 'CreditController@index')->name('checkout-credit');