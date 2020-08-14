<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageCreated;

class ChatController extends Controller
{
	public function index() {
		$image = "normal";
		$user_name = "name";
		
		//コマンド読み込み
		$lang = 'php';
		$commands = config('const.COMMANDS')[$lang];
		//アイテム読み込み
		$items = config('const.ITEMS');

	    return view('chat',compact('image','user_name', 'commands', 'items'));

	}

	public function progress(Request $re) {
		switch ($re->input('button')){
			case '1':
				$image = "one";
				break;
			case '2':
				$image = "two";
				break;
			case '3':
				$image = "three";
				break;
			case '4':
				$image = "four";
				break;
		}
		$user_name = "name";

	    $message = \App\Message::create([
	        'body' => $re->input('button')."を押しました。",
	        'user_name' => "たかし",
			'type' => 'my_do'
	    ]);
	    event(new MessageCreated($message));
	    return view('chat',compact('image','user_name'));

	}

}
