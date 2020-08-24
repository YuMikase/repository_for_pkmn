@extends('layouts.app')

@section('content')
<!--酢黒る-->
<div class="contaienr py-3">
  <div class="row justify-content-center">
    <div class="col-10 border border-primary">
      <div style="height:300px;" class="overflow-auto" >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">案件</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="Navbar">
        <ul class="nav nav-pills flex-column flex-lg-row ml-auto">
          <li class="nav-item"><a class="nav-link active" href="#matter1">案件１</a></li>
          <li class="nav-item"><a class="nav-link" href="#matter2">案健２</a></li>
          <li class="nav-item dropdown">
    <!--      <li class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ドロップダウン</a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#menu1">メニュー1</a>
              ...
            </div></li>-->
          <li class="nav-item"><a class="nav-link" href="#matter3">案件3</a></li>
          <li class="nav-item"><a class="nav-link" href="#matter3">案件4</a></li>
        </ul>
      </div>
    </nav>
    <div class="container overflow-auto"data-spy="scroll" data-target="#Navbar">
      <div id="matter1" class="border">
        <h3>案件１</h3>
        <p>
          案件１：詳細情報  <button type="button" class="btn btn-primary">参加</button>
        </p>
      </div>
      <div id="matter2" class="border">
        <h3>案件2</h3>
        <p>
          案件2：詳細情報<button type="button" class="btn btn-primary">参加</button>
        </p>
      </div>
      <div id="matter3" class="border">
        <h3>案件3</h3>
        <p>  案件3：詳細情報<button type="button" class="btn btn-primary">参加</button></p>
      </div>
      <div id="matter4" class="border">
        <h3>案件4</h3>
        <p>
          案件4：詳細情報<button type="button" class="btn btn-primary">参加</button>
        </p>
      </div>
    </div>
  </div>
    </div>
  </div>
</div>

<div class='container'>
  <div class='row justify-content-md-center w-100'>
    <div class='col-6  border border-primary'>
        <div class="status">
            <h3>あなたのステータス</h3>
            <p>Level:</p>
            <p>Money:</p>
            <p>Your Lang Lv.</p>
            <div class="langs">
              <p>javascript:</p>
              <p>PHP:</p>
              <p>Python:</p>
            </div>
        </div>
    </div>
    <div class='col-6  border border-primary'>
        <div class="item h-100">
          <h3>Items</h3>
          <button class="enter_button">
            <a href="{{ url('shop') }}">'Go shopping'</a>
          </button>
          <!--
          のちのちここにアイテムリストを表示、クリックで使用できるように
        -->
        </div>
    </div>
  </div>
</div>

  <div class="container">
    <div class="col-lg-12" style="text-align: center; margin-top: 10px;">
      <span class="test1" style="font-size: 26px;">案件に参加</span>
    </div>
  </div>
<!--
  <div class="container">
     画像と背景・文字を配置
    <div class="bg-pic">
      <div class="pic" style="background-image : url('https://images.unsplash.com/photo-1519221739757-4df89b4d0efe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80');">
        <div class="screen one"></div>
         背景１段目
        <div class="screen two"></div>
         背景２段目
        <div class="fonts">
          <h1>Malta's Building</h1>
          <p>this is a photo in malta <br><br><br>Have A Good Time</p>
        </div>
      </div>
    </div>
  </div>
-->

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
