<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;

use App\Matter;
use App\MatterHasUser;
use App\MatterHistory;
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
        $image = "one";

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
		
		//案件取得
		$matter = Matter::find($id);

		if($matter->time < $matter->time_limit){
			if(strcmp($matter->matter_lang, $commands[$input_command]['lang'])){
				//案件TBL加算処理
				$matter->barning += $commands[$input_command]['barning'];
				$matter->progress += $matter->progress + $commands[$input_command]['progress'];
				$matter->time += $commands[$input_command]['time'];
				$matter->save();
			}else{
				//案件TBL引き算処理
				$matter->barning -= $commands[$input_command]['barning'];
				$matter->progress -= $matter->progress + $commands[$input_command]['progress'];
				$matter->time += $commands[$input_command]['time'];
				$matter->save();
			}

			//履歴作成
			MatterHistory::create(['matter_id' => $matter->id, 'user_id' => $user->id,'lang'=>$commands[$input_command]['lang']]);
		}

		if($matter->time = $matter->time_limit){
			//終了処理記述
		}

		

		//コマンドをランダムに入れなおし
        $user->skill1  = array_rand($commands);
        $user->skill2  = array_rand($commands);
        $user->skill3  = array_rand($commands);
        $user->skill4  = array_rand($commands);

		$user->save();

		//メッセージ作成
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
