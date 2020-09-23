@extends('layouts.app')

<style>
  :root {
    --color-text:#191970;
    --color-back:#fffacd;
    --color-point:#e76133;
  }
  .noMoney {
    text-decoration: line-through;
    color: red;
  }
</style>

@section('content')
<<<<<<< HEAD
<!--
<div class="contaienr py-3">
  <div class="row justify-content-center">
    <div class="col-10 border" style="background-color:#f3c35c;">
      <div style="height:300px;" class="overflow-auto" style="background-color:#e76133;">
    <nav class="navbar navbar-expand-lg" style="background-color:#e76133;">
      <a class="navbar-brand" href="#">案件</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="Navbar">
        <ul class="nav nav-pills flex-column flex-lg-row ml-auto">
          <li class="nav-item"><a class="nav-link active" href="#matter1">案件１</a></li>
          <li class="nav-item"><a class="nav-link" href="#matter2">案健２</a></li>
          <li class="nav-item dropdown">
      <li class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ドロップダウン</a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#menu1">メニュー1</a>
              ...
            </div></li>
                      <li class="nav-item"><a class="nav-link" href="#matter3">案件3</a></li>
          <li class="nav-item"><a class="nav-link" href="#matter3">案件4</a></li>
        </ul>
      </div>
    </nav>
    <div class="container overflow-auto"data-spy="scroll" data-target="#Navbar" >
      @foreach ($matters as $matter)
        <div id="matter{{ $matter['id'] }}" class="border">
          <h3>案件{{ $matter['id'] }} ( {{ config('rate_type')[$matter['rate_type']]['name'] }}の案件 ) </h3>
          <p>
            案件{{ $matter['id'] }}：
            工数【 {{ $matter['time'] }} / {{ $matter['time_limit'] }} ( {{ floor($matter['time'] / $matter['time_limit'] * 100) }} % ) 】
            進捗【{{ $matter['progress'] }} / {{ $matter['progress_limit'] }} ( {{ floor($matter['progress'] / $matter['progress_limit'] * 100) }} % ) 】
            <button type="button" class="btn btn-primary"><a href="chat/doteki/{{ $matter['id'] }}">参加</a></button>
          </p>
        </div>
      @endforeach
    </div>
  </div>
    </div>
=======

{{-- カルーセル --}}
<div id="carousel" class="carousel slide" data-ride="carousel" style="width:800px; height:500px; margin:30px auto;">
  {{-- インジケーター --}}
  <ol class="carousel-indicators">
    @for ($i = 0; $i < count($matters); $i++)
        @if ( $i === 0 )
          <li data-target="#carousel" data-slide-to="{{ $i }}" class="active"></li>  
        @else
          <li data-target="#carousel" data-slide-to="{{ $i }}"></li>            
        @endif
    @endfor
  </ol>
  {{-- 中身 --}}
  <div class="carousel-inner">
    @for ($i = 0; $i < count($matters); $i++)
        @if ( $i === 0 )
          <div class="carousel-item active">
        @else
          <div class="carousel-item">
        @endif
            <img class="d-block w-100 h-100" src="{{ asset('img/matter/'.$matters[$i]['rate_type'].'.jpg')}}" alt="IMAGE">
            {{-- キャプション --}}
            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.5)">
              <h5>No. {{ $matters[$i]['id'] }}　　{{ config('rate_type')[$matters[$i]['rate_type']]['name'] }}の案件</h5>
              <div class="m-3">
                <span class="m-1 badge badge-light" style="float:left;">工数</span>
                <div class="m-1 progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width:{{ round($matters[$i]['time'] / $matters[$i]['time_limit'] * 100) }}%" aria-valuenow="{{ round($matters[$i]['time'] / $matters[$i]['time_limit'] * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <br>
                <span class="m-1 badge badge-light" style="float:left;">進捗</span>
                <div class="m-1 progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width:{{ round($matters[$i]['progress'] / $matters[$i]['progress_limit'] * 100) }}%" aria-valuenow="{{ round($matters[$i]['time'] / $matters[$i]['time_limit'] * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <a href="/chat/doteki/{{ $matters[$i]['id'] }}"><button type="button" class="btn" style="color:var(--color-back); background-color:var(--color-point);">参加</button></a>
            </div>
          </div>
    @endfor
>>>>>>> b26c3207feafafa86a66de82cf48de98682b03ec
  </div>
  {{-- 前後のリンク --}}
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
-->
<!--カルーセル仮設置-->
<div class="container mb-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
          @foreach ($matters as $matter)
            <li data-target="#carouselExampleIndicators" data-slide-to= $matter['id'] class="active"></li>
          @endforeach
      </ol>
        <div class="carousel-inner bg-secondary">
          <!--foreachでmatterごとにカルーセルを出したい-->
          @foreach ($matters as $matter)
            @if ($matter['id']==1)
                <div class="carousel-item active " >
                  <div class="col-10 mx-auto">
                    <img src="{{ asset('img/photo0000-5281.jpg')}}" alt="NO_IMAGE" style="max-width: 100%; , height: auto;">
                  </div>

                    <div class="carousel-caption border border-primary rounded d-none d-md-block" style="background-color:#f3c35c;">
                      <div ><font color="#191970"; size="5" face="Comic Sans MS">{{ config('rate_type')[$matter['rate_type']]['name'] }}の案件</font></div>
                      <div class="row">
                        <div class="col-8" id="matter-info">
                          <!--進捗バー-->
                          <div class="row">
                            <div class="col-2 text-dark">進捗:</div>
                            <div class="col-10">
                              <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $matter['progress'] }}" aria-valuenow= "{{ $matter['progress'] }}", aria-valuemin="0" aria-valuemax=></div>
                          </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-2 text-dark">工数:</div>
                            <div class="col-10">
                            <div>
                              <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="col-2 text-dark">参加人数:</div>
                        <div class="col-2">  <button type="button" class="btn btn-outline-primary"><a href="chat/doteki/{{ $matter['id'] }}">参加</a></button> </div>
                      </div>
                    </div>
                </div>
            @else
              <div class="carousel-item">
                <div class="col-10 mx-auto">
                  <img src="{{ asset('img/photo0000-5281.jpg')}}" alt="NO_IMAGE">
                </div>
                <div class="carousel-caption rounded d-none d-md-block" style="background-color:#f3c35c;">
                  <div ><font color="#191970" size="5" face="Comic Sans MS">{{ config('rate_type')[$matter['rate_type']]['name'] }}の案件</font></div>
                  <div class="row">
                    <div class="col-8" id="matter-info">
                      <!--進捗バー-->
                      <div class="row">
                        <div class="col-2 text-dark">工数:</div>
                        <div class="col-10">
                          <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ floor($matter['time'] / $matter['time_limit'] * 100) }}" aria-valuenow= "{{ floor($matter['time'] / $matter['time_limit'] * 100) }}", aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2 text-dark">進捗:</div>
                        <div class="col-10">
                          <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: {{ floor($matter['progress'] / $matter['progress_limit'] * 100) }}" aria-valuenow="{{ floor($matter['progress'] / $matter['progress_limit'] * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                      </div>
                    </div>
                    </div>
                    <div class="col-2 text-dark">参加人数:</div>
                    <div class="col-2">  <button type="button" class="btn btn-outline-primary"><a href="chat/doteki/{{ $matter['id'] }}">参加</a></button> </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
            <!--<div class="carousel-item">
              <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Third slide"><title>Placeholder</title><rect width="100%" height="100%" fill="#555"/><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg>
            </div>-->

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  </div>
  <!--仮設置終わり-->
  <!--色追加テスト-->
<div class="bg-primary" style="font-family:Courier,Times,serif;">
  <h2>Courierあいうえお1234開始</h2>
</div>
<div class="bg-test2" style="font-family:Times,serif;">
  <h2>Timesあいうえお1234開始</h2>
</div>
<div class="bg-test2" style="font-family:'メイリオ',serif;">
  <h2>メイリオaiueo1234開始</h2>
</div>
<div class="bg-test2" style="font-family:'ヒラギノ角ゴ',serif;">
  <h2>ヒラギノ角ゴaiueo123開始4開始</h2>
</div>
<div class="bg-test2" style="font-family:'Grandstander',cursive;">
  <h2>Grandstande開始rあいうえお1234開始開始</h2>
</div>
<div class="bg-test2" style="font-family: 'Press Start 2P', 'Kosugi Maru',cursive;">
  <h2>開始Pressstartあいうえお1234なんかうまくはんえいされてないな？開始</h2>
</div>
<div class="bg-test2" style="font-family: 'Sigmar One', cursive;">
  <h2>SigmarOneあいうえお1234開始</h2>
</div>
<div class="bg-test2" style="font-family: 'Kosugi Maru', cursive;">
  <h2>SigmarOneあいうえお1234これは日本語もいけるかな開始</h2>
</div>



  <!--色追加テスト-->


<div class='container'>
  <div class='row justify-content-md-center w-100'>
    <div class='col-6 mx-auto' style="background-color:#f3c35c;">
      <h3>あなたのステータス</h3>
      <ul class="list-group">
        @foreach ($langSkills as $langSkill)
          <li class="list-group-item">{{$langSkill['skill']}}<span class="badge badge-light">{{$langSkill['level']}}</span></li>
        @endforeach
      </ul>
    </div>
    <div class='col-6'>
<!--overflow-->
      <div class="overflow-auto" style=" height:300px; background-color:#f3c35c;" >
        <div id="shop" class="item h-100">
          <h3>アイテム　所持金：<span class="badge badge-light" v-text="'￥'+money" v-bind:style="{ color: color}"></span></h3>
          <div class="list-group">
<<<<<<< HEAD
            <button class="list-group-item list-group-item-action" v-for="i in items" v-bind:disabled="onBuy" >
                <div @click='buy(i.id)' class="row">
=======
            <button class="list-group-item list-group-item-action" v-for="i in items" v-bind:disabled="onBuy || ( money < i.money )">
                <div @click='buy(i.id)' class="row" v-bind:class="{ noMoney: (money < i.money) }">
>>>>>>> 78bc114cd249d2ae6947d1883f44c8a89c0ed237
                    <div class="col-2"><span class="badge badge-light" v-text="i.type"></span></div>
                    <div class="col-6"><span v-text="i.name"></span></div>
                    <div class="col-2"><span class="badge badge-light" v-text="'￥'+i.money"></span></div>
                    <div class="col-2"><span class="badge badge-light" v-text="has_items[i.id]"></span></div>
                </div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/js/app.js"></script>
    <script>

        new Vue({
            el: '#shop',
            data: {
                user: @json($user),
                items: @json($items),
                has_items: {},
                money: '',
                onBuy: false,
                color: 'black'
            },
            methods: {
                buy(item_id) {
                    this.onBuy = true;
                    var params = { item_id: item_id};
                    axios.post("/shop", params)
                        .then((response) => {
                            //成功時処理
                            this.getHasItems();
                            this.getHasMoney();
                        });
                },
                getHasItems() {
                    axios.get("getHasItems")
                        .then((response) => {
                            this.has_items = response.data;
                        });
                },
                getHasMoney() {
                    axios.get("getHasMoney")
                        .then((response) => {
                            this.money = response.data;
                            if ( this.money < 0 ){ this.color = 'red'; }
                            this.onBuy = false;
                        });
                }
            },
            mounted() {
                this.getHasItems();
                this.getHasMoney();
            }
        });

</script>

@endsection
