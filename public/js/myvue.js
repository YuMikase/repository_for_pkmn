//----------必要な変数（配列）----------
//commands
//items


//配列をシャッフル（Fisher–Yates shuffle）して4つ返す
const shuffle = ([...array]) => {
    for (let i = array.length - 1; i >= 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return [array[0], array[1], array[2], array[3]];
}

//シャッフルして4つ取得
var cfour = shuffle(commands);



//----------コマンド用----------
var command_vue = new Vue({
    el: '#commands',
    data: {
        commands: cfour,
        user_name: "{{$user_name}}"
    },
    methods: {
        sendb(value) {
            const url = '/ajax/chat';
            const params = { message: value + 'のボタンを押した。', user_name: this.user_name, type: 'my_do' };
            axios.post(url, params)
                .then((response) => {
                    //成功したらまたランダムな4つに
                    this.commands = shuffle(commands);
                });
        }
    }
})

//----------アイテム用----------
var item_vue = new Vue({
    el: '#items',
    data: {
        noneView: true,
        items: items,
        user_name: "{{$user_name}}"
    },
    methods: {
        send_i(value) {
            const url = '/ajax/chat';
            const params = { message: value + 'のアイテムを使用した。', user_name: this.user_name, type: 'use_item' };
            axios.post(url, params)
                .then((response) => {
                    //成功後の処理
                });
        }
    }
})

//----------アクション用----------
var action_vue = new Vue({
    el: '#actions',
    data: {
        user_name: "{{$user_name}}"
    },
    methods: {
        send_a(value) {
            const url = '/ajax/chat';
            const params = { message: value + 'のアクションを起こした', user_name: this.user_name, type: 'action' };
            axios.post(url, params)
                .then((response) => {
                    //成功後の処理
                });
        },
        view_items() {
            item_vue.noneView = !item_vue.noneView;
        }
    }
})

//----------チャットメッセージ用----------
var chat_vue = new Vue({
    el: '#chat',
    data: {
        message: '',
        user_name: "{{$user_name}}",
        messages: [],
        type: '',
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
            const params = { message: 'メッセージ：' + this.message, user_name: this.user_name, type: 'my_do' };
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
})