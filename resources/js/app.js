
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//-----------------必要なデータをblade.phpでのdatas変数から受け取り------------------

var items = datas['items'];
var commands = datas['commands'];
var user_name = datas['user_name']; 

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



var app = new Vue({
    el: '#app',
    data: {
        commands: cfour,
        user_name: user_name,
        noneView: true,
        items: items,
        message: '',
        messages: [],
        type: ''
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
        },
        send_i(value) {
            const url = '/ajax/chat';
            const params = { message: value + 'のアイテムを使用した。', user_name: this.user_name, type: 'use_item' };
            axios.post(url, params)
                .then((response) => {
                    //成功後の処理
                });
        },
        send_a(value) {
            const url = '/ajax/chat';
            const params = { message: value + 'のアクションを起こした', user_name: this.user_name, type: 'action' };
            axios.post(url, params)
                .then((response) => {
                    //成功後の処理
                });
        },
        view_items() {
            this.noneView = !this.noneView;
        },
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
});
