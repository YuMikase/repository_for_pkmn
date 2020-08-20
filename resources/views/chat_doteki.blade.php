@extends('layouts.app')

@section('content')
    <div id="chat">
        <img alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
        <br>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send('chat', 'chat')">送信</button>
        <br>

        <button class="btn  btn-primary" type="button" name="button" @click="send('command', commands[0] )" ><span v-text="commands[0]['name']"></span></button>
        <button class="btn  btn-success" type="button" name="button" @click="send('command', commands[1] )" ><span v-text="commands[1]['name']"></span></button>
        <button class="btn  btn-danger" type="button" name="button" @click="send('command', commands[2] )" ><span v-text="commands[2]['name']"></span></button>
        <button class="btn  btn-warning" type="button" name="button" @click="send('command', commands[3] )" ><span v-text="commands[3]['name']"></span></button>

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
                messages: [],
                user_id: "{{Auth::user()->id}}",
                commands: @json($cmds_now)
            },
            methods: {
                getMessages() {
                    const url = "/ajax/chat/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.messages = response.data
                        });
                },
                getCommands() {
                    const url = "/ajax/command/"+this.user_id;
                    axios.get(url)
                        .then((response) => {
                            this.commands = response.data
                        });
                },
                send(type,value) {
                    const url = "/ajax/"+type+"/"+this.id;
                    switch (type) {
                        case "chat":
                            var params = { message: 'メッセージ：'+this.message,user_name:this.user_name };
                            axios.post(url, params)
                            .then((response) => {
                                // 成功したらメッセージをクリア
                                this.message = '';
                            });
                            break;
                    
                        case "command":
                            var params = { message: value.name+'のコマンドを発動',user_name:this.user_name,command: value.id };
                            axios.post(url, params)
                            .then((response) => {
                                // 成功したときの処理
                                this.getCommands();
                            });
                            break;
                    }
                    
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