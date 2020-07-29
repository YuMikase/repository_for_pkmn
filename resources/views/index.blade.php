@extends('layouts.common')

@section('content')

@section('title','A1')
@section('head')

@section('header')
@endsection

@section('main')

<div class="div1">ポコモン</div>

<form action="{{ url('a2') }}" method="post">
  @csrf
  <input type="text" class="name" name="name" >
  <input type="submit" class="play" value="PLAY">
</form>

@endsection

@section('footer')
@endsection


@endsection


