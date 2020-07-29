@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','A2')

    @section('header')
    @endsection

    @section('main')
    <div class="div1">TITLE</div>
<p class="name">Hello,{{$req_datas['name']}}</p>
    <select name="roomSelect" form="room" class="select">
      <option value="javascript">javascript</option>
      <option value="PHP">PHP</option>
      <option value="Python">Python</option>
    </select>
    <form method="POST" action="E2.html" class="room enter">
      <input type="submit" onclick="location.href='./E2.html'"value="Enter" >
    </form >
  </div>
      <div class="clearfix"></div>
      <div class="div2">
        <div class="div2_1">
            <p class="status" ><a href="./index.html">Status<a></p>
            <p class="level">Level:##</p>
            <p class="money">Money:##</p>
            <p class="skill">skill</p>
        </div>
        <div class="div2_2">
              <p class="langLevel">Your Lang Lv.</p>
              <p class="javascriptLv">javascript:#</p>
              <p class="PHPLv">PHP:#</p>
              <p class="PythonLv">Python:#</p>
        </div>
</div>
      <div class="menu">
        <p>Items</p>
        <input type="button" onclick="location.href='./C1.html'" value="Use your Item">
        <input type="button" onclick="location.href='./D1.html'" value="Go shopping">
      </div>
    @endsection

    @section('footer')
    @endsection


@endsection


