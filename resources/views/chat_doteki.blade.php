<html>
<body>
    <div id="chat">
        <img alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
        <br>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send('chat','')">送信</button>
        <br>

        <form  name="input_form"  method="post"  action="/chat/{{$id}}">
          @csrf
          <input class="btn  btn-primary"  type="button" @click="send('command',1)"  name="button"   value="1">
          <input class="btn  btn btn-success"  type="button" @click="send('command',2)"  name="button"  value="2">
          <input class="btn  btn-danger"  type="button" @click="send('command',3)"  name="button"   value="3">
          <input class="btn  btn-warning"  type="button" @click="send('command',4)"  name="button"   value="4">
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
                            var params = { message: value+'のコマンドを発動',user_name:this.user_name };
                            axios.post(url, params)
                            .then((response) => {
                                // 成功したときの処理
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
</body>
</html>