<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
	public function index($id) {// 新着順にメッセージ一覧を取得
	    return \App\Message::where('matter_id',$id)->orderBy('id', 'desc')->get();

	}

	public function create(Request $request) {

	    $message = \App\Message::create([
	    	'matter_id' => $request->id,
	        'body' => $request->message,
	        'user_name' => $request->user_name
	    ]);
	    event(new MessageCreated($message));

	}
}
