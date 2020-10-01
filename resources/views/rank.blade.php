@extends('layouts.app')

@section('content')

<h3>報酬順位一覧</h1>

<div class="col-12 overflow-auto" style="height:600px" >
  @foreach ($users as $user)
    <span>{{$user['name']}}は${{$user['money']}}獲得です！</span><br>
    <hr style="border:0;border-top:1px solid red;">
  @endforeach
</div>
<footer class="footer">
  <div class="container">
    <button class="col m-1 btn  btn-primary" type="button" name="button" onclick="location.href='/'">案件を退出する。</button>
  </div>
</footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
