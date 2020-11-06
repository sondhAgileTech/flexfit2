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
    return redirect('admin');
});
Route::get('/{token}', 'ContractClient@getToken')->where('token', '[A-Za-z0-9\-\=]+');
Route::get('/hop-dong/{id}', 'ContractClient@get')->where('id', '[A-Za-z0-9\-]+');
Route::post('/ask-advice', 'AskAdviceController@get');
Route::post('/reciever-info', 'AskAdviceController@getInfoReciever');
Route::post('/changed-time-maintain', 'ContractProductController@changedTimeMainTain');
Route::post('/changed-time-maintain-contract', 'ContractClient@changedTimeMainTainContract');
Route::get('/mail/get-mail-html', 'MailController@getHtmlBasic');
Route::get('/api/download/{id_contract}','ContractClient@getPdfFile')->where('id', '[A-Za-z0-9\-]+');
Route::post('/api/download_file','ContractClient@getFileContract');
//Route::get('/mail/received_gift', 'AskAdviceController@getReceivedGift');
Route::get('/mail/received_gift/{id}', 'AskAdviceController@getReceivedGift');