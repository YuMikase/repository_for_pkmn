<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Events\MessageCreated;
use App\Matter;
use App\Messages;
use App\UserHasItem;
use App\UserStatuses;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use Log;
class ShopController extends Controller
{
    public function buy(Request $re) {
        $user = Auth::user();
        
        $has = UserHasItem::where('user_id', $user['id'])->where('item_id', $re->item_id)->first();
        $has->has = $has->has + 1;
        $has->save();
        
        $items = config('item');
        $user->money -= $items[$re->item_id]['money'];
        $user->save();
    }

    public function use(Request $re) {
        $commands = config('command');
        $user = Auth::user();
        $user_name = Auth::user()->name;
        $item = config('item')[$re->item_id];

        $matter = Matter::find($re->matter_id);

        Log::debug($matter->barning + $item['barning']);

        //アイテム使用処理
        if($matter->barning + $item['barning'] >= 0){
            $has = UserHasItem::where('user_id', $user['id'])->where('item_id', $re->item_id)->first();
            $matter->progress += $item['progress'];
            $matter->barning += $item['barning'];
            $has->has = $has->has - 1; 
            //コマンドシャッフル実装。
            $rand_commands = array_rand($commands, 4);
            shuffle($rand_commands);
            $user = Auth::user();
            $user->skill1  = $rand_commands[0];
            $user->skill2  = $rand_commands[1];
            $user->skill3  = $rand_commands[2];
            $user->skill4  = $rand_commands[3];
            $user->save();


            //コミット
            $has->save();
            $matter->save();
            $message = Messages::create([
                'matter_id' => $re->matter_id,
                'body' => $user_name."は".$item['name'].'を使った。',
                'user_name' => $user_name,
                'type' => "item"
            ]);

            $message = Messages::create([
                'matter_id' => $re->matter_id,
                'body' => $user_name.$item['message'],
                'user_name' => $user_name,
                'type' => "effect"
            ]);
        }else{
            $message = Messages::create([
            'matter_id' => $re->matter_id,
            'body' => $user_name."は".$item['name'].'を使えなかった。',
            'user_name' => $user_name,
            'type' => "item"
            ]);
        }
            

        event(new MessageCreated($message));

    }

    public function getHasItems() {
        $user = Auth::user();
        $has_items = UserHasItem::where('user_id', $user['id'])->get();
        $items = config('item');
        $res = [];
        foreach ($items as $id => $item) {
            $res[$id] = $has_items->where('item_id', $id)->first()->has;
        }
        return $res;
    }
    
    public function getHasMoney() {
        Log::debug(Auth::user()->money);
        return Auth::user()->money;
	}
}
