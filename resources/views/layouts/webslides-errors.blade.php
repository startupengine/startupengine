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

    <!-- CSS Base -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/base.css">

    <!-- CSS Colors -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/colors.css">

    <!-- Optional - CSS SVG Icons (Font Awesome) -->
    <link rel="stylesheet" type='text/css' media='all' href="/css/svg-icons.css">

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
    </style>
    @yield('styles')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#333333">
</head>
<body>
<main role="main">
    @yield('content')
</main>

</body>
</html>