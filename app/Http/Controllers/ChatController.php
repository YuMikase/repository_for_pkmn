<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
	public function index() {
		$image = "normal";
		$user_name = "name";
	    return view('chat',compact('image','user_name')); // フォームページのビュー

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
	    return view('chat',compact('image','user_name'));  // フォームページのビュー

	}

}
