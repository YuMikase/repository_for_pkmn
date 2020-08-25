@extends('layouts.app')

@section('content')
<div class="containr">
  <div class="row">
    <div class="col-8 border border-primary">
      <div class="row">
        <div class="col-12 border border-primary">
          <div class="view" style="height: 300px;">
              <div class="row h-50">
                <div class="col-8">

                  <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">進捗</div>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">炎上</div>
                  </div>

                </div>
                <div class="col-4">エネミーの写真</div>
              </div>

              <div class="row h-50">
              <div class="col-4">自分の写真</div>
              <div class="col-8 border-primary">
                <div class="progress">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">開発期間</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-12 border border-primary">
          <div class="chat" style="height: 150px;">
              <!--チャットをちゃちゃっと////-->
              <div v-for="m in messages">
                  <!-- 登録された日時 -->
                  <span v-text="m.created_at"></span>：&nbsp;

                  <!-- メッセージ内容 -->
                  user_name:<span v-text="m.user_name"></span><br>

                  <!-- メッセージ内容 -->
                  <span v-text="m.body"></span>
                  <hr style="border:0;border-top:1px solid blue;">
              </div>

              <!--チャット送信用-->
              <div id="chat">
                <form class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">メッセージ</label>
                    <input type="message" class="form-control" id="mymessage">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">送信</button>
                </form>
                <!--
                  <textarea v-model="message"></textarea>
                  <button type="button" @click="send()">送信</button>
                -->

              </div>


          </div>
        </div>
      </div>
    </div>
    <div class="col-4 border border-primary">
      <div class="row">
        <div class="col-12 border border-primary">
          <div class="status" style="height: 150px;">
              ステータス
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 border border-primary">
          <div class="command" style="height: 300px;">
                <!--コマンドをコマンドカラムに入れる-->
                    @php
                        $c1 = config('command')[Auth::user()->skill1];
                        $c2 = config('command')[Auth::user()->skill2];
                        $c3 = config('command')[Auth::user()->skill3];
                        $c4 = config('command')[Auth::user()->skill4];
                    @endphp

                    <form  name="input_form"  method="post"  action="/chat/{{$id}}" class="h-80">
                      @csrf
                      <div class="row h-40">
                        <div class="col-6"><button class="btn  btn-primary" type="submit" name="button" value=" {{ $c1['id'] }} "> {{ $c1['name'] }} </button></div>
                        <div class="col-6"><button class="btn  btn-success" type="submit" name="button" value=" {{ $c2['id'] }} "> {{ $c2['name'] }} </button></div>
                      </div>
                      <div class="row h-40">
                        <div class="col-6"><button class="btn  btn-danger" type="submit" name="button" value=" {{ $c3['id'] }} "> {{ $c3['name'] }} </button></div>
                        <div class="col-6"><button class="btn  btn-warning" type="submit" name="button" value=" {{ $c4['id'] }} "> {{ $c4['name'] }} </button></div>
                      </div>
                    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--
    <div id="chat">
        <img alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
        <br>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
        <br>
    </div>
  -->
<!--
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
-->
        <hr>
<!--
        <div v-for="m in messages">

             登録された日時
            <span v-text="m.created_at"></span>：&nbsp;

             メッセージ内容
            user_name:<span v-text="m.user_name"></span><br>

             メッセージ内容
            <span v-text="m.body"></span>

            <hr style="border:0;border-top:1px solid blue;">


        </div>
      -->

  <!--  </div>-->

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
