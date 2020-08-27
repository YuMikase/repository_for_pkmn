@extends('layouts.app')

@section('content')
    <div id="shop">
        <h1>SHOP</h1>
        <div class="list-group">
            @forelse ($items as $item)
                <button class="list-group-item list-group-item-action" @click='buy({{ $item['id'] }})'>
                    <span class="badge badge-light">{{ $item['type'] }}</span>
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
                buy(item_id) {
                    var params = { item_id: item_id};
                    axios.post("/shop", params)
                        .then((response) => {
                            //成功時処理
                        });
                }
            },
            mounted() {
            }
        });

    </script>
@endsection