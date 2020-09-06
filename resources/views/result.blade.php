@extends('layouts.app')

@section('content')

<h3>戦績一覧</h1>

<div class="col-12 overflow-auto" style="height:700px" >
  @foreach ($messages as $message)
    <!-- 登録された日時 -->
    <span>{{$message['created_at']}}</span>：&nbsp;
    <!-- メッセージ内容 -->
    user_name:<span>{{$message['user_name']}}</span><br>
    <!-- メッセージ内容 -->
    <span>{{$message['body']}}</span>
    <hr style="border:0;border-top:1px solid blue;">
  @endforeach
</div>
<button class="col m-1 btn  btn-info" type="button" name="button" onclick="location.href='/'">案件を終了する。</button>
@endsection
