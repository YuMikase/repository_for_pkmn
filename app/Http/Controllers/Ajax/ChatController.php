<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use App\Events\MatterEnded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Messages;
use App\Matter;
use Illuminate\Support\Facades\Auth;
use Log;

class ChatController extends Controller
{
	public function index($id) {// 新着順にメッセージ一覧を取得
	    return Messages::where('matter_id',$id)->orderBy('id', 'desc')->get();

	}


	public function matter($id) {// 新着順にメッセージ一覧を取得
		$matter = Matter::find($id);
	    return [ floor($matter->barning / $matter->barning_limit * 100),
                floor($matter->progress / $matter->progress_limit * 100),
                floor($matter->time / $matter->time_limit * 100),
        ];

	}

	public function create(Request $request) {

	    $message = Messages::create([
	    	'matter_id' => $request->id,
	        'body' => $request->message,
	        'user_name' => $request->user_name,
	        'type' => "normal"
	    ]);
	    event(new MessageCreated($message));
	}
}
