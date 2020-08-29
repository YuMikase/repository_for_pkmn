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
        $user = Auth::user()->toArray();
        $matters = Matter::where('end_flag',false);

        if ( ! $matters->exists() || $matters->count() < 5 ) {
            ChatController::createMatter();
        }
        if ( ! UserHasItem::where('user_id', $user['id'])->exists() ) {
            UserHasItem::create([ 'item_id' => 101, 'user_id' => $user['id'] ]);
        }
        if ( ! UserStatuses::where('user_id', $user['id'])->exists() ) {
            UserStatuses::create([ 'type' => 'money', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_basic', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_php', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_python', 'user_id' => $user['id'] ]);
            UserStatuses::create([ 'type' => 'level_ruby', 'user_id' => $user['id'] ]);
        }
        $status = UserStatuses::where('user_id', $user['id'])->get();
        $matters = $matters->get()->toArray();

        $user = Auth::user()->with('has_item')->first();
        $items = config('item');
        return view('home', compact('matters', 'status', 'user', 'items'));
    }
}
