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

        //セッションに名前を保存
        session(['user_name' => $req->name]);
        //セッションから名前をセット（空なら【 名無し 】になる）
        $user_datas['name'] = MyFunc::check_name(session('user_name'));

        //言語のデータを読み込む
        $lang_datas = config('const.LANG_DATAS');
        Log::info(__class__);
        Log::info($lang_datas);


        return view('mypage', compact('user_datas','lang_datas'));
    }
    public function status(){

        //セッションから名前をセット（空なら【 名無し 】になる）
        $user_datas['name'] = MyFunc::check_name(session('user_name'));

        return view('status', compact('user_datas'));
    }
    public function items(){

        //セッションから名前をセット（空なら【 名無し 】になる）
        $user_datas['name'] = MyFunc::check_name(session('user_name'));

        //アイテムのデータを読み込む
        $item_datas = config('const.ITEM_DATAS');

        return view('items', compact('user_datas','item_datas'));
    }
    public function shop(){
        
        //セッションから名前をセット（空なら【 名無し 】になる）
        $user_datas['name'] = MyFunc::check_name(session('user_name'));

        //アイテムのデータを読み込む
        $item_datas = config('const.ITEM_DATAS');

        return view('shop', compact('user_datas','item_datas'));
    }
}
