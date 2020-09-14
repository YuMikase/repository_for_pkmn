@extends('layouts.common')

@section('content')

@section('title','ポコモン HOME')
@section('head')

@section('header')

<div class="container-lg mx-auto bg-primary">pokomnn</div>

    <div class="container jumbotron">
      <h1 class="glow in tlt">Pokomon</h1>
      <p class="tlt" data-in-effect="bounceInDown">
        Respect Pokemon
      </p>
    </div>

@endsection

@section('main')




<div class="container-md bg-info">
  <form action="{{ url('mypage') }}" method="post">
      @csrf
      <label for="Entername" >Enter Yourname</label>
      <div class="row">
        <input type="text" class="form-control col-6" name="name" placeholder="Enter email">
        <input type="submit" class="col-1 float-right" value="PLAY">
    </div>
  </form>
</div>

@endsection

@section('footer')
@endsection


@endsection
