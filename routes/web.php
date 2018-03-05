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
// Services Routes

Route::GET('Home/AddService', 'ServicesController@Add');
Route::POST('/Home/EditService', 'ServicesController@Edit');
Route::GET('/Home/GetServices', 'ServicesController@Get');
Route::GET('/Home/Service{id}', 'ServicesController@View');

Route::get('/', function () {
   /*return ("reko is playing ");*/
    return view('welcome');
});
