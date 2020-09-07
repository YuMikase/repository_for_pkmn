@extends('layouts.app')

@section('content')
<!--画面-->
<!---->

<!--がめんのコンテナのわくぐみです-->
<div class="container">
  <h4 class="row m-1">所持金：</h4>
  <h3>{{$lang}}の案件<span v-text="matter.lang"></span></h3>
  <div class="row">
    <div class="col-8 pr-0">
      <div class="col-12 border border-dark" id="battle" style="height:350px">
        <div class="row align-items-start h-50" >
          <div class="col-8 align-item-ends">
                <!--進捗バー-->
                <div class="row">
                    <span class="col-2 m-1 badge badge-light">工数</span>
                    <div class="col-8 p-0 m-1 progress">
                        <div class="progress-bar bg-success" role="progressbar" v-bind:style="'width:50%'" v-bind:aria-valuenow="time" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-2 text-dark">工数:</div>
                  <div class="col-10">
                  <div>
                    <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" v-bind:style="'width:'+time+'%'" v-bind:aria-valuenow="time" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  </div>
                </div>
              </div>
            </div>

          <div class="col-4">
            <img alt="敵の写真" src="{{ asset('/img/'.$image.'.png') }}" style="height:150px; width:150px;" class="img-fluid">
          </div>
        </div>
        <div class="row bg-primary align-items-end h-50">
          <div class="col-4">
              <img alt="自分の写真" src="{{ asset('/img/'.$image.'.png') }}" style="height:150px; width:150px;">
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

      <div class="col-12 border border-dark" id="chat" style="height:400px">
        <!--チャットテキスト-->
        <div class="col-12 overflow-auto" style="height:320px" >
            <div  v-for="m in messages">
                <!-- 登録された日時 -->
                <span v-text="m.created_at"></span>：&nbsp;
                <!-- メッセージ内容 -->
                user_name:<span v-text="m.user_name"></span><br>
                <!-- メッセージ内容 -->
                <span v-text="m.body"></span>
                <hr style="border:0;border-top:1px solid blue;">
            </div>
          </div>

          <div class="row d-flex align-items-end" style="height:6vh;">
              <div class="col input-group">
                  <input type="text" class="form-control" placeholder="Your message" v-model="message">
<!--                   <div class="input-group-append"> -->
                    <button type="button" @click="send()">送信</button>
<!--                   </div> -->
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
                    @php
                        $c1 = config('command')[Auth::user()->skill1];
                        $c2 = config('command')[Auth::user()->skill2];
                        $c3 = config('command')[Auth::user()->skill3];
                        $c4 = config('command')[Auth::user()->skill4];
                    @endphp
                    <form  name="input_form"  method="post"  action="/chat/{{$id}}">
                          @csrf
                          <button class="btn btn-primary w-100" type="submit" name="button" value=" {{ $c1['id'] }} "> {{ $c1['name'] }}</span></button>
                          <button class="btn btn-success w-100" type="submit" name="button" value=" {{ $c2['id'] }} "> {{ $c2['name'] }}</span></button>
                          <button class="btn btn-danger w-100" type="submit" name="button"  value=" {{ $c3['id'] }} "> {{ $c3['name'] }} </span></button>
                          <button class="btn btn-warning w-100" type="submit" name="button" value=" {{ $c4['id'] }} "> {{ $c4['name'] }}</span></button>
                    </form>
                  </div>
            </div>
            <div class="d-flex align-items-end">
                <button class="btn btn-secondary w-100" onclick="location.href='/home'">逃げる</span></button>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!--画面コンテナの枠組みおわりん-->
    <script src="/js/app.js"></script>
    <script>
        new Vue({
            el: '#chat',
            data: {
                message: '',
                user_name: "{{$user_name}}",
                id: "{{$id}}",
                messages: [],
                text: "a",
                matter: {},
                barning: 0,
                progress: 30,
                time: 30,
            },
            methods: {

              //メッセージ一覧取得
                getMessages() {
                    const url = "/ajax/chat/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.messages = response.data
                        });
                },
              //案件取得
                getMatter() {
                    const url = "/ajax/matter/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.barning = response.data[0];
                            this.progress = response.data[1];
                            this.time = response.data[2];
                        });
                      },
                send() {
                    const url = "/ajax/chat/"+this.id;
                    const params = { message: this.message ,user_name: this.user_name };
                    axios.post(url, params)
                        .then((response) => {
                            // 成功したらメッセージをクリア
                            this.message = '';
                        });

                }
            },
            mounted() {
                this.getMessages();
                this.getMatter();

                console.log(this.barning);

                Echo.channel('chat')
                    .listen('MessageCreated', (e) => {

                        this.getMessages(); // 全メッセージを再読込
                        this.getMatter(); //案件情報を再読み込み
                    });

            }
        });

    </script>
@endsection
