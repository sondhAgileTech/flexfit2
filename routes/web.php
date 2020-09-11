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
Route::get('/{token}', 'ContractClient@getToken')->where('token', '[A-Za-z0-9\-\=]+');
Route::get('/hop-dong/{id}', 'ContractClient@get')->where('id', '[A-Za-z0-9\-]+');