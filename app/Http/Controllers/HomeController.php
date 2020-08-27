<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Matter;
use App\UserHasItem;
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
        $matters = $matters->get()->toArray();
        return view('home', compact('matters'));
    }
}
