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


Route::get('/', 'HomeController@index');


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/getEvents','HomeController@getEvents');


Route::resource('clients', 'ClientController');


Route::resource('services', 'ServiceController');


Route::resource('paymentmethods', 'PaymentMethodController');


Route::resource('servicescategories', 'ServiceCategoriesController');


Route::resource('clients.service', 'ClientServiceController');


Auth::routes();
////////////////////////////////////////////////////

Route::get('services/delete/{id}', 'ServiceController@destroy');

Route::get('clients/delete/{id}', 'ClientController@destroy');

Route::get('clients/{client}/service/{service}/delete', 'ClientServiceController@destroy')->name('client.service.delete');

Route::get('clients/{client}/service/{service}/stop', 'ClientServiceController@stop')->name('client.service.stop');

Route::put('client/{days_to_mail}/editReminder/{client_services_id}','ClientServiceController@editReminder')->name('client.service.editReminder');

Route::get('client/{days_to_mail}/deleteReminder/{client_services_id}','ClientServiceController@deleteReminder')->name('client.service.deleteReminder');

Route::get('servicescategories/delete/{id}', 'ServiceCategoriesController@destroy');

Route::get('paymentmethods/delete/{id}', 'PaymentMethodController@destroy');

Route::get('/statistics','StatisticsController@index');

Route::get('filter/client/{id}', 'FilterController@filterClientsByServices');

Route::get('filter/service/{id}', 'FilterController@filterServicesByCategories');

Route::get('search/client', 'SearchController@searchClient');

Route::get('search/service', 'SearchController@searchService');

Route::get('/clients/{client}/service/{service}/pay', 'ClientServiceController@payForService');