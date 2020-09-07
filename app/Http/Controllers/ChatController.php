<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Matter;
use App\MatterHasUser;
use App\MatterHistory;
use App\Messages;
use App\User;
use App\UserLangSkill;

class ChatController extends Controller
{
	public function index(Request $request,$id) {
		$user = Auth::user();
		$image = "normal";
		$user_name = $user->name;

		//案件終了時一覧画面に遷移
		$matter = Matter::find($id);
		$lang = $matter->matter_lang;
		if($matter->time > $matter->time_limit){
			//flash_message保存
			$request->session()->flash('flash_message', '案件は終了しました。');
			$request->session()->reflash();
			return redirect('/result/'.$id);
		}
	    return view('chat',compact('image','user_name','id','lang'));

	}

	public function result(Request $request,$id) {
		if ($request->session()->has('flash_message')) {
		    $request->session()->flash('flash_message', '案件は終了しました。');
			$request->session()->reflash();
		}
		$messages = Messages::where('matter_id',$id)->orderBy('id', 'desc')->get()->toArray();
	    return view('result',compact('id','messages'));
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

	public function progress(Request $request,$id) {

        $commands = config('command');

        //案件取得
		$matter = Matter::find($id);
		//言語情報取得
		$lang = $matter->matter_lang;

        //案件終了時
        if($matter->time > $matter->time_limit){
			$request->session()->flash('flash_message', '案件は終了しました。');
			$request->session()->reflash();
			return redirect('/result/'.$id);
		}

		$user = Auth::user();

		$user_name = $user->name;

		$input_command = $request->input('button');

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

		if($matter->time < $matter->time_limit){
			//ノーマル属性の案件の場合
			if(strcmp('Normal', $commands[$input_command]['lang']) == 0 or strcmp('Normal', $matter->matter_lang)){
				$matter->barning += $commands[$input_command]['barning'];
				$matter->progress += $matter->progress + $commands[$input_command]['progress'];
			}
			//言語属性が一致していた場合
			elseif(strcmp($matter->matter_lang, $commands[$input_command]['lang']) == 0){
				//案件TBL加算処理
				$matter->progress += $matter->progress + $commands[$input_command]['progress'] * 2;
			//属性が一致しない場合
			}else{
				$matter->barning += $commands[$input_command]['barning'] * 3;
				$matter->progress -= $matter->progress + $commands[$input_command]['progress'];
			}
			$matter->time += $commands[$input_command]['time'];
			$matter->save();

			//履歴作成
			MatterHistory::create(['matter_id' => $matter->id, 'user_id' => $user->id,'lang'=>$commands[$input_command]['lang']]);
		}
		if($matter->barning == 0){
			$image = "normal";
		}elseif(($matter->barning_limit / $matter->barning) > 1){
			$image = "one";
		}else{
			$image = "two";
		}

		//戦闘が終了する場合
		if($matter->time == $matter->time_limit){

			$matter->time++;

			//戦闘終了
		    $message = Messages::create([
		    	'matter_id' => $id,
		        'body' => "戦闘が終了しました。",
		        'user_name' => "システムメッセージ",
		        'type' => "system"
		    ]);

		    $message = Messages::create([
		    	'matter_id' => $id,
		        'body' => "炎上は".$matter->barning."でした。",
		        'user_name' => "システムメッセージ",
		        'type' => "system"
		    ]);

		    $message = Messages::create([
		    	'matter_id' => $id,
		        'body' => "進捗は".$matter->progress."でした。",
		        'user_name' => "システムメッセージ",
		        'type' => "system"
		    ]);

		    //履歴から言語情報が一致しているものだけを取得
			$matters_histories = MatterHistory::groupBy('user_id')->select('user_id', DB::raw('count(*) as user_count'))->where('lang',$matter->matter_lang)->get();

			foreach ($matters_histories as $matters_history ) {
				//スキルアップ
				$skill_up = floor($matters_history['user_count'] / 3);

				//報酬計算
				$reward = floor($matters_history['user_count'] * 1000);


				//スキルレベル合算処理
				$skill_level =  UserLangSkill::where('user_id',$matters_history->user->id)->where('skill',$matter->matter_lang)->first();
				$skill_level->level += $skill_up;

				$skill_level->save();
				$matter->save();

				//報酬合算処理
				$matters_history->user->money += $reward;

				$matters_history->user->save();

				//スキルに関してメッセージ作成
			    $message = Messages::create([
			    	'matter_id' => $id,
			        'body' => $matters_history->user->name.'の'.$skill_level->skill.'が'.$skill_up.'上がった！',
			        'user_name' => "システムメッセージ" ,
			        'type' => "info"
			    ]);

			    //報酬に関してメッセージ作成
			    $message = Messages::create([
			    	'matter_id' => $id,
			        'body' => $matters_history->user->name.'は'.$reward.'を手に入れた！',
			        'user_name' => "システムメッセージ" ,
			        'type' => "info"
			    ]);

			}
			$request->session()->flash('flash_message', '案件は終了しました。');
			$request->session()->reflash();
			return redirect('/result/'.$id);
		}

		if($matter->time > $matter->time_limit){
			return redirect('/result/'.$id)->with('flash_message', '案件は終了しました。');
		}

		event(new MessageCreated($message));

	    return view('chat',compact('image','user_name','id','user','lang'));
	}
}
