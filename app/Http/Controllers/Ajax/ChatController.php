<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
	public function index($id) {// 新着順にメッセージ一覧を取得
	    return \App\Message::orderBy('id', 'desc')->get();

	}

	public function create(Request $request) {
		
		
		$type = $request->type;

		switch ($type) {
			case 'chat':
				$body = "メッセージ：".$request->message;
				break;
			case 'command':
				$body = $request->message."のボタンを押した。";
				break;
			case 'debug':
				$body = $request->message."を行った。";
				break;
			case 'item':
				$body = $request->message."のアイテムを使用した。";
				break;
			case 'run':
				$body = "逃げることができた。";
				break;
			default:
				# code...
				break;
		}

	    $message = \App\Message::create([
	        'body' => $body,
			'user_name' => $request->user_name,
			'type' => $type
	    ]);
	    event(new MessageCreated($message));

	}
}
