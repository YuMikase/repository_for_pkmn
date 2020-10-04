@extends('layouts.app')

<style>
    .noMoney {
        text-decoration: line-through;
        color: red;
    }
</style>

@section('content')
    <div id="chat">

        <div v-if="onLoading" class="container-fluid" style="background-color: white;z-index: 5000; width:100vw; height: 100vh;">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary m-5" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div v-if="matterEnded" style="background-color: white;">
            <span>この案件は終了しました。</span><br>
            <br>
            <span><input type="button" onClick="result()" value="リザルト画面に飛ぶ" class="btn btn-primary"></span>
        </div>

        <div v-if="!matterEnded">
            <div class="container-fluid">
                <div class="row h-75">
                    {{-- 敵味方画像 --}}
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 m-1 border">
                        <div class="row m-1">
                            <div class="col-6">
    
                                {{-- タイトル、進捗ゲージ --}}
                                <div class="card" style="background-color: rgba(0, 0, 0, 0); border:none;">
                                    
                                    <span class="text-center" style="font-size: clamp(3vw, 16px, 5vw);">{{ config('rate_type')[$matter['rate_type']]['name'] }}の案件</span>
                                        <div class="row mt-1">
                                            <div class="col">
                                                <span class="badge badge-light float-left">工数</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" v-bind:style="'width:'+time+'%'" v-bind:aria-valuenow="time" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col">
                                                <span class="badge badge-light float-left">進捗</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info" role="progressbar" v-bind:style="'width:'+progress+'%'" v-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col" v-if="onDebug">
                                                <span class="badge badge-light float-left">炎上</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger" role="progressbar" v-bind:style="'width:'+barning+'%'" v-bind:aria-valuenow="barning" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <img class="img-fluid" src="{{ asset('/img/arrowL.png') }}" alt="">
                                    
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card" style="background-color: rgba(0, 0, 0, 0); border:none;">
                                    <img class="card-img m-auto" style="width: clamp(100px, 100%, 200px);" alt="ロゴ" v-bind:src="enemyImg">
                                    <div class="card-img-overlay">
                                        <p class="text-center" style="color:rgba(255, 255, 255, 0.585); font-size: clamp(3vw, 16px, 5vw);">MATTER</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row m-1">
                            <div class="col-6">
                                <div class="card" style="background-color: rgba(0, 0, 0, 0); border:none;">
                                    <img class="card-img m-auto" style="width: clamp(100px, 100%, 200px);" alt="ロゴ" v-bind:src="meImg">
                                    <div class="card-img-overlay">
                                        <p class="text-center" style="color:rgba(255, 255, 255, 0.585); font-size: clamp(3vw, 16px, 5vw);">YOU</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card mt-5" style="background-color: rgba(0, 0, 0, 0); border:none;">
                                    <span class="text-center" style="font-size: clamp(2vw, 16px, 5vw);">{{ $user_name }}</span>
                                    <img class="img-fluid" alt="ロゴ" src="{{ asset('/img/arrowLr.png') }}">
                                </div>
                            </div>
                        </div>
    
                        <div class="row h-25 m-1">
                            <div class="card card-scroll col-12">
                                <ul class="list-group list-group-flush" style="overflow-y: scroll; max-height: 100px;">
                                    <li class="list-group-item p-1 m-1" v-for="m in messages">
                                        <span style="font-size: 10px;" v-text="m.created_at+' : user_name : '+m.user_name"></span>
                                        <br>
                                        <span v-text="m.body"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
    
                    {{-- インフォメーション＋コマンド --}}
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                        <div class="row h-100">
                            {{-- インフォメーション --}}
                            <div class="col-12 h-25 order-2 order-md-1 border m-1">
                                    <div class="row h-25 m-1"><span v-text='infoTitle' style="font-size:16px;"></span></div>
                                    <div class="row h-75 m-1"><span v-text='infoText' style="font-size:12px;"></span></div>
                            </div>
                            {{-- コマンド --}}
                            <div class="col-12 h-75 order-1 order-md-2 border m-1">
                                <div class="row h-100" v-if="!onCommands && !onItems">
                                    <div class="col">
                                        <div class="row h-50">
                                            <button class="col m-1 btn  btn-primary" type="button" name="button" @click="toggleBattle()" v-on:mouseover="infoLoad('BATTLE', 'バトルアクション。コマンド選択へ進む。')" v-on:mouseleave="infoLoad()">BATTLE</button>
                                        <button class="col m-1 btn  btn-primary" type="button" name="button" @click="onDebugButon()" v-bind:disabled="onDebug" v-on:mouseover="infoLoad('DEBUG', 'デバッグアクション。炎上度を 5 秒間確認することができる。また、工数が 1 進む。')" v-on:mouseleave="infoLoad()">DEBUG</button>
                                        </div>
                                        <div class="row h-50">
                                            <button class="col m-1 btn  btn-primary" type="button" name="button" @click="toggleItem()" v-on:mouseover="infoLoad('ITEM', 'アイテムアクション。アイテム選択へ進む。')" v-on:mouseleave="infoLoad()">ITEM</button>
                                            <button class="col m-1 btn  btn-primary" type="button" name="button" onClick="home()" v-on:mouseover="infoLoad('BACK', 'ホーム画面へ戻る。')" v-on:mouseleave="infoLoad()">BACK</button>
                                        </div>
                                    </div>
                                </div>
                                
        
                                <div class="row h-100" v-if="onCommands">
                                    <div class="col">
                                        <div class="row h-75">
                                            <div class="col">
                                                <div class="row h-50">
                                                    <button class="col m-1 btn  btn-primary" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[0] )" v-on:mouseover="infoLoad(commands[0]['name'], '工数を' + commands[0]['time'] + '進めて進捗度を ' + commands[0]['progress'] + ' 進める。また、炎上度を ' + commands[0]['barning'] + ' 進める。')" v-on:mouseleave="infoLoad()"><span v-text="commands[0]['name']"></span></button>
                                                    <button class="col m-1 btn  btn-success" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[1] )" v-on:mouseover="infoLoad(commands[1]['name'], '工数を' + commands[1]['time'] + '進めて進捗度を ' + commands[1]['progress'] + ' 進める。また、炎上度を ' + commands[1]['barning'] + ' 進める。')" v-on:mouseleave="infoLoad()"><span v-text="commands[1]['name']"></span></button>
                                                </div>
                                                <div class="row h-50">
                                                    <button class="col m-1 btn  btn-danger" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[2] )" v-on:mouseover="infoLoad(commands[2]['name'], '工数を' + commands[2]['time'] + '進めて進捗度を ' + commands[2]['progress'] + ' 進める。また、炎上度を ' + commands[2]['barning'] + ' 進める。')" v-on:mouseleave="infoLoad()"><span v-text="commands[2]['name']"></span></button>
                                                    <button class="col m-1 btn  btn-warning" type="button" name="button" v-bind:disabled="isProcessing" @click="send('command', commands[3] )" v-on:mouseover="infoLoad(commands[3]['name'], '工数を' + commands[3]['time'] + '進めて進捗度を ' + commands[3]['progress'] + ' 進める。また、炎上度を ' + commands[3]['barning'] + ' 進める。')" v-on:mouseleave="infoLoad()"><span v-text="commands[3]['name']"></span></button>    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row h-25">
                                            <button class="col m-1 btn  btn-secondary" type="button" name="button" v-bind:disabled="isProcessing" @click="toggleBattle()" v-on:mouseover="infoLoad('RETURN', 'アクション選択へ戻る。')" v-on:mouseleave="infoLoad()">RETURN</button>
                                        </div>
                                    </div>
                                </div>


                                {{-- アイテム --}}
                                <div class="row h-100" v-if="onItems">
                                    <div class="col">
                                        <div class="row" style="height: 250px; overflow-y: scroll;">
                                            <div class="list-group m-1 w-100">
                                                <button class="list-group-item list-group-item-action" v-for="i in items" v-bind:disabled="onUse || ( has_items[i.id] <= 0 )">
                                                    <div @click='useItem(i.id)' class="row" v-on:mouseover="infoLoad(i.name, i.explain)" v-on:mouseleave="infoLoad()" v-bind:class="{ noMoney: (has_items[i.id] <= 0) }">
                                                        <div class="col-2"><span class="badge badge-light" v-text="i.type"></span></div>
                                                        <div class="col-8"><span v-text="i.name"></span></div>
                                                        <div class="col-2"><span class="badge badge-light" v-text="has_items[i.id]"></span></div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row h-25">
                                            <button class="col m-1 btn  btn-secondary" type="button" name="button" v-bind:disabled="isProcessing" @click="toggleItem()" v-on:mouseover="infoLoad('RETURN', 'アクション選択へ戻る。')" v-on:mouseleave="infoLoad()">RETURN</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                
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
                message: '',
                user_name: "{{$user_name}}",
                id: "{{$id}}",
                messages: [],
                user_id: "{{Auth::user()->id}}",
                commands: @json($cmds_now),
                isProcessing: false,
                onLoading: true,
                onCommands: false,
                onDebug: false,
                matterEnded: false,
                onItems: false,
                onUse: false,
                barning: 0,
                progress: 0,
                time: 0,
                user: @json($user->toArray()),
                items: @json($items),
                has_items: {},
                money:'',
                color: 'black',
                infoTitle: '',
                infoText: '',
                enemyImg: '/img/normal.png',
                meImg: '/img/normal.png',
            },
            methods: {
                toggleBattle() {
                    this.onCommands = !this.onCommands;
                },
                toggleItem() {
                    this.onItems = !this.onItems;
                },
                onDebugButon() {
                    this.onDebug = !this.onDebug;
                    var params = { matter_id:this.id };
                    axios.post("/ajax/debug", params)
                        .then((response) => {
                            //成功時処理
                            setTimeout(() => {this.onDebug = !this.onDebug;}, 5000);
                        });
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
                            this.time = response.data[2];
                        });
                },
                getImg() {
                    const url = "/ajax/img/"+this.id;
                    axios.get(url)
                        .then((response) => {
                            this.enemyImg = response.data[0];
                            this.meImg = response.data[1];
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
                getHasItems() {
                    axios.get("../../getHasItems")
                        .then((response) => {
                            this.has_items = response.data;
                            this.onUse = false;
                        });
                },
                getHasMoney() {
                    axios.get("../../getHasMoney")
                        .then((response) => {
                            this.money = response.data;
                            if ( this.money < 0 ){ this.color = 'red'; }
                        });
                },
                useItem(item_id) {
                    this.onUse = true;
                    var params = { item_id: item_id,matter_id:this.id};
                    axios.post("/shop/use", params)
                        .then((response) => {
                            //成功時処理
                            this.getHasItems();
                        });
                    const url = "/ajax/command/"+this.user_id;
                    axios.get(url)
                        .then((response) => {
                            this.commands = response.data;
                        });
                },
                infoLoad(title, text) {
                    this.infoTitle = title;
                    this.infoText = text;
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
                                this.getHasMoney();
                                this.getImg();
                            });
                            break;
                    }
                    
                }
            },
            mounted() {

                this.getMessages();
                this.getBars();
                this.getHasItems();
                this.getHasMoney();
                this.getImg();

                Echo.channel('chat')
                    .listen('MessageCreated', (e) => {
                        
                        this.getMessages(); // 全メッセージを再読込
                        this.getBars();
                        this.getImg();

                    });
                Echo.channel('chat'+this.id)
                    .listen('MatterEnded', (e) => {
                        this.matterEnded = true;
                    });
                
                this.onLoading = false;
            }
        });

        function result(){
            location.href = "../../result/{{$id}}";
        };
        function home(){
            location.href = "../../home";
        };
    </script>
@endsection