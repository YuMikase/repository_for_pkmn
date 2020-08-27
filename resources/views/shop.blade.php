@extends('layouts.app')

@section('content')
    <div id="shop">
        <div class="list-group">
            @forelse ($items as $item)
                <button class="list-group-item list-group-item-action">
                    {{ $item['name'] }}
                    <span class="badge badge-light">{{ count($user->has_item->where('item_id', $item['id'])->toArray()) }}</span>
                </button>
            @empty
                <span class="list-group-item list-group-item-action">アイテムは存在しない。</span>
            @endforelse
        </div>
        

    </div>

    <script src="/js/app.js"></script>
    <script>

        new Vue({
            el: '#shop',
            data: {
                user: @json($user)
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

                    console.log(this.user);

            }
        });

    </script>
@endsection