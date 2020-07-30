<html>
    @yield('content')
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
        @yield('head')
        <title>@yield('title')</title>
    </head>
    <body>
        
        
        <div class="header">
            @yield('header')
        </div>

        <div class="main">
            @yield('main')
        </div>
        
        <div class="footer">
            @yield('footer')
            <small>Rispect Pokemon Copylight 2020. TeamOG</small>
        </div>
    </body>
</html>