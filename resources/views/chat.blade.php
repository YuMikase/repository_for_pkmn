<html>
<body>
    <div id="chat">
        <img alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
        <br>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
        <br>

        <form  name="input_form"  method="post"  action="/chat/1">
          @csrf
          <input class="btn  btn-primary"  type="submit"  name="button"   value="1">
          <input class="btn  btn btn-success"  type="submit"  name="button"  value="2">
          <input class="btn  btn-danger"  type="submit"  name="button"   value="3">
          <input class="btn  btn-warning"  type="submit"  name="button"   value="4">
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
                    const url = '/ajax/chat/1';
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
</body>
</html>