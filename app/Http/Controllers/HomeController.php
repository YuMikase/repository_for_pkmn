<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Matter;
use App\UserHasItem;
use App\UserStatuses;
use App\UserLangSkill;
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
        $matters = Matter::whereColumn('time', '<', 'time_limit')->get()->toArray();
        $lang = config('lang');

        for ($i = count($matters); $i <= 5; $i++) {
            $hour = rand(10, 20);
            Matter::create([ 
                'skill_count' => 0,
                'barning' => 0,
                'progress' => 0,
                'time' => 0,
                'barning_limit' => $hour * 5,
                'progress_limit' => $hour * 10,
                'time_limit' => $hour,
                'rate_type' => 0,
                'attack_type' => 0,
                'matter_lang' => $lang[array_rand($lang)],
            ]);
        }
        if ( ! UserHasItem::where('user_id', $user['id'])->exists() ) {
            UserHasItem::create([ 'item_id' => 101, 'user_id' => $user['id'] ]);
        }

        $items = config('item');
        $langSkills = UserLangSkill::where('user_id', Auth::user()->id)->get()->toArray();
        return view('home', compact('matters', 'langSkills', 'user', 'items'));
    }
}
