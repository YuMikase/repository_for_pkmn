@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','ITEMS')

    @section('header')
    @endsection

    @section('main')
    <div>Items</div>
    <p>Hello,{{ $user_datas['name'] }}</p>

    <ul>
      @foreach ($item_datas as $item)
          <li>{{ $item }}</li><button>USE</button></br>
      @endforeach
      </ul>
    @endsection

    @section('footer')
    @endsection


@endsection
