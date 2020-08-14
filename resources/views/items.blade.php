@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','ITEMS')

    @section('header')
    @endsection


    @section('main')
    <div>Items</div>
    <h>Hello, {{ Cookie::get('user_name') }}</h>


    <ul>
      @foreach (Config::get('const.ITEM_DATAS') as $item)
          <li>{{ $item }}</li><button>USE</button></br>
      @endforeach
      </ul>
    @endsection

    @section('footer')
    @endsection


@endsection
