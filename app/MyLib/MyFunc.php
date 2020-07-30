<?php

namespace App\MyLib;

use Log;

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

}