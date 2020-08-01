@extends('layouts.common')

@section('content')

@section('title','ポコモン HOME')
@section('head')

@section('header')
<h>ポコモン</h>

    <div class="container jumbotron">
      <h1 class="glow in tlt">Pokomon</h1>
      <p class="tlt" data-in-effect="bounceInDown">
        Respect Pokemon
      </p>
    </div>

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


