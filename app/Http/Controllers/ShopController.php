<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
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
        $money = UserStatuses::where('user_id', $user['id'])->where('type', 'money')->first();
        $money->value1 = $money->value1 - $items[$re->item_id]['money'];
        $money->save();
    }

    public function use(Request $re) {
        $user = Auth::user();

        $has = UserHasItem::where('user_id', $user['id'])->where('item_id', $re->item_id)->first();
        $has->has = $has->has - 1;
        $has->save(); 
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
