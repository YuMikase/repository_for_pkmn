@extends('layouts.common')

@section('content')

@section('title','ポコモン HOME')
@section('head')

@section('header')
<h>ポコモン</h>
@endsection

@section('main')


<form action="{{ url('mypage') }}" method="post">
  @csrf
  <input type="text" class="name" name="name" >
  <input type="submit" class="play" value="PLAY">
</form>

@endsection

@section('footer')
@endsection


@endsection


