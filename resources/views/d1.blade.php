@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','D1')

    @section('header')
    @endsection

    @section('main')
    <div class="div1">Shop</div>
    <div class="money">￥####</div>
    <p class="name">Hello,####</p>
    <div class="div2">
  
      <p>Item1:(アイテム名) [￥###]<button value="buy" class="Itembuy">[buy]</button></br>
      　　(説明)</p>
      <p>Item2:(アイテム名) [￥###]<button value="buy" class="Itembuy">[buy]</button></br>
      　　(説明)</p>
      <p>Item3:(アイテム名) [￥###]<button value="buy" class="Itembuy">[buy]</button></br>
      　　(説明)</p>
      <p>Item4:(アイテム名) [￥###]<button value="buy" class="Itembuy">[buy]</button></br>
      　　(説明)</p>
    </div>
    @endsection

    @section('footer')
    @endsection


@endsection