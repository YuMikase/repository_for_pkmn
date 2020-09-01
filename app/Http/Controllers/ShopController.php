<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\UserHasItem;
use App\UserStatuses;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ShopController extends Controller
{
    public function buy(Request $re) {
        $user = Auth::user();
        $items = config('item');
        UserHasItem::create([ 'item_id' => $re->item_id, 'user_id' => $user['id'] ]);
        $money = UserStatuses::where('user_id', $user['id'])->where('type', 'money')->first();
        $money->value1 = $money->value1 - $items[$re->item_id]['money'];
        $money->save();
    }

    public function use(Request $re) {
        $user = Auth::user();
        UserHasItem::where('item_id', $re->item_id)->where('user_id', $user['id'])->first()->delete();
    }

    public function getHasItems() {
        $user = Auth::user();
        $has_items = UserHasItem::where('user_id', $user['id'])->get();
        $items = config('item');
        $res = [];
        foreach ($items as $id => $item) {
            $res[$id] = $has_items->where('item_id', $id)->count();
        }
        return $res;
    }
    
    public function getHasMoney() {
        $user = Auth::user();
        return UserStatuses::where('user_id', $user['id'])->where('type', 'money')->first()->value1;
	}
}
