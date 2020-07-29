@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','A1')

    @section('header')
    @endsection

    @section('main')
    <div class="div1">ポコモン</div>

      <form action="A2.html" methood="POST">
        <input type="text" class="name"></input>
        <button type="submit" class="play">PLAY</button>
      </form>
    @endsection

    @section('footer')
    @endsection


@endsection


