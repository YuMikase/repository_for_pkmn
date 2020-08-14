
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

//-----------------�K�v�ȃf�[�^��blade.php�ł�datas�ϐ�����󂯎��------------------

var items = datas['items'];
var commands = datas['commands'];
var user_name = datas['user_name']; 

//�z����V���b�t���iFisher?Yates shuffle�j����4�Ԃ�
const shuffle = ([...array]) => {
    for (let i = array.length - 1; i >= 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return [array[0], array[1], array[2], array[3]];
}

//�V���b�t������4�擾
var cfour = shuffle(commands);



var app = new Vue({
    el: '#app',
    data: {
        commands: cfour,
        user_name: user_name,
        items: items,
        message: '',
        messages: []
    },
    methods: {
        send(type, value) {
            const url = '/ajax/chat';
            switch (type) {
                case "chat":
                    var params = { user_name: this.user_name, type: type, message: this.message };
                    break;
            
                default:
                    var params = { user_name: this.user_name, type: type, message: value };
                    break;
            }
            axios.post(url, params)
                .then((response) => {
                    //������̏���
                    switch (type) {
                        case "chat":
                            // ���������烁�b�Z�[�W���N���A
                            this.message = '';
                            break;
                        case "command":
                            //����������܂������_����4��
                            this.commands = shuffle(commands);
                            break;
                        default:
                            break;
                    }
                    
                });
        },
        getMessages() {
            const url = '/ajax/chat/1';
            axios.get(url)
                .then((response) => {
                    this.messages = response.data
                });
        }
    },
    mounted() {
        this.getMessages();
        Echo.channel('chat')
            .listen('MessageCreated', (e) => {
                this.getMessages(); // �S���b�Z�[�W���ēǍ�
            });
    }
});
