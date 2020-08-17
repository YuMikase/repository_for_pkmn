@extends('layouts.common')

@section('content')

@section('title','ポコモン HOME')
@section('head')

@section('header')

<div class="container-lg mx-auto bg-primary">pokomnn</div>
<!--一時的にジャンボトロン停止
    <div class="container jumbotron">
      <h1 class="glow in tlt">Pokomon</h1>
      <p class="tlt" data-in-effect="bounceInDown">
        Respect Pokemon
      </p>
    </div>
-->
@endsection

@section('main')




<div class="container-md">
  <p>簡易プレイ(ユーザ登録なし)と登録してプレイボタン</p>
  <p>簡易プレイはmypage画面に、登録プレイボタンはHomeに以降</p>
  <div class="row">
    <div class="col-10 col-md-offset-1">
      <form action="{{ url('mypage') }}" method="post"　class="w-70 p-3 inline">
          @csrf
          <input type="text" class="form-control inline" name="name" placeholder="名前を入力してくdしあ">
          <input type="submit" class="float-right inline" value="お試しプレイ">
      </form>
    </div>
  </div>

</div>

<div class="container-md">
  <p>---homeにジャンプ---</p>
  <form action="{{ url('home') }}" method="get">
      @csrf
        <input type="submit" class="col-4" value="登録メソッドをgetにかえた">
  </form>
</div>

@endsection

@section('footer')
@endsection


@endsection
