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
    $pusher_app_id = 1045036;
    $pusher_app_key = '7b5150d331d136146d67';
    $pusher_app_secret = 'c9cb8943619845c2f930';
    $pusher_app_cluster = 'ap3';
    return view('welcome', compact('pusher_app_id','pusher_app_key','pusher_app_secret','pusher_app_cluster'));
});
