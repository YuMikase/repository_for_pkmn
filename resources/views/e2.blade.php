@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','E2')

    @section('header')
    @endsection

    @section('main')
    <div class="time">
      time
    </div>
    <div class="gauge">
      Progress(jQueryかなんかである？bootstrap?)</br>
       Burning(jQueryかなんかである？bootstrap?)
    </div>
    <div class="Enemy_img">
      Enemyの画像
    </div>
    <div class="Player_img">
      Playerの画像＃この画像ってプレーヤーが用意するんですかね
    </div>
    <div class="runtime">Run Time</div>
    <div class="Attack_Container">
      <div class="attack_foreach Itembuy"><button value="attack">[for each]</button></div>
      <div class="attack_while Itembuy"><button value="attack">[for each]</button></div>
　    <div class="attack_switch Itembuy"><button value="attack">[for each]</button></div>
      <div class="attack_format Itembuy"><button value="attack">[for each]</button></div>
      <div class="clearfix"></div>
    　<div class="Console Itembuy"><button value="attack">[for each]</button></div>
    </div>
    <div id="Action_Container">
      <ul>
        <li><button value="attack" class="Itembuy">たたかう</button></li>
        <li><button value="attack" class="Itembuy">デバッグ</button></li>
        <li><button value="attack" class="Itembuy">アイテム</button></li>
        <li><button value="attack" class="Itembuy">にげる</button></li>
      </ul>
    @endsection

    @section('footer')
    @endsection


@endsection