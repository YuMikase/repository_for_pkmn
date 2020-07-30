<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use MyFunc;

class IndexController extends Controller
{
    //
    public function index(){
        return view('index');
    }
    public function mypage(){
        return view('mypage');
    }
    public function mypagepost(Request $req){

        $req_datas['name'] = $req->name;

        //言語のデータを読み込む
        $lang_datas = config('const.LANG_DATAS');
        Log::info(__class__);
        Log::info($lang_datas);
        

        //空（empty）なら【 無 】にする
        $req_datas = MyFunc::fill_empty($req_datas);
        
        Log::info(__class__);
        Log::info($req_datas);
        
        

        
        return view('mypage', compact('req_datas','lang_datas'));
    }
    public function status(){
        return view('status');
    }
    public function items(){
        return view('items');
    }
    public function shop(){
        return view('shop');
    }
}
