<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
	public function index($id) {
		$user = Auth::user();
		$image = "normal";
		$user_name = $user->name;
	    return view('chat',compact('image','user_name','id'));

	}

	public function index_doteki($id) {
		$user = Auth::user();
		$image = "normal";
		$user_name = $user->name;
	    return view('chat_doteki',compact('image','user_name','id'));

	}

	public function progress(Request $re,$id) {
        $image = "normal";

        $commands = config('command');

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

		$user = Auth::user();

		$user_name = $user->name;

        $user->skill1  = array_rand($commands);
        $user->skill2  = array_rand($commands);
        $user->skill3  = array_rand($commands);
        $user->skill4  = array_rand($commands);

		$user->save();
	    $message = \App\Message::create([
	    	'matter_id' => $id,
	        'body' => $re->input('button')."を押しました。",
	        'user_name' => $user_name ,
	        'type' => "button"
	    ]);

	    event(new MessageCreated($message));
	    return view('chat',compact('image','user_name','id'));

	}

}
