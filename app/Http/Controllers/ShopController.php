<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\UserHasItem;

class ShopController extends Controller
{
    public function index() {
        $user = Auth::user()->with('has_item')->first();
        $items = config('item');
        return view('shop',compact('user', 'items'));
    }
    
    public function buy(Request $re) {
        $user = Auth::user()->with('has_item')->first();
        $items = config('item');
        UserHasItem::create([ 'item_id' => $re->item_id, 'user_id' => $user['id'] ]);
    }

    public function getHasItems($user_id) {
        $has_items = Auth::user()->has_item;
        $items = config('item');
        $res = [];
        foreach ($items as $id => $item) {
            $res[$id] = $has_items->where('item_id', $id)->count();
        }
        return $res;
	}
}
