@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','C1')

    @section('header')
    @endsection

    @section('main')
    <div class="div1">Items</div>
    <p class="name">Hello,####</p>
    <div class="div2">
      <p>Item1:(アイテム名) <button value="use" class="Itemuse">[Use]</button></br>
      　　(説明)</p>
      <p>Item2:(アイテム名) <button value="use" class="Itemuse">[Use]</button></br>
      　　(説明)</p>
      <p>Item3:(アイテム名) <button value="use" class="Itemuse">[Use]</button></br>
      　　(説明)</p>
      <p>Item4:(アイテム名) <button value="use" class="Itemuse">[Use]</button></br>
      　　(説明)</p>
    </div>
    @endsection

    @section('footer')
    @endsection


@endsection
