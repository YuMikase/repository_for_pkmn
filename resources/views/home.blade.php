@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン画面</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif
                    ログインしました
                    <p>{{ Auth::user()->name }}</p>
                    <div>
                      <form action="{{ url('mypage') }}" method="post"　class="w-70 p-3 inline">
                          @csrf
                          <input type="submit" class="float-right inline" value=" マイページへ">
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
