@extends('layouts.app')

@section('content')
<!--画面-->
<!---->

<!--がめんのコンテナのわくぐみです-->
<div　class="container">
  <div class="row">
    <div class="col-8 pr-0">
      <div class="col-12 border border-dark" id="battle" style="height:350px">
        <div class="row align-items-start h-50" >
          <div class="col-8 align-item-ends">
                <!--進捗バー-->
                <div class="row">
                  <div class="col-2 text-dark">進捗:</div>
                  <div class="col-10">
                    <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 40" aria-valuenow= "40", aria-valuemin="0" aria-valuemax=100></div>
                </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 text-dark">工数:</div>
                  <div class="col-10">
                  <div>
                    <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  </div>
                </div>
              </div>
            </div>

          <div class="col-4">
            <img alt="敵の写真" src="{{ asset('/img/'.$image.'.png') }}"　style="height:40px; width:40px;" class="img-fluid">
          </div>
        </div>
        <div class="row bg-primary align-items-end h-50">
          <div class="col-4">
              <img alt="自分の写真" src="{{ asset('/img/'.$image.'.png') }}"　style="height:40px; width:40px;">
          </div>
          <div class="col-8">
            <div class="row">
              <div class="col-2 text-dark">残り時間:</div>
              <div class="col-10">
                <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 40" aria-valuenow= "40", aria-valuemin="0" aria-valuemax=100></div>
            </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-12 border border-dark" id="chat" style="height:150px">

        <!--チャットテキスト-->
        <div class="col-12 overflow-auto" style="height:100px" >
            <div  v-for="m in messages">
                <p>qあああああああああああああああああ</p>
                <!-- 登録された日時 -->
                <span v-text="m.created_at"></span>：&nbsp;
                <!-- メッセージ内容 -->
                user_name:<span v-text="m.user_name"></span><br>
                <!-- メッセージ内容 -->
                <span v-text="m.body"></span>
                <hr style="border:0;border-top:1px solid blue;">
            </div>
          </div>

          <div class="row" style="height:6vh;">
              <div class="col input-group">
                  <input type="text" class="form-control" placeholder="Your message" aria-describedby="button-addon2" v-model="message">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="send('chat', 'chat')">送信</button>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <div class="col-4 pl-0">
      <div class="col  border border-dark" id="info" style="height:200px">
        <div class="row h-100 border">
            <div class="col-4 border h-100">
                <img class="img-fluid" style="height:10vh; width:10vh;" alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
            </div>
            <div class="col-8 h-100">
                <div class="row h-25 border">INFO_TITLE</div>
                <div class="row h-75 border">INFO_TEXT</div>
            </div>
        </div>
      </div>
      <div class="col border border-dark" id="command" style="height:300px">
        <div class="col h-100" v-if="onCommands">
            <div class="row h-75">
                <div class="col">
                    <div class="row h-50">
                        <button class="col m-1 btn  btn-primary" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[0] )" >ここにもらってきたコマンド名が入ります</span></button>
                        <button class="col m-1 btn  btn-success" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[1] )" >ここにもらってきたコマンド名が入ります</span></button>
                    </div>
                    <div class="row h-50">
                        <button class="col m-1 btn  btn-danger" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[2] )" >ここにもらってきたコマンド名が入ります</span></button>
                        <button class="col m-1 btn  btn-warning" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[3] )" >ここにもらってきたコマンド名が入ります</span></button>
                    </div>
                </div>
            </div>
            <div class="row h-25">
                <button class="col m-1 btn  btn-secondary" type="button" name="button" v-bind:disabled="isProcessing" @click="toggleBattle()">RETURN</button>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!--画面コンテナの枠組みおわりん-->


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
