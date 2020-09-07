@extends('layouts.app')

@section('content')
<!--酢黒る-->
<div class="contaienr py-3">
  <div class="row justify-content-center">
    <div class="col-10 border border-primary">
      <div style="height:400px;" class="overflow-auto" >
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">案件</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="Navbar">
      </div>
    </nav>
    <div class="container overflow-auto"data-spy="scroll" data-target="#Navbar">
      @foreach ($matters as $matter)
      <div id="matter{{ $matter['id'] }}" class="border">
          <h3>{{$matter['matter_lang'] }}の案件</h3>
          <p>
            工数【 {{ $matter['time'] }} / {{ $matter['time_limit'] }} ( {{ floor($matter['time'] / $matter['time_limit'] * 100) }} % ) 】
            進捗【{{ $matter['progress'] }} / {{ $matter['progress_limit'] }} ( {{ floor($matter['progress'] / $matter['progress_limit'] * 100) }} % ) 】
            @if(floor($matter['barning'] / $matter['barning_limit'] * 100) < 50)
            <button type="button" class="btn btn-success" onclick="location.href='chat/{{ $matter['id'] }}'">参加</button>
            @else
            <button type="button" class="btn btn-danger" onclick="location.href='chat/{{ $matter['id'] }}'">参加</button>
            @endif
          </p>
        </div>
      @endforeach
    </div>
  </div>
    </div>
  </div>
</div>

<div class='container'>
  <div class='row justify-content-md-center w-300'>
    <div class='col-12 bg-gradient-primary border border-primary'>
      <h3>あなたのステータス</h3><h3 class="text-right">所持金:${{$user['money']}}</h3>
      <ul class="list-group">
        @foreach ($langSkills as $langSkill)
         <li class="list-group-item">{{$langSkill['skill']}}のレベル<span class="badge badge-light">:{{ $langSkill['level'] }}</span></li>
        @endforeach

      </ul>
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
