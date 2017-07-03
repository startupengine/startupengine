<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <title><?php echo Lang::get('app.app_install').' '.Lang::get('app.app_title'); ?></title>
    <meta name="description" content="<?php echo Lang::get('app.app_description'); ?>">

    <!-- URL CANONICAL -->
    <!-- <link rel="canonical" href="http://your-url.com/"> -->

@include('components.styles')

<!-- SOCIAL CARDS (ADD YOUR INFO) -->

    <!-- FACEBOOK -->
    <meta property="og:url" content="http://your-url.com/"> <!-- YOUR URL -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo Lang::get('app.app_title'); ?>"> <!-- EDIT -->
    <meta property="og:description" content="<?php echo Lang::get('app.app_description'); ?>"> <!-- EDIT -->
    <meta property="og:updated_time" content="2017-01-04T17:20:50"> <!-- EDIT -->
    <meta property="og:image" content="/images/share-webslides.jpg"> <!-- EDIT -->

    <!-- TWITTER -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@webslides"> <!-- EDIT -->
    <meta name="twitter:creator" content="@jlantunez"> <!-- EDIT -->
    <meta name="twitter:title" content="<?php echo Lang::get('app.app_title'); ?>"> <!-- EDIT -->
    <meta name="twitter:description" content="<?php echo Lang::get('app.app_description'); ?>"> <!-- EDIT -->
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
        <section class="bg-light">
            <div class="wrap" align="center">
                <h3 align="center"><?php echo Lang::get('app.import_complete'); ?></h3>
                <p><?php echo Lang::get('app.import_complete_message'); ?></p>
                <a href="/" class="button radius"><?php echo Lang::get('app.view_site'); ?></a>
                <a href="http://app.contentful.com" class="button radius ghost" target="_blank"><?php echo Lang::get('app.manage_content'); ?></a>
        </section>
    </article>
</main>

@include('components.footer')
@include('components.analytics')

</body>
</html>
