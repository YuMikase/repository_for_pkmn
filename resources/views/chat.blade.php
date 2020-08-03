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
    <div class="grid_chat" id="chat">
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

        {{-- 右下のコマンド --}}
        <div class="select_btns">
            <button>たたかう</button><br>
            <button>デバッグ</button><br>
            <button>アイテム</button><br>
            <button>にげる</button>
        </div>
    </div>

    {{-- コマンド --}}
    <div id='commands'>
        <div v-for="c in commands">
            <button v-on:click="sendb(c.name)"><span v-text="c.name"></span></button>
        </div>
    </div>

    {{-- スクリプト --}}
    <script src="/js/app.js"></script>
    <script>


        //コマンドの配列を取得
        var commands = @json($commands);

        //配列をシャッフル（Fisher–Yates shuffle）して4つ返す
        const shuffle = ([...array]) => {
        for (let i = array.length - 1; i >= 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return [array[0],array[1],array[2],array[3]];
        }

        //シャッフルて4つ取得
        var cfour = shuffle(commands);

        //ロード画面用
        window.onload = function() {
            const spinner = document.getElementById('loading');
            spinner.classList.add('loaded');
        }

        //----------コマンド用----------
        var command_vue = new Vue({
            el: '#commands',
            data: {
                commands: cfour,
                user_name: "{{$user_name}}"
            },
            methods: {
                sendb(value) {
                    const url = '/ajax/chat';
                    const params = { message: value+'のボタンを押した。',user_name:this.user_name,type: 'my_do' };
                    axios.post(url, params)
                    .then((response) => {
                        //成功したらまたランダムな4つに
                        this.commands = shuffle(commands);
                    });
                }
            }
        })
        
        //----------チャットメッセージ用----------
        var chat_vue = new Vue({
            el: '#chat',
            data: {
                message: '',
                user_name: "{{$user_name}}",
                messages: [],
                type: '',
            },
            methods: {
                getMessages() {
                    const url = '/ajax/chat/1';
                    axios.get(url)
                        .then((response) => {
                            this.messages = response.data
                        });
                },
                send() {
                    const url = '/ajax/chat';
                    const params = { message: 'メッセージ：'+this.message,user_name:this.user_name,type: 'my_do' };
                    axios.post(url, params)
                        .then((response) => {
                            // 成功したらメッセージをクリア
                            this.message = '';
                        });
                }
            },
            mounted() {
                this.getMessages();
                Echo.channel('chat')
                    .listen('MessageCreated', (e) => {
                        this.getMessages(); // 全メッセージを再読込
                    });
            }
        })

    </script>
    @endsection

    @section('footer')
    @endsection


@endsection