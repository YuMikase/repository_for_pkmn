{{-- @extends('layouts.common')

@section('content')

    @section('head')
    @section('title','INDEX')

    @section('header')
    @endsection

    @section('main')
    @endsection

    @section('footer')
    @endsection


@endsection --}}

<!DOCTYPE html>
<html>
  <head>
    <title>A1</title>
    <link rel="stylesheet" href="{{ asset('css/styleA1.css') }}">
  </head>
  <body>
      <div id="div1"> TITLE  </div>

      <form action="A2.html" methood="POST">
        <input type="text" id="name"></input>
        <button type="submit" id="play">PLAY</button>
      </form>


  </body>
</html>
