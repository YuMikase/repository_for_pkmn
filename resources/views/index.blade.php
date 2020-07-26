<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        {{-- USE PUSHER --}}
        <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        	
        <div id="message">

        </div>

        <script>
        Pusher.logToConsole = true;
        
        const pusher = new Pusher('{{$pusher_app_key}}', {
            cluster: '{{$pusher_app_cluster}}',
            forceTLS: true
        });

        const channel = pusher.subscribe(`my-channel`);
        channel.bind('my-event', (data) => {
        alert(JSON.stringify(data));
        $("#message").html('<p>'+ JSON.stringify(data) +'</p>');
        $("#message_list").prepend('<li>'+JSON.stringify(data)+'</li>');
        });


        //メッセージをポスト
        

        $(function() {
            $("#form1").submit(function() {
            var val = {
                "user": "default_user",
                "message": $('#form1 [name=message]').val()
            };
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.ajax({	
                url:"{{ url('/test2') }}",
                type:"post",
                contentType: "application/json",
                data:JSON.stringify(val),
                dataType:"json",
                }).done(function(data1,textStatus,jqXHR) {
                    $("#p4").text(jqXHR.status); //例：200
                    console.log(data1);
                    $("#p5").text(JSON.stringify(data1));
                    $("#message_list").prepend('<li>'+JSON.stringify(data1)+'</li>');
                }).fail(function(jqXHR, textStatus, errorThrown){
                    $("#p4").text("err:"+jqXHR.status); //例：404
                    $("#p5").text(textStatus); //例：error
                    $("#p6").text(errorThrown); //例：NOT FOUND
                }).always(function(){
                });
            //formの中身をリセット
            $('#form1')[0].reset();
            $('#formtext').focus();

            //画面遷移を食い止める
            return false;
            });
        });
        </script>
        

        <p id="p4">p4</p>
        <p id="p5">p5</p>
        <p id="p6">p6</p>
        <form id="form1">
            <input  id="formtext" type="text" name="message" />
            <input type="submit" value="送信">
        </form>

        <ul id="message_list">
            @if ($chats)
                @foreach ($chats as $chat)
                    <li>{{ $chat }}</li>
                @endforeach
            @endif
        </ul>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
