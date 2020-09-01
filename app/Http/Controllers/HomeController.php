<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Matter;
use App\UserHasItem;
use App\UserStatuses;
use App\Http\Controllers\Ajax\ChatController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        //不足分を作成
        if ( Matter::where('end_flag',false)->count() < 5 ) {
            ChatController::createMatter();
        }
        $items = config('item');
        foreach($items as $id => $item) {
            if ( UserHasItem::where('user_id', $user['id'])->where('item_id', $id)->doesntExist() ) {
                if ( $id === 101 ) {
                    UserHasItem::create([ 'item_id' => $id, 'user_id' => $user['id'], 'has' => 1 ]);
                } else {
                    UserHasItem::create([ 'item_id' => $id, 'user_id' => $user['id'] ]);
                }
            }
        }
        if ( ! UserStatuses::where('user_id', $user['id'])->exists() ) {
            UserStatuses::create([ 'type' => 'money', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_basic', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_php', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_python', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_ruby', 'user_id' => $user['id'] ]);
        }

        //補充後改めて取得
        $matters = Matter::withCount('users')->where('end_flag',false)->get();
        $status = UserStatuses::where('user_id', $user['id'])->get();
        
        return view('home', compact('user', 'matters', 'status', 'items'));
    }
}
