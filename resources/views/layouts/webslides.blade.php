<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <title>@yield('title')</title>

    <!-- META -->
    @yield('meta')

    <!-- URL CANONICAL -->
    <!-- <link rel="canonical" href="http://your-url.com/"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,700,700i%7CMaitree:200,300,400,600,700&amp;subset=latin-ext" rel="stylesheet">

    <!-- Semantic UI -->
    @include('components.semanticui')
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">

    <!-- App -->
    <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>

    <!-- Comments -->
    <link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/comment.js') }}" type="text/javascript"></script>


    <!-- CSS Base -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/base.css">

    <!-- CSS Colors -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/colors.css">

    <!-- Optional - CSS SVG Icons (Font Awesome) -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/svg-icons.css">

    <!-- Optional - Particle.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <!-- Optional - Animate On Scroll -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>

    <!-- CSS Custom -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/custom.css">

    <style>
        .auth0-lock-header{
            display:none !important;
        }
        .auth0-lock-name {
            display:none;
        }
        .auth0-lock-header-bg {
            height:80px !important;
            background:#fff !important;
        }
        .auth0-lock-widget{
            box-shadow: 0px 10px 30px rgba(0,0,0,0.15);
            border-radius:0px 0px 4px 4px !important;
        }
        .auth0-lock-tabs {
            border-radius: 4px 4px 0px 0px;
        }
        .auth0-lock-widget input {
            box-shadow:none !important;
        }

        .auth0-lock.auth0-lock .auth0-lock-tabs-container {
            margin: -20px -20px 20px !important;
            height: 55px !important;
        }
        section.bg-gradient-h .button.ghost, section.bg-gradient-v .button.ghost, section.bg-gradient-r .button.ghost{
            border-color:#fff !important;
            font-weight:normal !important;
        }
        section.bg-gradient-h .button.ghost:hover, section.bg-gradient-v .button.ghost:hover, section.bg-gradient-r .button.ghost:hover {
            color:#222 !important;
            background:#fff !important;
        }
        @media (min-width: 768px) {
            section:first-of-type {
                padding-top:100px !important;
                padding-bottom:100px !important;
            }
        }
        @media (max-width: 768px) {
            section:first-of-type {
                padding-top:75px !important;
                padding-bottom:75px !important;
            }
        }
        body {
            background:#fff;
        }
        .ui.menu .item {
            font-size:125% !important;
        }
        .column {
            padding-top:0px !important;
        }
        @media (max-width: 768px) {
            hr {
                margin-bottom:3.2rem !important;
            }
        }
        <?php if( env('COLOR1') !== null  && env('COLOR2') !== null ) { ?>
        .bg-gradient-h {
            background: linear-gradient(134deg,{{ env('COLOR1') }} 0,{{ env('COLOR2') }}  100%) !important;
        }
        .bg-gradient-v {
            background: linear-gradient(to top, {{ env('COLOR1') }} 0,{{ env('COLOR2') }}  100%) !important;
        }
        .bg-gradient-r {
            background: radial-gradient(ellipse at center, {{ env('COLOR1') }} 0%, {{ env('COLOR2') }} 100%) !important;
        }
        .button {
            background-color: {{ env('COLOR1') }} !important;
        }
        .button.ghost {
            border-color: {{ env('COLOR1') }} !important;
            color: {{ env('COLOR1') }};
            background: none !important;
        }
        <?php } ?>
        section.bg-gradient-h .button.ghost, section.bg-gradient-v .button.ghost, section.bg-gradient-r .button.ghost {
            color:#fff;
        }
        @media (min-width:768px) {
            li.article {
                max-width: 50%;
            }
        }
        body {
            background:#fff;
        }
        section:first-of-type {
            min-height:100vh !important;
        }
        #section-1 {
            min-height:100vh !important;
        }
        footer {
            background:#fff !important;
            border-top:#eee 1px solid;
            color:#222 !important;
            box-shadow:0px 0px 60px rgba(0,0,0,0.08);
        }
        footer a {
            color:#222 !important;
        }
        footer li {
            text-align:center;
        }
        footer .column {
            padding:0px !important;
        }
        nav.navbar ul li {
            -webkit-flex: 1 1 auto;
            flex: none;
            display:inline-block;
            float: left;
            width: auto;
        }
        header li a {
            width: auto;
            float: left;
            margin:3px;
            background-color:#fff !important;
            border:1px solid #eee !important;
            color: #111 !important;
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
            border-bottom:0px solid rgba(150,150,150,0.15);
            box-shadow: none !important;
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
        .longform {
            width: 100%;
            margin-top: -250px;
            background: #fff;
            padding: 30px 50px 50px 50px;
            border-radius: 5px;
            max-width: 1000px;
            box-shadow: 0px -60px 60px rgba(0,0,0,0.1) !important;
        }
        .laravelLike-icon.up{
            color: #50ae86 !important;
        }
        .laravelLike-icon.down{
            color: #c0603f !important;
            margin-left: 10px !important;
        }
        #write-comment:hover, #showComment:hover {
            box-shadow:none !important;
            border:#111 solid 1px !important;
        }
        #write-comment, #showComment, .laravelComment input[type="submit"] {
            font-size:1.25rem !important;
            text-transform: uppercase !important;
            margin-bottom:10px;
            min-width:250px;
            background:#fff !important;
        }
        #write-comment:first-of-type {
            width:calc(100% - 20px);
            margin-left:10px;
            margin-right:5px;
        }
        #showComment:first-of-type {
            width:calc(100% - 20px);
            margin-left:10px;
            border:#eee solid 1px !important;
            box-shadow:none !important;
            background:#eee !important;
        }
        .laravelComment h3.ui.header {
            text-align:center;
            font-weight:200;
            font-size:100%;
            padding-bottom:15px;
            display:none !important;
        }
        form.laravelComment-form input[type="text"] {
            width:100%;
        }
        form.laravelComment-form:first-of-type {
            padding:10px;
        }
        .laravelComment-form:first-of-type {
            display:auto !important;
        }
        .laravelComment-form textarea {
            height:100px;
        }
        .ui.threaded.comments {
            padding-right:0px !important;
            max-width:100%;
            margin:0px !important;
        }
        div.comments {
            margin-top:-45px !important;
        }
        .comment:first-of-type {
            padding-top:50px !important;
            padding-bottom:0px !important;
        }
        @media (max-width: 768px) {
            header{
                padding-left:0px !important;
                padding-right:0px !important;
            }
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
            background:#222;
            z-index:999999999999999999999;
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
    <style>
        {!! html_entity_decode(setting('site.global_css')) !!}
    </style>
    @yield('styles')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FAVICONS -->
    <?php if( setting('site.logo') !== null) { ?>
    <link rel="apple-touch-icon icon" sizes="180x180" href="{{ \Storage::disk('public')->url( setting('site.logo') ) }}">
    <?php }  ?>

    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#333333">
    @include('components.header-scripts')
</head>
<body>
@include('components.nav')
<main role="main" id="app">
    @yield('content')
</main>
@include('components.sidebar')

<!-- Scripts -->
@include('components.footer')
@include('components.analytics')
@include('components.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js"></script>
<script>
    var slideout = new Slideout({
        'panel': document.getElementById('app'),
        'menu': document.getElementById('menu'),
        'padding': 375,
        'tolerance': 70,
        'side': 'right'
    });
</script>
@include('components.lightbox')
</body>
</html>