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

//画面遷移系
Route::get('/', 'IndexController@index');
Route::get('/mypage', 'IndexController@mypage');
Route::post('mypage', 'IndexController@mypagepost');
Route::get('/status', 'IndexController@status');
Route::get('/items', 'IndexController@items');
Route::get('/shop', 'IndexController@shop');

//ログアウト
Route::post('/logout', 'IndexController@logout');

//チャット部分
Route::get('chat', 'ChatController@index');
Route::post('chat', 'ChatController@progress');
Route::get('ajax/chat/{id}', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat', 'Ajax\ChatController@create'); // チャット登録

//認証系
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

