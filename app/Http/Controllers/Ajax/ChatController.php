<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use App\Events\MatterEnded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Matter;
use App\UserStatuses;
use App\UserLangSkill;
use App\MatterHasUser;
use App\User;
use App\Messages;
use Illuminate\Support\Facades\Auth;
use Log;

class ChatController extends Controller
{
	public function index($id) {// 新着順にメッセージ一覧を取得
	    return Messages::where('matter_id',$id)->orderBy('id', 'desc')->get()->toArray();

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

	public function index_command($user_id) {// ユーザーのコマンドを取得
		$user = Auth::user();
		$cmds = config('command');
	    return [ $cmds[$user->skill1], $cmds[$user->skill2], $cmds[$user->skill3], $cmds[$user->skill4]];
	}

	public function create_command(Request $request, $id) {

		$commands = config('command');
		

		$input_command = $request->command;
		//案件TBL加算処理
		$matter = \App\Matter::find($id);
		$rate_type = config('rate_type')[$matter['rate_type']];
		self::addMatterStatus(
			$id,
			$commands[$input_command]['barning'] * $rate_type['barning'][$commands[$input_command]['lang']],
			$commands[$input_command]['progress'] * $rate_type['progress'][$commands[$input_command]['lang']],
			1
		);

		$attack = config('attack_type')[$matter['attack_type']]['terms'];
		if ( ! empty( $attack[$matter->time] ) ) {
			self::addMatterStatus(
				$id,
				$attack[$matter->time]['barning'],
				$attack[$matter->time]['progress']
			);
			$message = Messages::create([
				'matter_id' => $id,
				'body' => $attack[$matter->time]['message'],
				'user_name' => "案件",
				'type' => "normal"
			]);
		}


		//コマンドをランダムに入れなおし（選定１回）
		$rand_commands = array_rand($commands, 4);
		shuffle($rand_commands);
		$user = Auth::user();
        $user->skill1  = $rand_commands[0];
        $user->skill2  = $rand_commands[1];
        $user->skill3  = $rand_commands[2];
        $user->skill4  = $rand_commands[3];
		$user->save();

	    $message = Messages::create([
	    	'matter_id' => $id,
	        'body' => $request->message,
	        'user_name' => $request->user_name,
	        'type' => "normal"
	    ]);
		event(new MessageCreated($message));

		//言語情報が一致していた場合のみ加算
		if (strcmp($rate_type['name'], $commands[$input_command]['lang']) == 0 ) {
			MatterHasUser::where('matter_id', $id)->where('user_id', $user->id)->increment('command_count');
		};
		
		// 案件終了時処理
		if( $matter->time >= $matter->time_limit) {

			// 案件終了（＝報酬付与完了）フラグをみて報酬処理
			if ( $matter->end_flag == 0 ) {
				//参加ユーザー全取得
				$matter_has_users = MatterHasUser::where('matter_id', $id)->get();
				foreach ($matter_has_users as $key => $value) {
					$user = User::find($value['user_id']);

					//倍率計算
					$per = ($matter["barning_limit"] / $matter["barning"]) / ($matter["barning_limit"] / $matter["barning"]);

					Log::debug($per);
	
					//報酬処理
					$result = $value['command_count'] * 20000;
	
					//基本給
					if($result > 0){
						$user->money+= $result;
						Messages::create([
							'matter_id' => $id,
							'body' => $user->name.'は￥'.$result.'を手に入れた。',
							'user_name' => "システムメッセージ",
							'type' => "system"
						]);
					}
	
					$result =  $matter->barning * -500 + $matter->progress * 500;
	
					//ボーナス
					if($result > 0){
						$user->money += $result;
						Messages::create([
							'matter_id' => $id,
							'body' => $user->name.'はボーナスとして￥'.$result.'を手に入れた。',
							'user_name' => "システムメッセージ",
							'type' => "system"
						]);
					}
	
					//言語スキル処理
					$user_lang_skill = UserLangSkill::where('user_id', $value['user_id'])->where('skill', $rate_type['name'])->first();
	
					//上昇するレベルの値
					$up_level = floor($value['command_count']/3);
	
					if($up_level > 0){
						$user_lang_skill['level'] += $up_level;
						Messages::create([
								'matter_id' => $id,
								'body' => $user->name.'は'.$rate_type['name'].'のレベルが'.$up_level.'上がった！',
								'user_name' => "システムメッセージ",
								'type' => "system"
						]);
					}
	
					Log::debug($user_lang_skill['level']);
	
					$user_lang_skill->save();
					$user->save();
				}

				// 案件終了（＝報酬付与完了）フラグたてる
				$matter->end_flag = 1;
				$matter->save();

				// 案件終了時のイベント発火
				event(new MatterEnded($matter));
			}
			
		}

	}
	public function index_bar($matter_id) {// ユーザーのコマンドを取得
		$bars = \App\Matter::find($matter_id);
		return [ floor($bars['barning'] / $bars['barning_limit'] * 100),
				floor($bars['progress'] / $bars['progress_limit'] * 100),
				floor($bars['time'] / $bars['time_limit'] * 100),
		];
	}
	
	public function index_img($matter_id) {// ユーザーのコマンドを取得
		$matter = \App\Matter::find($matter_id);
		
		// とりあえず3段階で評価
		// 炎上
		$barning_par = $matter['barning'] / $matter['barning_limit'];
		if ( $barning_par >= 0.66 ) {
			$enemyImg = '/img/three.png';
		} elseif ( $barning_par >= 0.33 ) {
			$enemyImg = '/img/two.png';
		} else {
			$enemyImg = '/img/normal.png';
		}
		// 進捗
		$progress_par = $matter['progress'] / $matter['progress_limit'];
		if ( $progress_par >= 0.66 ) {
			$meImg = '/img/four.png';
		} elseif ( $progress_par >= 0.33 ) {
			$meImg = '/img/two.png';
		} else {
			$meImg = '/img/normal.png';
		}

		return [ $enemyImg, $meImg ];
	}

	public function onDebug(Request $req)
	{
		// 各種情報取得
		$user_name = Auth::user()->name;
		$matter_id = $req->matter_id;
		
		// timeを進める
		$matter = Matter::find($matter_id);
		$matter->time += 1;
		$matter->save();

		// メッセージ作成
		$message = Messages::create([
            'matter_id' => $matter_id,
            'body' => $user_name.'はデバッグを行い炎上度を確かめた。',
            'user_name' => $user_name,
            'type' => "debug"
		]);
		event(new MessageCreated($message));

	}

	public static function createMatter()
	{
		$rate_type = config('rate_type');
		$attack_type = config('attack_type');
		$data = [
			'skill_count' => 0,
			'barning' => 0,
			'progress' => 0,
			'time' => 0,
			'barning_limit' => rand(100, 1000),
			'progress_limit' => rand(100, 1000),
			'time_limit' => rand(10, 20),
			'rate_type' => array_rand($rate_type),
			'attack_type' => array_rand($attack_type),
		];

		\App\Matter::create($data);
	}

	public static function addMatterStatus($matter_id, $barning = 0, $pregress = 0, $time = 0)
	{
		$matter = Matter::find($matter_id);
		$matter->barning = $matter->barning + $barning;
		$matter->progress = $matter->progress + $pregress;
		$matter->time = $matter->time + $time;
		$matter->save();
	}

	public static function addUserStatus($user_id, $type, $value)
	{
		$status = UserStatuses::where('user_id', $user_id)->get();
		switch ($type) {
			case 'money':
				$status = $status->where('type', 'money')->first();
				$status->value1 = $status->value1 + $value;
				$status->save();
				break;
			
			case 'PHP':
				$status = $status->where('type', 'level_php')->first();
				if ( $status->value2 + $value >= 100 ) {
					$status->value2 = $status->value2 + $value - 100;
					$status->value1 = $status->value1 + 1;
					$status->save();
				} else {
					$status->value2 = $status->value2 + $value;
					$status->save();
				}
				break;

			case 'Python':
				$status = $status->where('type', 'level_python')->first();
				if ( $status->value2 + $value >= 100 ) {
					$status->value2 = $status->value2 + $value - 100;
					$status->value1 = $status->value1 + 1;
					$status->save();
				} else {
					$status->value2 = $status->value2 + $value;
					$status->save();
				}
				break;
			case 'Ruby':
				$status = $status->where('type', 'level_ruby')->first();
				if ( $status->value2 + $value >= 100 ) {
					$status->value2 = $status->value2 + $value - 100;
					$status->value1 = $status->value1 + 1;
					$status->save();
				} else {
					$status->value2 = $status->value2 + $value;
					$status->save();
				}
				break;
			case 'ふつう':
				$status = $status->where('type', 'level_basic')->first();
				if ( $status->value2 + $value >= 100 ) {
					$status->value2 = $status->value2 + $value - 100;
					$status->value1 = $status->value1 + 1;
					$status->save();
				} else {
					$status->value2 = $status->value2 + $value;
					$status->save();
				}
				break;

		}
	}
}
