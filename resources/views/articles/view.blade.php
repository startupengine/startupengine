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
    <title><?php echo $article->getTitle(); ?></title>
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

</head>
<body>
@include('components.nav')
<main role="main">
    <article>
        <section class="<?php echo $splash; ?>">
            <!-- Overlay/Opacity: [class*="bg-"] > .background.dark or .light -->
            <span class="background dark" style="background-image:url('<?php echo $article->getFeaturedImage(); ?>')"></span>
            <!--.wrap = container width: 90% -->
            <div class="wrap zoomIn" align="center" style="padding:75px 10%;min-width:300px;">
                <h1 style="margin-bottom:15px;">
                    <strong><?php echo $article->getHeadline(); ?></strong>
                </h1>
                <?php if($article->getSubtitle() !== NULL && $article->getSubtitle() !== '') { ?><div class="text-subtitle"><?php echo @markdown($article->getSubtitle()); ?></div><?php } ?>
                <p>
                    <?php $headerCTA = $article->getHeaderCta(); if($headerCTA == NULL) { $headerCTA = 'Read Article'; } ?>
                    <a href="#section-1" class="button radius <?php if(\Request::capture()->getRequestUri() == '/') { echo "ghost"; } ?>  ga-track" data-ga-text="{{ $headerCTA }}" title="{{ $headerCTA }}">
                        {{ $headerCTA }}
                    </a>
                </p>
            </div>
            <!-- .end .wrap -->
        </section>
        <?php $count = 1; ?>
        @foreach($article->getSections() as $section)
            <?php $contentType = $section->getContentType()->getId(); ?>
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
@include('components.mobilenav')

</body>
</html>
