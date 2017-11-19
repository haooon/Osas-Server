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
Route::post('/smsFunc', 'MessageController@smsFunc');

Route::post('/setClock', 'clockController@setClock');
Route::post('/deleteClock', 'clockController@deleteClock');
Route::post('/getClocks', 'clockController@getClocks');

Route::get('/cha', 'testController@cha');
Route::get('/zeng', 'testController@zeng');
Route::get('/gai', 'testController@gai');
Route::get('/shan', 'testController@shan');
Route::post('/emailFunc', 'MessageController@emailFunc');
