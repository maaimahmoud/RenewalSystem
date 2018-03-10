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


Route::resource('clients', 'ClientController');


Route::resource('services', 'ServiceController');

Route::resource('paymentmethods', 'PaymentMethodController');

Route::resource('servicescategories', 'ServiceCategoriesController');

Route::get('services/delete/{id}', 'ServiceController@destroy');

Route::get('clients/delete/{id}', 'ClientController@destroy');

Route::get('paymentmethods/delete/{id}', 'PaymentMethodController@destroy');

Route::get('servicescategories/delete/{id}', 'ServiceCategoriesController@destroy');

Route::post('servicescategories/edit/{id}', 'ServiceCategoriesController@update');

Route::get('/settings',function(){
  return view('settings');
});
