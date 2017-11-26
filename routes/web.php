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


Route::post('/register', 'userController@register');
Route::post('/login', 'userController@login');

Route::post('/setClock', 'clockController@setClock');
Route::post('/deleteClock', 'clockController@deleteClock');
Route::post('/getClocks', 'clockController@getClocks');

Route::post('/addPE', 'PEController@addPE');
Route::post('/fixPE', 'PEController@fixPE');
Route::post('/deletePE', 'PEController@deletePE');
Route::post('/getPEs', 'PEController@getPEs');
Route::post('/getPEsBy', 'PEController@getPEsBy');
Route::post('/getAvgPEsBy', 'PEController@getAvgPEsBy');
Route::post('/getOneDayPEsBy', 'PEController@getOneDayPEsBy');

Route::post('/getDieasesInfoByName', 'diseaseController@getDieasesInfoByName');
Route::post('/getDieaseInfoById', 'diseaseController@getDieaseInfoById');
Route::post('/getDieasesInfoBySym', 'diseaseController@getDieasesInfoBySym');

Route::get('/cha', 'testController@cha');
Route::get('/zeng', 'testController@zeng');
Route::get('/gai', 'testController@gai');
Route::get('/shan', 'testController@shan');
Route::post('/emailFunc', 'MessageController@emailFunc');
