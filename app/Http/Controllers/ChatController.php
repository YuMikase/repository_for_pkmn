<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;

use App\Matter;
use App\MatterHasUser;
use App\Messages;

class ChatController extends Controller
{
	public function index($id) {
		$user = Auth::user();
		$image = "normal";
		$user_name = $user->name;
	    return view('chat',compact('image','user_name','id'));

	}

	public function index_doteki($id) {
		$matter = Matter::find($id);
		if ( empty($matter) || $matter->end_flag ) {
			return redirect('/home');
		}
		$reward = config('rate_type')[$matter->rate_type]['reward'];
		$items = config('item');
		$user = Auth::user();
		$image = "normal";
		$user_name = $user->name;
		$cmds = config('command');
		$cmds_now = [ 
			$cmds[$user->skill1],
			$cmds[$user->skill2],
			$cmds[$user->skill3],
			$cmds[$user->skill4],
		];
		if ( empty( MatterHasUser::where('matter_id', $id)->where('user_id', $user->id)->first() ) ) {
			MatterHasUser::create(['matter_id' => $matter->id, 'user_id' => $user->id]);
		}
	    return view('chat_doteki',compact('user','image','user_name','id','cmds_now','items', 'reward'));

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

		$input_command = $re->input('button');
		
		//案件TBL加算処理
		$matter = Matter::find($id);

		$matter->barning = $matter->barning + $commands[$input_command]['barning'];
		$matter->progress = $matter->progress + $commands[$input_command]['progress'];
		$matter->time = $matter->time + $commands[$input_command]['time'];
		$matter->save();

		//コマンドをランダムに入れなおし（選定１回）
		$rand_commands = array_rand($commands, 4);
        $user->skill1  = $rand_commands[0];
        $user->skill2  = $rand_commands[1];
        $user->skill3  = $rand_commands[2];
        $user->skill4  = $rand_commands[3];

		$user->save();
	    $message = Messages::create([
	    	'matter_id' => $id,
	        'body' => $commands[$input_command]['name']."を押しました。",
	        'user_name' => $user_name ,
	        'type' => "button"
	    ]);

	    event(new MessageCreated($message));
	    return view('chat',compact('image','user_name','id'));
	}
}
