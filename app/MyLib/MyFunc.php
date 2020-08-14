<?php

namespace App\MyLib;

use Log;
use Cookie;

class MyFunc
{
    //配列の各要素の空のものに【 無 】を入れる
    public static function fill_empty($datas){
        foreach($datas as $key => $value){
            if(empty($value)){
                $datas[$key] = "【 無 】";
            }
        }
        return $datas;
    }

    //userなどnameをチェックし、空なら適当に埋める
    public static function check_name($name)
    {
        if (empty($name)) {
            //適当な名前一覧からランダムに付ける
            $equations = config('const.EQUATIONS');
            $eq = $equations[array_rand($equations)];
            $name = "名無しの ".$eq;
        }

        return $name;
    }

    

}