@extends('layouts.app')

@section('content')
<!--酢黒る-->
<div class="contaienr py-3">
  <div class="row justify-content-center">
    <div class="col-10 border border-primary">
      <div style="height:300px;" class="overflow-auto" >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">案件</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="Navbar">
        <ul class="nav nav-pills flex-column flex-lg-row ml-auto">
          <li class="nav-item"><a class="nav-link active" href="#matter1">案件１</a></li>
          <li class="nav-item"><a class="nav-link" href="#matter2">案健２</a></li>
          <li class="nav-item dropdown">
    <!--      <li class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ドロップダウン</a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#menu1">メニュー1</a>
              ...
            </div></li>-->
          <li class="nav-item"><a class="nav-link" href="#matter3">案件3</a></li>
          <li class="nav-item"><a class="nav-link" href="#matter3">案件4</a></li>
        </ul>
      </div>
    </nav>
    <div class="container overflow-auto"data-spy="scroll" data-target="#Navbar">
      @foreach ($matters as $matter)
      <div id="matter{{ $matter['id'] }}" class="border">
          <h3>案件{{ $matter['id'] }} ( {{ config('rate_type')[$matter['rate_type']]['name'] }} ) </h3>
          <p>
            案件{{ $matter['id'] }}：
            工数【 {{ $matter['time'] }} / {{ $matter['time_limit'] }} ( {{ floor($matter['time'] / $matter['time_limit'] * 100) }} % ) 】
            進捗 {{ $matter['progress'] }} / {{ $matter['progress_limit'] }} ( {{ floor($matter['progress'] / $matter['progress_limit'] * 100) }} % ) 】           
            <button type="button" class="btn btn-primary"><a href="chat/doteki/{{ $matter['id'] }}">参加</a></button>
          </p>
        </div>
      @endforeach
    </div>
  </div>
    </div>
  </div>
</div>

<div class='container'>
  <div class='row justify-content-md-center w-100'>
    <div class='col-6  border border-primary'>
      <h3>あなたのステータス</h3>
      <ul class="list-group">
        <li class="list-group-item">Level<span class="badge badge-light">{{ $status->where('type', 'level_basic')->first()->value1 }}</span></li>
        <li class="list-group-item">PHP<span class="badge badge-light">{{ $status->where('type', 'level_php')->first()->value1 }}</span></li>
        <li class="list-group-item">Python<span class="badge badge-light">{{ $status->where('type', 'level_python')->first()->value1 }}</span></li>
        <li class="list-group-item">Ruby<span class="badge badge-light">{{ $status->where('type', 'level_ruby')->first()->value1 }}</span></li>
      </ul>
    </div>
    <div class='col-6  border border-primary'>
        <div id="shop" class="item h-100">
          <h3>アイテム　所持金：<span class="badge badge-light" v-text="'￥'+money" v-bind:style="{ color: color}"></span></h3>
          <div class="list-group">
            <button class="list-group-item list-group-item-action" v-for="i in items" v-bind:disabled="onBuy">
                <div @click='buy(i.id)' class="row">
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
                    this.onBuy = !this.onBuy;
                    var params = { item_id: item_id};
                    axios.post("/shop", params)
                        .then((response) => {
                            //成功時処理
                            this.getItems();
                            this.getMoney();
                            this.onBuy = !this.onBuy;
                        });
                },
                getItems() {
                    axios.get("shop/"+this.user['id'])
                        .then((response) => {
                            this.has_items = response.data;
                        });
                },
                getMoney() {
                    axios.get("shop/money/"+this.user['id'])
                        .then((response) => {
                            this.money = response.data;
                            if ( this.money < 0 ){ this.color = 'red'; }
                        });
                }
            },
            mounted() {
                this.getItems();
                this.getMoney();
            }
        });

</script>

@endsection
