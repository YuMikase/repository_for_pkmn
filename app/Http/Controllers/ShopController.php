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
        $user = Auth::user();

        $has = UserHasItem::where('user_id', $user['id'])->where('item_id', $re->item_id)->first();
        $matter = Matter::find($re->matter_id);

        $item = config('item')[$re->item_id];

        $has->has = $has->has - 1;
        $has->save(); 

        //アイテム仕様処理
        $matter->progress += $item['progress'];
        $matter->barning += $item['barning'];

        $matter->save();

        $user_name = Auth::user()->name;

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
