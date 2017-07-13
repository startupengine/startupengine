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
        .ui.button.mini {
            min-width:8em !important;
            padding:10px 5px !important;
        }
    </style>
</head>
<body>
@include('components.nav-admin')
<main role="main">
    <article>
        <section class="bg-white" >
            <div class="wrap">
                <h4 class="" style="width:100%;text-align:center;margin-top:0px;margin-bottom:25px;">Analytics</h4>
                <div class="module" style="margin-left:25px;margin-right:25px;margin-bottom:25px;">
                    <div class="ui buttons " align="center" style="width:100%;padding-top:25px;">
                        <a href="?period=<?php if($period == '7') { echo "week"; }elseif($period == '30') { echo "month"; }elseif($period == '365') { echo "year"; } ?>&start=<?php echo $prev->format('m/d/Y'); ?>" class="ui left labeled icon button basic mini">
                            <i class="left chevron icon"></i>
                            Prev
                        </a>
                        <a href="/admin/analytics?period=week&start=<?php echo $prev->copy()->addDays($period)->format('m/d/Y'); ?>" class="ui button basic mini <?php if($period == '7') { echo "active"; } ?>">Week</a>
                        <a href="/admin/analytics/?period=month&start=<?php echo $prev->copy()->addDays($period)->format('m/d/Y'); ?>" class="ui button basic mini <?php if($period == '30') { echo "active"; } ?>">Month</a>
                        <a href="/admin/analytics/?period=year&start=<?php echo $prev->copy()->addDays($period)->format('m/d/Y'); ?>" class="ui button basic mini <?php if($period == '365') { echo "active"; } ?>">Year</a>
                        <a href="?period=<?php if($period == '7') { echo "week"; }elseif($period == '30') { echo "month"; }elseif($period == '365') { echo "year"; } ?>&start=<?php echo $next->format('m/d/Y'); ?>" class="ui right labeled icon button basic mini <?php if(!$next->copy()->addDay()->isPast()) { echo "disabled"; } ?>">
                            <i class="right chevron icon"></i>
                            Next
                        </a>
                    </div>
                </div>
                <div id="charts" class="grid" >
                    <div id="trafficChart" style="width:100%;margin-left:25px; margin-right:25px; padding:15px 50px 25px 50px;border-radius:2px;text-align:center;">
                        <p style="margin-bottom:0px;">{{ $daterange }}</p>
                        {!! $traffic->render() !!}
                    </div>
                    <div id="metrics" style="width:100%;padding:25px;margin:25px 25px 0px 25px">
                        <!-- li>a? Add blink = <ul class="flexblock metrics blink">-->
                        <ul class="flexblock metrics border">
                            <li>
                                Total # of Sessions
                                <span>{{ round($sessions) }}</span>
                            </li>
                            <li>
                                Total Time Spent
                                <span>{{ round($totalSessionTime/60/60) }} hrs</span>
                            </li>
                            <li>
                                Avg. Session Duration
                                <span>{{ round($avgSessionDuration/60) }} min</span>
                            </li>
                            <li>
                                Bounce Rate
                                <span>{{ round($bounceRate, 2) }}%</span>
                            </li>
                        </ul>
                    </div>
                    <div id="" class="  grid" style="width:100%;">
                        <div class="ui equal height column" >
                            <div id="" class="module" style="max-width:100%;width:100%;padding:15px 50px 25px 50px;border-radius:2px;text-align:center;">
                                <p style="margin-bottom:0px;">
                                    Visitors by Country
                                </p>
                                {!! $countries->render() !!}
                            </div>
                        </div>
                        <div class="column">
                            <div id="referrers" style="text-align:center;">
                                <p style="margin-bottom:0px;margin-top:15px;">
                                    Top Referrers
                                </p>
                                <table style="width:100%;text-align:left;">
                                    <tr><td style="background:#fff;">Page</td><td style="background:#fff;">Referrals</td></tr>
                                    <?php foreach($referrers as $source) {
                                    if($source['url'] !== '(direct)') { ?>
                                    <tr><td style="background:#fff;"><a href="http://<?php echo $source['url']; ?>"><?php echo mb_strimwidth($source['url'], 0, 40).'...'; ?></a></td><td style="background:#fff;max-width:100px !important;width:100px !important;text-align:center;"><?php echo $source['pageViews']; ?></td></tr>
                                    <?php } } ?>
                                </table>
                                <div class="ui buttons" align="center" style="width:100%;">
                                    <a href="/admin/referrers" class="ui button basic default">More</a>
                                </div>
                            </div>
                            <div class="module" align="center" style="margin-top:25px;">
                                <div class="ui buttons " align="center" style="width:100%;padding-top:25px;">
                                    <p>
                                        Currently Installed Apps
                                    </p>
                                    <?php if(config('app.ENABLE_GOOGLE_ANALYTICS')) { ?>
                                    <a href="https://analytics.google.com" class="ui button basic right labeled icon" target="_blank"  style="width:100%;text-align:left;">Google Analytics<i class="right chevron icon"></i></a>
                                    <?php } ?>
                                    <?php if(config('app.ENABLE_MIXPANEL')) { ?>
                                    <a href="https://mixpanel.com/report" class="ui button basic right labeled icon" target="_blank"  style="width:100%;text-align:left;">MixPanel<i class="right chevron icon"></i></a>
                                    <?php } ?>
                                    <a href="https://manage.auth0.com/" class="ui button basic right labeled icon" target="_blank"  style="width:100%;text-align:left;">Auth0<i class="right chevron icon"></i></a>
                                    <?php if(config('app.ENABLE_INTERCOM')) { ?>
                                    <a href="https://app.intercom.io" class="ui button basic right labeled icon" target="_blank"  style="width:100%;text-align:left;">Intercom<i class="right chevron icon"></i></a>
                                    <?php } ?>
                                    <?php if(config('app.ENABLE_DRIFT')) { ?>
                                    <a href="https://app.drift.com" class="ui button basic right labeled icon" target="_blank"  style="width:100%;text-align:left;">Drift<i class="right chevron icon"></i></a>
                                    <?php } ?>
                                    <?php if(config('app.ENABLE_MAILCHIMP')) { ?>
                                    <a href="https://admin.mailchimp.com" class="ui button basic right labeled icon" target="_blank"  style="width:100%;text-align:left;">Mailchimp<i class="right chevron icon"></i></a>
                                    <?php } ?>
                                    <?php if(config('app.ENABLE_SENTRY')) { ?>
                                    <a href="https://sentry.io" class="ui button basic right labeled icon" target="_blank" style="width:100%;text-align:left;">Sentry<i class="right chevron icon"></i></a>
                                    <?php } ?>

                                </div>
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
