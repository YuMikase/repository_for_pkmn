@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','chat')

    {{-- 時折全画面覆うや－つ --}}
    @if ($time_over >= 1)
    <div class="time_out">
        タイムアウトになり申した
        <form name="input_form"  method="post"  action="/chat">
            @csrf
            <input type="submit"  name="button"   value="5">
        </form>
    </div>
    @endif
    @if ($time_over >= 2)
    <div class="result">
        リザルト
        <form name="input_form"  method="post"  action="/chat">
            @csrf
            <input type="submit"  name="button"   value="6">
        </form>
    </div>
    @endif

    {{-- ローディング画面 --}}
    <div id="loading">
        <div class="spinner"></div>
    </div>

    {{-- ゲージの表示 --}}
    @section('header')
    <div class="grid_gauge">
        <div class="enjo">炎上</div>
        <div class="sintyoku">進捗</div>
    </div>
    @endsection

    <h class="animate__animated animate__bounce">Hello, {{ Cookie::get('user_name') }}</h>

    @section('main')
        
    {{-- 全体の表示 --}}
    <div id="app">
        <div class="grid_chat">
            {{-- 画像 --}}
            <div class="img">
                <img  class="enemy_img" alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
                <div class="enemy_status">
                    <p>敵のステータス<p>
                </div>
                <img  class="me_img" alt="ロゴ" src="{{ asset('/img/me/programming_man.png') }}">
                <div class="me_status">
                    <p>自分のステータス<p>        
                </div>
            </div>
    
            {{-- チャットメッセージ --}}
            <div class="messages">
                <div v-for="m in messages">
                    <div v-bind:class="m.type">
                        <!-- 登録された日時 -->
                        <span v-text="m.created_at"></span>：&nbsp;
                        <!-- メッセージ内容 -->
                        user_name:<span v-text="m.user_name"></span><br> 
                        <!-- メッセージ内容 -->
                        <span v-text="m.body"></span>
                    </div>
                    <hr style="border:0;border-top:1px solid blue;">
                </div>
            </div>
    
            {{-- 左下の4つのコマンド --}}
            <div class="grid_commands">
                <div>          
                    <textarea class="textbox" v-model="message"></textarea>
                    <button class="send_btn" type="button" @click="send()">送信</button>
                </div>
            </div>
    
            
    
        </div>
    
        {{-- アクション --}}
        <div id='actions' style="border: solid 1px black;">
            <span>アクション</span><br>
            <button v-on:click="send_a('debug')">デバッグ</button><br>
            <button v-on:click="view_items()">アイテム</button><br>
            <button v-on:click="send_a('run')">にげる</button>
        </div>
    
        {{-- コマンド --}}
        <div id='commands' style="border: solid 1px black;">
            <span>コマンド</span>
            <div v-for="c in commands">
                <button v-on:click="sendb(c.name)"><span v-text="c.name"></span></button>
            </div>
        </div>
    
        {{-- アイテム --}}
        <div id='items' v-bind:class="{ display_none:noneView }" style="border: solid 1px black;">
            <span>アイテム</span>
            <div v-for="i in items">
                <button v-on:click="send_i(i.name)"><span v-text="i.name"></span></button>
            </div>
        </div>
    </div>
    

    <style>
        .display_none {
            display: none;
        }
    </style>

    
    
    {{-- ロード画面用 --}}
    <script>
        window.onload = function() {
            const spinner = document.getElementById('loading');
            spinner.classList.add('loaded');
        }
    </script>
    
    {{-- ---------------------------------Vueでの処理用にここから --}}
    {{--  渡されていないときにどうするか後回しにしている  --}}
    @php
        $datas = [
            'commands' => $commands,
            'items' => $items,
            'user_name' => 'スケキヨ',
        ];
    @endphp
    {{--  PHPからJSで使うものを渡す  --}}
    <script>
        var datas = @json($datas);
    </script>
    <script src="/js/app.js"></script>
    {{-- ----------------------------------ここまでがセット --}}

    @endsection

    @section('footer')
    @endsection


@endsection