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
    public function a2(){
        return view('a2');
    }
    public function a2post(Request $req){

        $req_datas['name'] = $req->name;
        
        

        //空（empty）なら【 無 】にする
        $req_datas = MyFunc::fill_empty($req_datas);
        
        Log::info(__class__);
        Log::info($req_datas);
        
        

        
        return view('a2', compact('req_datas'));
    }
    public function b1(){
        return view('b1');
    }
    public function c1(){
        return view('c1');
    }
    public function d1(){
        return view('d1');
    }
    public function e2(){
        return view('e2');
    }
}
