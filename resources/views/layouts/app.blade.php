<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StartupEngine') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- CSS Custom -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/custom.css">
    <style>
        body {
            background:#fff;
        }
        header li a {
            width: auto;
            float: left;
            margin:3px;
            background-color:transparent !important;
            border:1px solid #fff !important;
            color: #fff !important;
            padding: 0px 10px !important;
            font-size: 14px !important;
            line-height: 25px !important;
            margin-bottom: -20px !important;
            border-radius: 25px !important;
        }
        header li:hover a {
            background: #5555ff !important;
            border:1px solid #5555ff !important;
            color: #fff !important;
        }
        header ul {
            float:right;
        }
        header {
            padding:15px !important;
            background:#222 !important;
            border-bottom:1px solid rgba(150,150,150,0.4);
            box-shadow: 0px 0px 60px rgba(0,0,0,0.1) !important;
        }
        header[role=banner] img {
            height: 5rem !important;
        }
        header ul {
            list-style: none !important;
        }
        header li {
            float:left;
        }
        header li a {
            text-decoration: none !important;
        }
        header {
            font-family:'Roboto' !important;
            font-weight:300 !important;
            font-size:18px;
        }
        #site-title {
            color:#fff !important;
            background:none !important;
        }
        a, a:hover {
            text-decoration:none !important;
        }
        @media (max-width: 768px) {
            header{
                padding-left:10px !important;
                padding-right:0px !important;
            }
        }
        header ul:nth-of-type(2) {
            margin-top:0px !important;
        }
        #chatter_hero, #help_header {
            box-shadow: 0px 0px 50px rgba(0,0,0,0.35) !important;
        }
        body {
            width: 100%;
            height: 100%;
        }

        .slideout-menu {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 375px;
            min-height: 100vh;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
            z-index: 0;
            display: none;
            background:#222;
            box-shadow:0px 0px 30px rgba(0,0,0,0.5) !important;
            border-left:1px solid rgba(255,255,255,0.1);
        }

        .slideout-menu-left {
            left: 0;
        }

        .slideout-menu-right {
            right: 0;
        }

        .slideout-panel {
            position: relative;
            z-index: 1;
            will-change: transform;
            background-color: #FFF; /* A background-color is required */
            min-height: 100vh;
        }

        .slideout-open,
        .slideout-open body,
        .slideout-open .slideout-panel {
            overflow: hidden;
        }

        .slideout-open .slideout-menu {
            display: block;
        }
        .slideout-menu header {
            height:75px;
            padding-left:0px !important;
            border-bottom:1px solid rgba(255,255,255,0.1);
        }
        #menu-close-button {
            color:#fff;
            position:absolute;
            right:28px;
            top:23px;
            float:right;
            font-size:14px;
            border:1px solid #fff;
            padding:3px 10px;
            border-radius:25px;
        }
        .slideout-menu ul {
            list-style: none;
            margin-top:25px;
            padding:0px;
        }
        .slideout-menu li {
            margin-bottom:10px;
            text-align: center;
        }
        .slideout-menu li a {
            color:#fff;
            font-size:21px;
            line-height:25px;
        }
    </style>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,700,700i%7CMaitree:200,300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
    @yield('css')

    <!-- FAVICONS -->
    <?php if( setting('site.logo') !== null) { ?>
    <link rel="apple-touch-icon icon" sizes="180x180" href="{{ \Storage::disk('public')->url( setting('site.logo') ) }}">
    <?php }  ?>

</head>
<body>
    <div id="app" >
        @include('components.nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')

</body>
</html>