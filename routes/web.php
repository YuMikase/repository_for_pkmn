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

Route::get('/', 'IndexController@index');
Route::get('/a2', 'IndexController@a2');
Route::post('a2', 'IndexController@a2post');
Route::get('/b1', 'IndexController@b1');
Route::get('/c1', 'IndexController@c1');
Route::get('/d1', 'IndexController@d1');
Route::get('/e2', 'IndexController@e2');


Route::get('chat', 'ChatController@index');
Route::post('chat', 'ChatController@progress');


Route::post('/sendmessage', 'MessageController@send');

Route::post('/test2','MainController@write2');

Route::get('ajax/chat/{id}', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat', 'Ajax\ChatController@create'); // チャット登録






