@extends('layouts.app')

@section('content')

<h1>PKMN</h1>
<a href="/chat">chat</a>

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
        <div class="messages" style="height: 200px; overflow: scroll;">
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
                <button class="send_btn" type="button" @click="send('chat', 'chat')">送信</button>
            </div>
        </div>

        

    </div>

    {{-- アクション --}}
    <div id='actions' style="border: solid 1px black;">
        <span>アクション</span><br>
        <button v-on:click="send('debug','debug')">デバッグ</button><br>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#items">アイテム</button><br>
        <button v-on:click="send('run', 'run')">にげる</button>
    </div>

    {{-- コマンド --}}
    <div id='commands' style="border: solid 1px black;">
        <span>コマンド</span>
        <div v-for="c in commands">
            <button v-on:click="send('command', c.name)"><span v-text="c.name"></span></button>
        </div>
    </div>

    {{-- アイテム --}}
    <div id='items' class="collapse" style="border: solid 1px black;">
        <span>アイテム</span>
        <div v-for="i in items">
            <button v-on:click="send('item', i.name)"><span v-text="i.name"></span></button>
        </div>
    </div>
</div>



@endsection

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
    {{-- ----------------------------------ここまでがセット --}}