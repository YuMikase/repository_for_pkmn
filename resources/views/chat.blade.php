@extends('layouts.app')

@section('content')
    <div id="chat">
        <img alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
        <br>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
        <br>

        @php
            $c1 = config('command')[Auth::user()->skill1];
            $c2 = config('command')[Auth::user()->skill2];
            $c3 = config('command')[Auth::user()->skill3];
            $c4 = config('command')[Auth::user()->skill4];
        @endphp
        <form  name="input_form"  method="post"  action="/chat/{{$id}}">
          @csrf
            <button class="btn  btn-primary" type="submit" name="button" value=" {{ $c1['id'] }} "> {{ $c1['name'] }} </button>
            <button class="btn  btn-success" type="submit" name="button" value=" {{ $c2['id'] }} "> {{ $c2['name'] }} </button>
            <button class="btn  btn-danger" type="submit" name="button" value=" {{ $c3['id'] }} "> {{ $c3['name'] }} </button>
            <button class="btn  btn-warning" type="submit" name="button" value=" {{ $c4['id'] }} "> {{ $c4['name'] }} </button>
        </form>

        <hr>

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

    <script src="/js/app.js"></script>
    <script>

        new Vue({
            el: '#chat',
            data: {
                message: '',
                user_name: "{{$user_name}}",
                id: "{{$id}}",
                messages: []
            },
            methods: {
                getMessages() {
                    const url = "/ajax/chat/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.messages = response.data
                        });
                },
                send() {
                    const url = "/ajax/chat/"+this.id;
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