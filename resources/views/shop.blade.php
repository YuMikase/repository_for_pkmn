@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','SHOP')

    @section('header')
    @endsection

    @section('main')
    <div>Shop</div>
    <div>￥</div>
    <h>Hello, {{ Cookie::get('user_name') }}</h>


      <ul>
      {{-- アイテム一覧表示 --}}
      @foreach (Config::get('const.ITEM_DATAS') as $item)
          <li>{{ $item }}</li><button>BUY</button></br>
      @endforeach
      </ul>
    @endsection

    @section('footer')
    @endsection


@endsection