<html>
    @yield('content')
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('head')
        <title>@yield('title')</title>
    </head>
    <body>
        
        
        <div>
            @yield('header')
            <h>THIS IS A HEADER</h>
        </div>

        <div>
            @yield('main')
        </div>
        
        <div>
            @yield('footer')
            <small>THIS IS A FOOTER</small>
        </div>
    </body>
</html>