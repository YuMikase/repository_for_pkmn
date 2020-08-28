@extends('layouts.app')

@section('content')
    <div id="shop">
        <h1>SHOP</h1>
        <div class="list-group">
            <button class="list-group-item list-group-item-action" v-for="i in items">
                <div @click='buy(i.id)' class="row">
                    <div class="col-2"><span class="badge badge-light" v-text="i.type"></span></div>
                    <div class="col-8"><span v-text="i.name"></span></div>
                    <div class="col-2"><span class="badge badge-light" v-text="has_items[i.id]"></span></div>
                </div>
            </button>
        </div>
        

    </div>

    <script src="/js/app.js"></script>
    <script>

        new Vue({
            el: '#shop',
            data: {
                user: @json($user),
                items: @json($items),
                has_items: {}
            },
            methods: {
                buy(item_id) {
                    var params = { item_id: item_id};
                    axios.post("/shop", params)
                        .then((response) => {
                            //成功時処理
                            this.getItems();
                        });
                },
                getItems() {
                    axios.get("shop/"+this.user['id'])
                        .then((response) => {
                            this.has_items = response.data;
                        });
                }
            },
            mounted() {
                this.getItems();
            }
        });

    </script>
@endsection