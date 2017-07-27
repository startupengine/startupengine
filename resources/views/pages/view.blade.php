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
    <title><?php echo $page->getTitle(); ?></title>
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
    <?php if( $defaults->getLogo() !== null) { ?>
        <link rel="apple-touch-icon icon" sizes="180x180" href="{{ $defaults->getLogo()->getFile()->getUrl() }}">
    <?php } ?>
    <?php /*
    <link rel="shortcut icon" sizes="16x16" href="/images/favicons/favicon.png">
    <link rel="shortcut icon" sizes="32x32" href="/images/favicons/favicon-32.png">
    <link rel="apple-touch-icon icon" sizes="76x76" href="/images/favicons/favicon-76.png">
    <link rel="apple-touch-icon icon" sizes="120x120" href="/images/favicons/favicon-120.png">
    <link rel="apple-touch-icon icon" sizes="152x152" href="/images/favicons/favicon-152.png">
    <link rel="apple-touch-icon icon" sizes="180x180" href="/images/favicons/favicon-180.png">
    <link rel="apple-touch-icon icon" sizes="192x192" href="/images/favicons/favicon-192.png">
    */ ?>

    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#333333">
    <style>
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
        section.bg-gradient-h .button.ghost, section.bg-gradient-v .button.ghost, section.bg-gradient-r .button.ghost {
            color:#fff;
        }
        <?php } ?>
        body {
            background:#fff;
        }
    </style>
    @include('components.header-scripts')
</head>
<body>
@include('components.nav')
<main role="main">
    <article>
        <?php $count = 1; ?>
        @foreach($page->getSections() as $section)
            <?php $contentType = $section->getType(); ?>
            @include('sections.'.strtolower($contentType))
            <?php $count = $count + 1; ?>
        @endforeach
        @include('components.comments')
    </article>
</main>
<!--main-->

@include('components.footer')
@include('components.analytics')
@include('components.scripts')
@include('components.lightbox')

</body>
</html>