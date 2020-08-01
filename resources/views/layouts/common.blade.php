<html>
    @yield('content')
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
        <link href="textillate/animate.css" rel="stylesheet">
      
        @yield('head')
        <title>@yield('title')</title>
    </head>
    <body>
              
        <div class="header">
            @yield('header')
        </div>

       

        <div class="logout">
            @yield('logout')
            <form action="{{ url('logout') }}" method="post">
                @csrf
                <input type="submit" class="logout" value="LOGOUT">
              </form>
        </div>

        <div class="main">
            @yield('main')
        </div>
        
        <div class="footer">
            @yield('footer')
            <small>Respect Pokemon Copylight 2020. TeamOG</small>
        </div>

        {{-- テキストのアニメーションtextillate用 --}}
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="textillate/jquery.fittext.js"></script>
        <script src="textillate/jquery.lettering.js"></script>
        <script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script>
        <script src="textillate/jquery.textillate.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
        <script>
            $(function (){
              var log = function (msg) {
                return function () {
                  if (console) console.log(msg);
                }
              }
              $('code').each(function () {
                var $this = $(this);
                $this.text($this.html());
              })
          
              var animateClasses = 'flash bounce shake tada swing wobble pulse flip flipInX flipOutX flipInY flipOutY fadeIn fadeInUp fadeInDown fadeInLeft fadeInRight fadeInUpBig fadeInDownBig fadeInLeftBig fadeInRightBig fadeOut fadeOutUp fadeOutDown fadeOutLeft fadeOutRight fadeOutUpBig fadeOutDownBig fadeOutLeftBig fadeOutRightBig bounceIn bounceInDown bounceInUp bounceInLeft bounceInRight bounceOut bounceOutDown bounceOutUp bounceOutLeft bounceOutRight rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight rotateOut rotateOutDownLeft rotateOutDownRight rotateOutUpLeft rotateOutUpRight hinge rollIn rollOut';
          
              var $form = $('.playground form')
                , $viewport = $('.playground .viewport');
          
              var getFormData = function () {
                var data = {
                  loop: true,
                  in: { callback: log('in callback called.') },
                  out: { callback: log('out callback called.') }
                };
          
                $form.find('[data-key="effect"]').each(function () {
                  var $this = $(this)
                    , key = $this.data('key')
                    , type = $this.data('type');
          
                    data[type][key] = $this.val();
                });
          
                $form.find('[data-key="type"]').each(function () {
                  var $this = $(this)
                    , key = $this.data('key')
                    , type = $this.data('type')
                    , val = $this.val();
          
                    data[type].shuffle = (val === 'shuffle');
                    data[type].reverse = (val === 'reverse');
                    data[type].sync = (val === 'sync');
                });
          
                return data;
              };
          
              $.each(animateClasses.split(' '), function (i, value) {
                var type = '[data-type]'
                  , option = '<option value="' + value + '">' + value + '</option>';
          
                if (/Out/.test(value) || value === 'hinge') {
                  type = '[data-type="out"]';
                } else if (/In/.test(value)) {
                  type = '[data-type="in"]';
                }
          
                if (type) {
                  $form.find('[data-key="effect"]' + type).append(option);
                }
              });
          
              $form.find('[data-key="effect"][data-type="in"]').val('fadeInLeftBig');
              $form.find('[data-key="effect"][data-type="out"]').val('hinge');
          
              $('.jumbotron h1')
                .fitText(0.5)
                .textillate({ in: { effect: 'flipInY' }});
          
              $('.jumbotron p')
                .fitText(3.2, { maxFontSize: 18 })
                .textillate({ initialDelay: 1000, in: { delay: 3, shuffle: true } });
          
              setTimeout(function () {
                  $('.fade').addClass('in');
              }, 250);
          
              setTimeout(function () {
                $('h1.glow').removeClass('in');
              }, 2000);
          
              var $tlt = $viewport.find('.tlt')
                .on('start.tlt', log('start.tlt triggered.'))
                .on('inAnimationBegin.tlt', log('inAnimationBegin.tlt triggered.'))
                .on('inAnimationEnd.tlt', log('inAnimationEnd.tlt triggered.'))
                .on('outAnimationBegin.tlt', log('outAnimationBegin.tlt triggered.'))
                .on('outAnimationEnd.tlt', log('outAnimationEnd.tlt triggered.'))
                .on('end.tlt', log('end.tlt'));
          
              $form.on('change', function () {
                var obj = getFormData();
                $tlt.textillate(obj);
              }).trigger('change');
          
            });
          
              </script>
    </body>
</html>