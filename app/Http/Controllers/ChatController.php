<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Log;
use MyFunc;

class ChatController extends Controller
{
	public function index() {
		$time_over = 0;
		$image = "normal";
		$user_name = "name";
	    return view('chat',compact('image','user_name', 'time_over'));

	}

	public function progress(Request $re) {
		$time_over = 0; 
		//攻撃回数を１回増やして
		$atack_count = session('atack_count') + 1;
		//セッションに攻撃回数を保存
		session(['atack_count' => $atack_count]);

		//攻撃回数が5回になったらタイムオーバーフラグを立てる
		if($atack_count >= 5){
			$time_over = 1;
		}

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
			case '5':
				$image = "one";
				$atack_count = 0;
				session(['atack_count' => $atack_count]);
				break;
			
		}
		$user_name = "name";

	    $message = \App\Message::create([
	        'body' => $re->input('button')."を押しました。",
			'user_name' => "たかし",
			'type' => 'my_do'
	    ]);
	    event(new MessageCreated($message));
	    return view('chat',compact('image','user_name','time_over'));

	}

}
