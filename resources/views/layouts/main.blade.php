<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Multben | @yield('title')
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Multben - Tenha Seu Estabelecimento Visto!">
    <meta name="keywords" content="multben, multi-benefícios, multi-benefícios, benefícios, estabelecimentos, lojas, emrpesas, empreendimentos">
    <meta name="author" content="Rokaux">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/x-icon" href="{{asset('unishop/favicon.ico')}}">
    <link rel="icon" type="image/png" href="{{asset('unishop/favicon.png')}}">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png')}}">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{asset('unishop/css/vendor.min.css')}}">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('unishop/css/styles.min.css')}}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    @yield('css')

    @show
	<script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="{{ asset('js/mascara.min.js') }}"></script>
    <!-- Modernizr-->
    <script src="{{asset('unishop/js/modernizr.min.js')}}"></script>

  </head>
  <!-- Body-->
  <body>

    @include('layouts.off_canvas')
    @include('layouts.off_canvas_mobile')
    @include('layouts.topbar')
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    </div>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="{{asset('unishop/js/vendor.min.js')}}"></script>
    <script src="{{asset('unishop/js/scripts.min.js')}}"></script>
	<script src="{{asset('js/card.min.js')}}"></script>
    <script>
        $(document).ready(function(){
          $('#site_search').keypress(function () {
              $.ajax({
                  method:"POST",
                  data:{
                      texto:$(this).val(),
                      "_token": "{{ csrf_token() }}"
                  },
                  url:"/pesquisar",
                  dataType:"html",
                  beforeSend:function(){
                      $("#result-search").html('BUSCANDO...');
                  },
                  success:function(o){
                      $("#result-search").html(o);
                  }
              });
          });

          $('.toast').toast('show');
        });
    </script>

    @yield('js')

    @show

  </body>
</html>
