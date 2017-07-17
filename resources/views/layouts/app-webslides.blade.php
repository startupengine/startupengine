<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CLEAN MARKUP = GOOD KARMA.
      Hi source code lover,

      you're a curious person and a fast learner ;)
      Let's make something beautiful together. Contribute on Github:
      https://github.com/webslides/webslides

      Thanks,
      @jlantunez.
    -->

    <!-- SEO -->
    <title>@yield('title')</title>
    <meta name="description" content="WebSlides is the easiest way to make HTML presentations, portfolios, and landings. Just essential features.">

    <!-- URL CANONICAL -->
    <!-- <link rel="canonical" href="http://your-url.com/"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,700,700i%7CMaitree:200,300,400,600,700&amp;subset=latin-ext" rel="stylesheet">

    <!-- Semantic UI -->
    @include('components.semanticui')

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
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SOCIAL CARDS (ADD YOUR INFO) -->

    <!-- FACEBOOK -->
    <meta property="og:url" content="http://your-url.com/"> <!-- YOUR URL -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="WebSlides — Making HTML Presentations Easy"> <!-- EDIT -->
    <meta property="og:description" content="WebSlides is about telling stories beautifully. Just the essential features. Good karma."> <!-- EDIT -->
    <meta property="og:updated_time" content="2017-01-04T17:20:50"> <!-- EDIT -->
    <meta property="og:image" content="/images/share-webslides.jpg"> <!-- EDIT -->

    <!-- TWITTER -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@webslides"> <!-- EDIT -->
    <meta name="twitter:creator" content="@jlantunez"> <!-- EDIT -->
    <meta name="twitter:title" content="WebSlides — Making HTML Presentations Easy"> <!-- EDIT -->
    <meta name="twitter:description" content="WebSlides is about good karma. Just essential features. 120+ free slides ready to use."> <!-- EDIT -->
    <meta name="twitter:image" content="/images/share-webslides.jpg"> <!-- EDIT -->

    <!-- FAVICONS -->
    <link rel="shortcut icon" sizes="16x16" href="/images/favicons/favicon.png">
    <link rel="shortcut icon" sizes="32x32" href="/images/favicons/favicon-32.png">
    <link rel="apple-touch-icon icon" sizes="76x76" href="/images/favicons/favicon-76.png">
    <link rel="apple-touch-icon icon" sizes="120x120" href="/images/favicons/favicon-120.png">
    <link rel="apple-touch-icon icon" sizes="152x152" href="/images/favicons/favicon-152.png">
    <link rel="apple-touch-icon icon" sizes="180x180" href="/images/favicons/favicon-180.png">
    <link rel="apple-touch-icon icon" sizes="192x192" href="/images/favicons/favicon-192.png">

    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#333333">

</head>
<body>

<main role="main">
    <article>
        @yield('content')
    </article>
</main>
<!--main-->
@include('components.lightbox')

<!-- Scripts -->
@include('auth.auth0-lock')
</body>
</html>