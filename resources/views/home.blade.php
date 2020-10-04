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

{{-- カルーセル --}}
<!--カルーセルがコンテナ内に入っていないのでcontainerに入れる。
-->
<div class="container my-3" style="height:50vw">
  <div id="carousel" class="carousel slide" data-ride="carousel" >
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
              <div class="carousel-caption" style="background-color: rgba(0, 0, 0, 0.5);height:20vh;">
                <div class="mt-0 pt-0" style="font-size: 2vh">No. {{ $matters[$i]['id'] }}　　{{ config('rate_type')[$matters[$i]['rate_type']]['name'] }}の案件</div>
                <div class="m-3">
                  <span class="m-1 badge badge-light" style="float:left;height:1.75vh;">工数</span>
                  <div class="m-1 progress" style="height:1.75vh;" >
                      <div class="progress-bar bg-success" role="progressbar" style="width:{{ round($matters[$i]['time'] / $matters[$i]['time_limit'] * 100) }}%" aria-valuenow="{{ round($matters[$i]['time'] / $matters[$i]['time_limit'] * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <br>
                  <span class="m-1 badge badge-light" style="float:left;height:1.75vh;">進捗</span>
                  <div class="m-1 progress"  style="height:1.75vh;">
                      <div class="progress-bar bg-info" role="progressbar" style="width:{{ round($matters[$i]['progress'] / $matters[$i]['progress_limit'] * 100) }}%" aria-valuenow="{{ round($matters[$i]['time'] / $matters[$i]['time_limit'] * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <a href="/chat/doteki/{{ $matters[$i]['id'] }}"><button type="button" class="btn" style="height:4.0vh; color:var(--color-back); background-color:var(--color-point);">参加</button></a>
              </div>
            </div>
      @endfor
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
</div>

<div class='container'>
  <div class='row justify-content-center'>
    <div class='col-6 mx-auto border border-primary'style=" height: 75vw;">
      <h3>あなたのステータス</h3>
      <ul class="list-group">
        @foreach ($langSkills as $langSkill)
          <li class="list-group-item">{{$langSkill['skill']}}<span class="badge badge-light">{{$langSkill['level']}}</span></li>
        @endforeach
      </ul>
    </div>
    <div class='col-6  mx-auto border border-primary' style=" height: 75vw; overflow:scroll;">
        <div id="shop" class="item h-100">
          <h3>アイテム　所持金：<span class="badge badge-light" v-text="'￥'+money" v-bind:style="{ color: color}"></span></h3>

            <div class="list-group　" style=" font-size: 1.25vw;">
              <button class="list-group-item list-group-item-action" v-for="i in items" v-bind:disabled="onBuy || ( money < i.money )">
                  <div @click='buy(i.id)' class="row" v-bind:class="{ noMoney: (money < i.money) }">
                      <div class="col-2 px-0"><span class="badge badge-light" v-text="i.type"></span></div>
                      <div class="col-6 px-0"><span v-text="i.name"></span></div>
                      <div class="col-2 px-0"><span class="badge badge-light" v-text="'￥'+i.money"></span></div>
                      <div class="col-2 px-0 text-right"><span class="badge badge-light" v-text="has_items[i.id]"></span></div>
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
