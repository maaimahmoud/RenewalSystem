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
    return view('layouts.app');
});


Route::resource('clients', 'ClientController');

Route::resource('services', 'ServiceController');

Route::resource('paymentmethods', 'PaymentMethodController');

Route::resource('servicescategories', 'ServiceCategoriesController');
//////////////////////////////////
//Service to Client Routes

Route::resource('clients.service', 'ClientServiceController');
//////////////////////////////////


Route::get('services/delete/{id}', 'ServiceController@destroy');

Route::get('clients/delete/{id}', 'ClientController@destroy');

Route::get('clients/{client}/service/{service}/delete', 'ClientServiceController@destroy')->name('client.service.delete');

//Route::get('paymentmethods/delete/{id}', 'PaymentMethodController@destroy');


// Services Categories routes
Route::get('servicescategories/delete/{id}', 'ServiceCategoriesController@destroy');

// Payment Methods routes
Route::get('paymentmethods/delete/{id}', 'PaymentMethodController@destroy');

//Pending routes
Route::get('/statistics',function(){
  return view('statistics');
});

Route::get('/clientservice/payforservice',function(){
  return view('clients/services/payforservice');
});


Route::get('filter/client/{id}', 'FilterController@filterClientsByServices');

Route::get('filter/service/{id}', 'FilterController@filterServicesByCategories');

Route::get('search/client', 'SearchController@searchClient');

Route::get('search/service', 'SearchController@searchService');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clients/{client}/service/{service}/pay', 'ClientServiceController@payForService');
