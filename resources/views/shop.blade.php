@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','SHOP')

    @section('header')
    @endsection

    @section('main')
    <div>Shop</div>
    <div>￥</div>
    <p>Hello,{{ $user_datas['name'] }}</p>

      <ul>
      @foreach ($item_datas as $item)
          <li>{{ $item }}</li><button>BUY</button></br>
      @endforeach
      </ul>
    @endsection

    @section('footer')
    @endsection


@endsection