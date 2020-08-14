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

// Route::get('/', function () {
//     $chats = App\Messages::orderBy('created_at','desc')->get();
//     $pusher_app_id = config('app.pusher_id');
//     $pusher_app_key = config('app.pusher_key');
//     $pusher_app_secret = config('app.pusher_secret');
//     $pusher_app_cluster = config('app.pusher_cluster');
//     return view('index', compact('chats','pusher_app_id','pusher_app_key','pusher_app_secret','pusher_app_cluster'));
// });

Route::get('chat/{id}', 'ChatController@index');
Route::post('chat/{id}', 'ChatController@progress');

//Pusherに送る
// require __DIR__ . '/../vendor/autoload.php';
// Route::get('/sendmessage', function(){
//     echo 'run';
//     $pusher_app_id = config('app.pusher_id');
//     $pusher_app_key = config('app.pusher_key');
//     $pusher_app_secret = config('app.pusher_secret');
//     $pusher_app_cluster = config('app.pusher_cluster');
//     $pusher = new Pusher\Pusher($pusher_app_key, $pusher_app_secret, $pusher_app_id, array('cluster' => $pusher_app_cluster));
//     $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));
// });
Route::post('/sendmessage', 'MessageController@send');

Route::post('/test2','MainController@write2');

Route::get('ajax/chat/{id}', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat/{id}', 'Ajax\ChatController@create'); // チャット登録





