@extends('layouts.app')

@section('content')

<h3>戦績一覧</h1>

<div class="col-12 overflow-auto" style="height:600px" >
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
<footer class="footer">
  <div class="container">
    <button class="col m-1 btn  btn-primary" type="button" name="button" onclick="location.href='/'">案件を終了する。</button>
  </div>
</footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
