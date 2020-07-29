<!DOCTYPE html>
<html>
  <header>
    <title>B1</title>
    <link rel="stylesheet" href="{{ asset('css/styleB1.css') }}">
  </header>
  <body>
    

  </body>
</html>


@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','B1')

    @section('header')
    @endsection

    @section('main')
    <div class="div1">Status</div>
    <p class="name">Hello,####</p>
    <div class="div2">
      <p>現在のLv.#</p>
      <p>　　レブルアップまで＃＃</p>
      <p>Money ####</p>
      <p>Skill.##</p>
      <ul>
        <li>Skill 1:#############</li>
        <li>Skill 2:#############</li>
      </ul>
    </div>
    @endsection

    @section('footer')
    @endsection


@endsection
