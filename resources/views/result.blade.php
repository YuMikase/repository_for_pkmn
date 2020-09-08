@extends('layouts.app')

@section('content')

<div class="row border mt-1">
	    <div class="col">
	    	@foreach ($message as $m)
	        <!-- 登録された日時 -->
	        <span class="row" style="font-size: 4px"></span>
	        <!-- メッセージ内容 -->
	        <span class="row">{{$m['body']}}</span>
	        @endforeach
	    </div>
</div>
@endsection