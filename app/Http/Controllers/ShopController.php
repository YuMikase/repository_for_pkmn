<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\UserHasItem;

class ShopController extends Controller
{
    //
    public function index() {
        $user = Auth::user()->with('has_item')->first();
        $items = config('item');
        return view('shop',compact('user', 'items'));
	}
}
