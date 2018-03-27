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
//////////////////////////////////
//Service to Client Routes

Route::get('/clients/{id}/requestaddservice','ClientController@requestaddservice')->name('clients.requestaddservice');

Route::get('/clients/{client_id}/requesteditservice/{service_id}','ClientController@requesteditservice')->name('clients.requesteditservice');

Route::put('/clients/{id}/addservice','ClientController@addservice')->name('clients.addservice');
//Edit service added to client
Route::get('/clients/{id}/editservice/{service_id}', 'ClientController@editservice')->name('clients.editservice');
//Delete Service from client
Route::get('/clients/{id}/deleteservice/{service_id}', 'ClientController@deleteservice')->name('clients.deleteservice');
//////////////////////////////////


Route::get('services/delete/{id}', 'ServiceController@destroy');

Route::get('clients/delete/{id}', 'ClientController@destroy');

//Route::get('paymentmethods/delete/{id}', 'PaymentMethodController@destroy');


// Services Categories routes
Route::POST('servicescategories/create', 'ServiceCategoriesController@store');

Route::get('servicescategories/delete/{id}', 'ServiceCategoriesController@destroy');

Route::PUT('servicescategories/edit/{id}', 'ServiceCategoriesController@update');


// Payment Methods routes
Route::POST('paymentmethods/create', 'PaymentMethodController@store');

Route::get('paymentmethods/delete/{id}', 'PaymentMethodController@destroy');

Route::PUT('paymentmethods/edit/{id}', 'PaymentMethodController@update');

Route::get('/settings',function(){
  return view('settings');
});

Route::get('clients/service/{id}', 'ClientController@getClientsFromService');

Route::post('search/client', 'SearchController@searchClient');
