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
        $user = Auth::user();

        //不足分を作成
        if ( Matter::where('end_flag',false)->count() < 5 ) {
            $rate_type = config('rate_type');
            $attack_type = config('attack_type');
            $data = [
                'skill_count' => 0,
                'barning' => 0,
                'progress' => 0,
                'time' => 0,
                'barning_limit' => rand(100, 1000),
                'progress_limit' => rand(100, 1000),
                'time_limit' => rand(10, 20),
                'rate_type' => array_rand($rate_type),
                'attack_type' => array_rand($attack_type),
            ];

            Matter::create($data);
        }
        $items = config('item');
        foreach($items as $id => $item) {
            if ( UserHasItem::where('user_id', $user['id'])->where('item_id', $id)->doesntExist() ) {
                    UserHasItem::create([ 'item_id' => $id, 'user_id' => $user['id'] ]);
            }
        }

        //補充後改めて取得
        $matters = Matter::withCount('users')->where('end_flag',false)->get();

        $langSkills = UserLangSkill::where('user_id', Auth::user()->id)->get()->toArray();

        return view('home', compact('user', 'matters', 'langSkills', 'items'));
    }
    //以下、タイトルへのルーティングのために追加
    public function title()
    {
        return view('title');
    }

}
