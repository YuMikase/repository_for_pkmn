@extends('layouts.app')

@section('content')

<h3>報酬順位一覧</h1>

<div class="col-12 overflow-auto" style="height:600px" >
  @foreach ($users as $user)
    <span class="h2">{{$user['name']}}は ${{$user['money']}}獲得です！</span><br>
    <hr style="border:0;border-top:1px solid red;">
    <br>
    <br>
    <br>
  @endforeach
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
