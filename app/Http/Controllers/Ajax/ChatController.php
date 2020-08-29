<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use App\Events\MatterEnded;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Matter;
use App\UserStatuses;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
	public function index($id) {// 新着順にメッセージ一覧を取得
	    return \App\Message::where('matter_id',$id)->orderBy('id', 'desc')->get();

	}

	public function create(Request $request) {

	    $message = \App\Message::create([
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
			$commands[$input_command]['time'] * $rate_type['time'][$commands[$input_command]['lang']]
		);

		$attack = config('attack_type')[$matter['attack_type']]['terms'];
		if ( ! empty( $attack[$matter->time] ) ) {
			self::addMatterStatus(
				$id,
				$attack[$matter->time]['barning'],
				$attack[$matter->time]['progress']
			);
			$message = \App\Message::create([
				'matter_id' => $id,
				'body' => $attack[$matter->time]['message'],
				'user_name' => "案件",
				'type' => "normal"
			]);
			event(new MessageCreated($message));
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

		$status = UserStatuses::where('user_id', $user->id)->get();
		$money = $status->where('type', 'money')->first();
		$money->value1 = round( ( ($money->value1+100) * 1.01 ) - 100);
		$money->save();


	    $message = \App\Message::create([
	    	'matter_id' => $id,
	        'body' => $request->message,
	        'user_name' => $request->user_name,
	        'type' => "normal"
	    ]);
		event(new MessageCreated($message));
		
		if( $matter->time >= $matter->time_limit) {
			$matter->end_flag = 1;
			$matter->save();
			self::createMatter();
			$money->value1 = $money->value1 + $rate_type['reward']['money'];
			$money->save();
			$ex_basic = $status->where('type', 'level_basic')->first();
			switch ($rate_type['name']) {
				case 'PHP':
					$ex_lang = $status->where('type', 'level_php')->first();
					break;
				case 'Python':
					$ex_lang = $status->where('type', 'level_python')->first();
					break;
				case 'Ruby':
					$ex_lang = $status->where('type', 'level_ruby')->first();
					break;
				case 'ふつう':
					$ex_lang = $status->where('type', 'level_basic')->first();
					break;
			}
			$ex_basic->value2 = $ex_basic->value2 + $rate_type['reward']['ex'];
			$ex_basic->save();
			if ( $ex_basic->value2 >= 100 ) {
				$ex_basic->value2 = $ex_basic->value2 - 100;
				$ex_basic->value1 = $ex_basic->value1 + 1;
			}
			$ex_basic->save();
			$ex_lang->value2 = $ex_lang->value2 + $rate_type['reward']['ex'];
			$ex_lang->save();			
			if ( $ex_lang->value2 >= 100 ) {
				$ex_lang->value2 = $ex_lang->value2 - 100;
				$ex_lang->value1 = $ex_lang->value1 + 1;
			}
			$ex_lang->save();
			event(new MatterEnded($matter));
		}

	}
	public function index_bar($matter_id) {// ユーザーのコマンドを取得
		$bars = \App\Matter::find($matter_id);
		return [ floor($bars['barning'] / $bars['barning_limit'] * 100),
				floor($bars['progress'] / $bars['progress_limit'] * 100),
				floor($bars['time'] / $bars['time_limit'] * 100),
		];
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
}
