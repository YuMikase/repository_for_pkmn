@extends('layouts.common')

@section('content')

@section('head')
@section('title','MY PAGE')

@section('header')
  <h>ポコモン</h>
  <p>Hello,{{$user_datas['name']}}</p>
@endsection

@section('main')

<div class="grid_mypage">
  <button class="enter_button">
    <a href="{{ url('chat') }}">案件に参加</a>
  </button>
  
  <div class="status">
      <h3>Status</h3>
      <button class="status_button">
        <a href="{{ url('status') }}">Check your status detail</a>
      </button>
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

@endsection

@section('footer')
@endsection


@endsection


