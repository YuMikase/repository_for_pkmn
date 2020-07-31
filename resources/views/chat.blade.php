@extends('layouts.common')

@section('content')

    @section('head')
    @section('title','chat')

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

    @section('header')
    <div class="grid_gauge">
        <div class="enjo">炎上</div>
        <div class="sintyoku">進捗</div>
    </div>
    @endsection

    <h>Hello, {{ Cookie::get('user_name') }}</h>

    @section('main')
        
    <div class="grid_chat" id="chat">
        <div class="enemy_img">
            <img  class="img" alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
        </div>

        <div class="messages">
            <div v-for="m in messages">
                <!-- 登録された日時 -->
                <span v-text="m.created_at"></span>：&nbsp;
                <!-- メッセージ内容 -->
                user_name:<span v-text="m.user_name"></span><br> 
                <!-- メッセージ内容 -->
                <span v-text="m.body"></span>
                <hr style="border:0;border-top:1px solid blue;">
            </div>
        </div>

        <form class="grid_commands" name="input_form"  method="post"  action="/chat">
            @csrf
            <input class="btn1 btn btn-primary"  type="submit"  name="button"   value="1">
            <input class="btn2 btn btn btn-success"  type="submit"  name="button"  value="2">
            <input class="btn3 btn btn-danger"  type="submit"  name="button"   value="3">
            <input class="btn4 btn btn-warning"  type="submit"  name="button"   value="4">
            <textarea class="textbox" v-model="message"></textarea>
            <button class="send_btn" type="button" @click="send()">送信</button>
        </form>

        <div class="select_btns">
            <button>たたかう</button><br>
            <button>デバッグ</button><br>
            <button>アイテム</button><br>
            <button>にげる</button>
        </div>
    </div>

    <script src="/js/app.js"></script>
    <script>

        new Vue({
            el: '#chat',
            data: {
                message: '',
                user_name: "{{$user_name}}",
                messages: []
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
                    const params = { message: 'メッセージ：'+this.message,user_name:this.user_name };
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
        });

    </script>
    @endsection

    @section('footer')
    @endsection


@endsection