@extends('layouts.app')

@section('content')
    <div id="chat">

        <div v-if="onLoading" class="container-fluid" style="background-color: white;z-index: 5000; width:100vw; height: 100vh;">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary m-5" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="height: 600px;">
            <div class="row h-100">
                <div class="col-7">
                    <div class="row h-75 border">
                        <div class="col-6">
                            <div class="row h-50">
                                <div class="col border">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" v-bind:style="'width:'+progress+'%'" v-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress" v-if="onDebug">
                                        <div class="progress-bar bg-danger" role="progressbar" v-bind:style="'width:'+barning+'%'" v-bind:aria-valuenow="barning" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-50">
                                <div class="col border">
                                    <img class="img-fluid" alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row h-50">
                                <div class="col border">
                                    <img class="img-fluid" alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
                                </div>
                            </div>
                            <div class="row h-50">
                                <div class="col border">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" v-bind:style="'width:'+progress+'%'" v-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row h-25 border">
                        <div class="col h-100">
                            <div class="row overflow-auto" style="height: 110px">
                                <div class="col">
                                    <div class="row border mt-1" v-for="m in messages">
                                        <div class="col">
                                            <!-- 登録された日時 -->
                                            <span class="row" v-text="m.created_at+' : user_name : '+m.user_name"></span>
                                            <!-- メッセージ内容 -->
                                            <span class="row" v-text=""></span> 
                                            <!-- メッセージ内容 -->
                                            <span class="row" v-text="m.body"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-25">
                                <div class="col input-group">
                                    <input type="text" class="form-control" placeholder="Your message" aria-describedby="button-addon2" v-model="message">
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="send('chat', 'chat')">送信</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="col-5">
                    <div class="row h-25 border">
                        <div class="col-4 border h-100">
                            <img class="img-fluid" alt="ロゴ" src="{{ asset('/img/'.$image.'.png') }}">
                        </div>
                        <div class="col-8 ">
                            <div class="row h-25 border">INFO_TITLE</div>
                            <div class="row h-75 border">INFO_TEXT</div>
                        </div>
                    </div>
                    <div class="row h-75 border">
                        <div class="col" v-if="!onCommands">
                            <div class="row h-50">
                                <button class="col m-1 btn  btn-primary" type="button" name="button" @click="toggleBattle()">BATTLE</button>
                                <button class="col m-1 btn  btn-primary" type="button" name="button" @click="onDebugButon()">DEBUG</button>
                            </div>
                            <div class="row h-50">
                                <button class="col m-1 btn  btn-primary" type="button" name="button">ITEM</button>
                                <button class="col m-1 btn  btn-primary" type="button" name="button">RUN</button>
                            </div>
                        </div>
                        <div class="col" v-if="onCommands">
                            <div class="row h-75">
                                <div class="col">
                                    <div class="row h-50">
                                        <button class="col m-1 btn  btn-primary" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[0] )" ><span v-text="commands[0]['lang']+' : '+commands[0]['name']"></span></button>
                                        <button class="col m-1 btn  btn-success" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[1] )" ><span v-text="commands[1]['lang']+' : '+commands[1]['name']"></span></button>
                                    </div>
                                    <div class="row h-50">
                                        <button class="col m-1 btn  btn-danger" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[2] )" ><span v-text="commands[2]['lang']+' : '+commands[2]['name']"></span></button>
                                        <button class="col m-1 btn  btn-warning" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[3] )" ><span v-text="commands[3]['lang']+' : '+commands[3]['name']"></span></button>    
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
    </div>

    <script src="/js/app.js"></script>
    <script>
        new Vue({
            el: '#chat',
            data: {
                onLoading: true,
                message: '',
                user_name: "{{$user_name}}",
                id: "{{$id}}",
                messages: [],
                user_id: "{{Auth::user()->id}}",
                commands: @json($cmds_now),
                isProcessing: false,
                barning: 0,
                progress: 0,
                onCommands: false,
                onDebug: false,
            },
            methods: {
                toggleBattle() {
                    this.onCommands = !this.onCommands;
                },
                onDebugButon() {
                    this.onDebug = !this.onDebug;
                    setTimeout(() => {this.onDebug = !this.onDebug;}, 5000);
                },
                getMessages() {
                    const url = "/ajax/chat/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.messages = response.data
                        });
                },
                getBars() {
                    const url = "/ajax/bar/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.barning = response.data[0];
                            this.progress = response.data[1];
                        });
                },
                getCommands() {
                    const url = "/ajax/command/"+this.user_id;
                    axios.get(url)
                        .then((response) => {
                            this.commands = response.data;
                            this.isProcessing = false;
                            this.toggleBattle();
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
                            this.isProcessing = true;
                            var params = { message: value.lang+" : "+value.name+'のコマンドを発動',user_name:this.user_name,command: value.id };
                            axios.post(url, params)
                            .then((response) => {
                                // 成功したときの処理
                                this.getCommands();
                                this.getBars();
                            });
                            break;
                    }
                    
                }
            },
            mounted() {

                this.getMessages();
                this.getBars();

                Echo.channel('chat')
                    .listen('MessageCreated', (e) => {

                        this.getMessages(); // 全メッセージを再読込

                    });
                
                this.onLoading = false;
            }
        });

    </script>
@endsection