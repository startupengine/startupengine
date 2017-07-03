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
            <div class="wrap" align="center" style="max-width:77%;">
                <h3 align="center"><?php echo Lang::get('app.enter_credentials'); ?></h3>
                <p><?php echo Lang::get('app.credentials_help'); ?></p>
                <form action="/install" method="post" >
                    <ul class="flexblock" >
                        <li style="text-align: center;"><label>Space ID</label><input type="CONTENTFUL_SPACE_ID" tabindex="1" name="CONTENTFUL_SPACE_ID" placeholder="Contentful Space ID" required="" value="<?php echo config('app.CONTENTFUL_SPACE_ID'); ?>"></li>
                        <li style="text-align: center;"><label>API Key</label><input type="CONTENTFUL_API_KEY" tabindex="2" name="CONTENTFUL_API_KEY" placeholder="Contentful API Key" required="" value="<?php echo config('app.CONTENTFUL_API_KEY'); ?>"></li>
                        <li style="text-align: center;"><label>Management Token</label><input type="CONTENTFUL_MANAGEMENT_TOKEN" tabindex="2" name="CONTENTFUL_MANAGEMENT_TOKEN" placeholder="Management Token" required="" value="<?php echo config('app.CONTENTFUL_MANAGEMENT_TOKEN'); ?>"></li>
                        {{ csrf_field() }}
                    </ul>
                    <div align="center"><button type="submit" class="radius" tabindex="3" title="Submit" style="max-width:200px;">Continue ›</button></div>
                </form>
        </section>
    </article>
</main>

@include('components.footer')
@include('components.analytics')

</body>
</html>
