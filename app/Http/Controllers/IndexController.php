<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use MyFunc;
use Cookie;

class IndexController extends Controller
{
    //
    public function index(){
        //クッキーから取得
        $user_datas['name'] = Cookie::get('user_name');
        //すでに名前入っててたらマイページへ
        if(!empty($user_datas['name'])){
            //言語のデータを読み込む
            $lang_datas = config('const.LANG_DATAS');
            // return view('mypage', compact('user_datas','lang_datas'));
            return view('index');
        }

        return view('index');
    }
    //----------マイページ関連----------//
    public function mypage(){
        //ユーザー名が無かったらindexをviewする
        if(empty(Cookie::get('user_name'))){
            return view('index');
        }

        return view('mypage');
    }
    public function mypagepost(Request $req){

        //名前を取得。空なら適当に埋まる。
        $user_datas['name'] = MyFunc::check_name($req->name);
        //クッキーに保存しておく（60分）
        Cookie::queue('user_name', $user_datas['name'],60);

        //言語のデータを読み込む
        $lang_datas = config('const.LANG_DATAS');
        Log::info(__class__);
        Log::info($lang_datas);


        return view('mypage', compact('user_datas','lang_datas'));
    }


    public function logout(){
        //クッキーを削除
        Cookie::queue(Cookie::forget('user_name'));
        return view('index');
    }

    public function status(){
        //ユーザー名が無かったらindexをviewする
        if(empty(Cookie::get('user_name'))){
            return view('index');
        }

        //クッキーから取得
        $user_datas['name'] = Cookie::get('user_name');

        return view('status', compact('user_datas'));
    }
    public function items(){
        //ユーザー名が無かったらindexをviewする
        if(empty(Cookie::get('user_name'))){
            return view('index');
        }

        //クッキーから取得
        $user_datas['name'] = Cookie::get('user_name');


        return view('items', compact('user_datas'));
    }
    public function shop(){
        //ユーザー名が無かったらindexをviewする
        if(empty(Cookie::get('user_name'))){
            return view('index');
        }

        //クッキーから取得
        $user_datas['name'] = Cookie::get('user_name');


        return view('shop', compact('user_datas'));
    }
    //バトル画面テスト用コンtローラー0815
    public function battletest(){
      //ユーザー名が無かったらindexをviewする
      if(empty(Cookie::get('user_name'))){
          return view('index');
      }

      //クッキーから取得
      $user_datas['name'] = Cookie::get('user_name');


      return view('battle_matter_test2', compact('user_datas'));
    }
}
