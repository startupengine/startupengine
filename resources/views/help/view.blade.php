@extends('layouts.webslides')

@section('title')<?php echo $page->getTitle(); ?>@endsection

@section('meta')
    <meta name="description" content="<?php echo $page->getContent(); ?>">
    <!-- SOCIAL CARDS (ADD YOUR INFO) -->

    <!-- FACEBOOK -->
    <meta property="og:url" content="{{ \Request::url() }}"> <!-- YOUR URL -->
    <meta property="og:type" content="help">
    <meta property="og:title" content="<?php echo $page->getTitle(); ?>"> <!-- EDIT -->
    <meta property="og:description" content="<?php echo $page->getContent(); ?>"> <!-- EDIT -->
    <meta property="og:updated_time" content="{{ \Carbon\Carbon::now()->toFormattedDateString() }}"> <!-- EDIT -->
    <meta property="og:image" content="<?php if($page->getFeaturedImage() !== null) { echo $page->getFeaturedImage()->getFile()->getUrl(); } ?>"> <!-- EDIT -->

    <!-- TWITTER -->
    <meta name="twitter:card" content="<?php if($page->getFeaturedImage() !== null) { echo $page->getFeaturedImage()->getFile()->getUrl(); } ?>">
    <meta name="twitter:title" content="<?php echo $page->getTitle(); ?>"> <!-- EDIT -->
    <meta name="twitter:description" content="<?php echo $page->getContent(); ?>"> <!-- EDIT -->
    <meta name="twitter:image" content="<?php if($page->getFeaturedImage() !== null) { echo $page->getFeaturedImage()->getFile()->getUrl(); } ?>"> <!-- EDIT -->
@endsection

@section('content')
    <article>
        <section class="bg-white" style="min-height:auto !important;">
            <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
            <div class="wrap">
                <h2 align="center"> {{ $page->getTitle() }}</h2>
                <hr>
                <div class="grid sm">
                    <div class="column doc-menu hiddenOnMobile">
                        <h3 align="center">Browse Help</h3>
                        <?php if($defaults !== null && $defaults->getHelpMenu() !== null) { ?>
                        <div class="ui menu vertical fluid ">
                            <?php foreach($defaults->getHelpMenu()->getItems() as $item) { ?>
                            <a href="/help/{{ $item->getSlug() }}" class="item <?php if($page->getSlug() == $item->getSlug() ) { echo "active"; } ?>">{{ $item->getTitle() }}</a>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="column">
                        <?php echo @markdown($page->getContent()); ?>
                    </div>
                    <div class="column doc-menu hiddenOnTablet hiddenOnDesktop">
                        <h3 align="center">Browse Help</h3>
                        <?php if($defaults !== null && $defaults->getHelpMenu() !== null) { ?>
                        <div class="ui menu vertical fluid ">
                            <?php foreach($defaults->getHelpMenu()->getItems() as $item) { ?>
                            <a href="/help/{{ $item->getSlug() }}" class="item <?php if($page->getSlug() == $item->getSlug() ) { echo "active"; } ?>">{{ $item->getTitle() }}</a>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!--end .grid -->
            </div>
        </section>
    </article>
@endsection
