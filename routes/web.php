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


Route::get('chat/{id}', 'ChatController@index')->middleware('auth');
Route::post('chat/{id}', 'ChatController@progress')->middleware('auth');
Route::get('chat/doteki/{id}', 'ChatController@index_doteki')->middleware('auth');

Route::post('/sendmessage', 'MessageController@send');

Route::post('/test2','MainController@write2');

Route::get('ajax/chat/{id}', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat/{id}', 'Ajax\ChatController@create'); // チャット登録
Route::post('ajax/command/{id}', 'Ajax\ChatController@create_command'); // コマンド

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return redirect('/login');
});
