@extends('layouts.common')

@section('content')

@section('head')
@section('title','MY PAGE')

@section('header')
  <h>ポコモン</h>
  <h>Hello, {{ $user_datas['name'] }}</h>
@endsection
  


@section('main')

@section('logout')
@endsection

<div class="grid_mypage">
  <button class="enter_button">
    <a href="{{ url('chat') }}">案件に参加</a>
  </button>
  
  <div class="status">
      <h3>Status</h3>
      
        <a href="{{ url('status') }}"><button class="status_button">Check your status detail</button></a>
      
      <p>Level:</p>
      <p>Money:</p>
      <p>Your Lang Lv.</p>
      <div class="langs">
        <p>javascript:</p>
        <p>PHP:</p>
        <p>Python:</p>
      </div>
  </div>

  <div class="item">
    <h3>Items</h3>
    <button class="enter_button">
      <a href="{{ url('items') }}">'Use your Item'</a>
    </button>
    <button class="enter_button">
      <a href="{{ url('shop') }}">'Go shopping'</a>
    </button>
  </div>
</div>

  <div class="container">
    <div class="col-lg-12" style="text-align: center; margin-top: 10px;">
      <span class="test1" style="font-size: 26px;">案件に参加</span>
    </div>
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="textillate/jquery.fittext.js"></script>
<script src="textillate/jquery.lettering.js"></script>
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script>
<script src="textillate/jquery.textillate.js"></script>

<script>
$(function() {
    $('.test1').textillate({
      loop: true,  
      minDisplayTime: 2000,  
      initialDelay: 500,  
      autoStart: true,  
  
      // アニメーション設定(開始)
      in: {
        effect: 'flash',  
        delayScale: 3,  
        delay: 50,  
        sync: false,  
        shuffle: false
      },  
  
      // アニメーション設定(終了)
      out: {
        effect: 'bounce',  
        delayScale: 2,  
        delay: 45,  
        sync: false,  
        shuffle: false
      }
    });
});

</script>

@endsection

@section('footer')
@endsection


@endsection


