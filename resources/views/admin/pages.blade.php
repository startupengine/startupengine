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
    <title>Analytics</title>
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

    <!-- Charts -->
    {!! Charts::assets() !!}

    <style>
        #charts svg {
            overflow:visible;
        }
        td, th, tr {
            border-color:transparent !important;
            border-bottom:1px solid #ddd !important;
            overflow:hidden !important;
            max-width:100%;
            text-transform: none;
        }
        @media only screen and (max-width: 1024px) {
            table {
                table-layout: fixed;
                border-collapse: collapse;
                width: 100%;
                max-width: 100%;
            }

            td {
                background: #F00;
                padding: 20px;
                overflow: hidden;
                white-space: nowrap;
                width: 100%;
                border: solid 1px #000;
            }
            #trafficChart {
                margin:0px 25px 0px 25px !important;
                padding:0px !important;
                box-shadow:none !important;
            }
            #popular, #referrers {
                margin-top:10px;
                margin-bottom:0px;
            }
            #popular, #referrers, #trafficChart, #metrics {
                box-shadow:0px 10px 30px rgba(0,0,0,0.05);
                border:1px solid #ddd !important;
                padding:0px 25px 25px 25px;
                border-radius:4px !important;
                overflow:hidden;
                font-size:66% !important;
            }
            #metrics span {
                font-size:166%;
                padding:0px;
                margin:10px;
                line-height:25px;
                font-weight:bold;
            }
            #metrics li {
                padding:10px !important;
            }
            .column {
                margin-bottom:0px !important;
                padding-bottom:0px !important;
            }
        }
        #popular, #referrers, #trafficChart, #metrics, .module {
            box-shadow:0px 10px 30px rgba(0,0,0,0.05);
            border:1px solid #ddd !important;
            padding:0px 25px 25px 25px;
            border-radius:4px !important;
            overflow:hidden;
        }
        table {
            margin-top:0px !important;
        }
        @media only screen and (max-width: 1024px) and (min-width: 768px) {
            nav li a .hiddenOnTablet {
                display:none;
            }
        }
        @media only screen and (max-width: 1024px) and (min-width: 768px) {
            .visibleOnTablet {
                display: block !important;
            }
        }

        .ui.buttons .ui.button {
            float:none;
            font-size:90%;
            border-radius:4px !important;
            margin-bottom:5px;
        }
        .ui.button:hover {
            border:none !important;
            text-shadow:none !important;
        }
        .ui.button.basic {
            background: #eee !important;
            color:#222 !important;
        }
        .ui.button.basic.active {
            background: #4444dd !important;
            color:#fff !important;
        }
        .ui.button.basic:hover, .ui.button.basic.active:hover {
            background: #444 !important;
            color:#fff !important;
        }
    </style>
</head>
<body>
@include('components.nav-admin')
<main role="main">
    <article>
        <section class="bg-white" >
            <div class="wrap">
                <h4 class="" style="width:100%;text-align:center;margin-top:0px;margin-bottom:25px;">Pages</h4>
                <div id="charts" class="grid">
                    <div class="column">
                        <div id="popular">
                            <table >
                                <th colspan="2" style="text-align:center;">Most Popular Pages</th>
                                <tr><td style="background:#fff;">Page</td><td style="background:#fff;max-width:100px !important;width:100px !important;text-align:center;">Views</td></tr>
                                <?php foreach($popular as $page) { ?>
                                <tr><td style="background:#fff;"><a href="<?php echo $page['url']; ?>"><?php echo $page['pageTitle']; ?></a></td><td style="background:#fff;max-width:100px !important;width:100px !important;text-align:center;"><?php echo $page['pageViews']; ?></td></tr>
                                <?php } ?>
                            </table>
                            <div class="ui buttons" align="center" style="width:100%;">
                                <a href="/admin/pages/popular" class="ui button basic default active">Show More</a>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div id="referrers">
                            <table style="width:100%;">
                                <th colspan="2" style="text-align:center;">Top Referrers</th>
                                <tr><td style="background:#fff;">Page</td><td style="background:#fff;">Referrals</td></tr>
                                <?php foreach($referrers as $source) {
                                if($source['url'] !== '(direct)') { ?>
                                <tr><td style="background:#fff;"><a href="http://<?php echo $source['url']; ?>"><?php echo mb_strimwidth($source['url'], 0, 40).'...'; ?></a></td><td style="background:#fff;max-width:100px !important;width:100px !important;text-align:center;"><?php echo $source['pageViews']; ?></td></tr>
                                <?php } } ?>
                            </table>
                            <div class="ui buttons" align="center" style="width:100%;">
                                <a href="/admin/referrers" class="ui button basic default active">Show More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
</main>
<!--main-->
@include('components.mobilenav-admin')

<!-- OPTIONAL - svg-icons.js (fontastic.me - Font Awesome as svg icons) -->
<script defer src="/js/svg-icons.js"></script>

</body>
</html>
