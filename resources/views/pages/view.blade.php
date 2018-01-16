@if(View::exists('theme.pages.'.$page->slug.'.index'))
    @include('theme.pages.'.$page->slug.'.index')
@elseif(file_exists("/resources/views/theme/pages/$page->slug/index.html"))
    {!! file_get_contents(("/resources/views/theme/pages/$page->slug/index.html")) !!}
@else

    @extends('layouts.page')

    @section('title')
        <?php echo $page->title; ?>
    @endsection

    @section('meta')
    <meta name="description" content="<?php echo $page->meta_description; ?>">
    <!-- SOCIAL CARDS (ADD YOUR INFO) -->

    <!-- FACEBOOK -->
    <meta property="og:url" content="{{ \Request::url() }}"> <!-- YOUR URL -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo $page->title; ?>"> <!-- EDIT -->
    <meta property="og:description" content="<?php echo $page->meta_description; ?>"> <!-- EDIT -->
    <meta property="og:updated_time" content="{{ \Carbon\Carbon::now()->toFormattedDateString() }}"> <!-- EDIT -->
    <meta property="og:image" content="<?php if($page->image !== null) { echo $page->image; } ?>"> <!-- EDIT -->

    <!-- TWITTER -->
    <meta name="twitter:card" content="<?php if($page->image !== null) { echo $page->image; } ?>">
    <meta name="twitter:site" content="@webslides"> <!-- EDIT -->
    <meta name="twitter:creator" content="{{ setting('site.twitter_account') }}"> <!-- EDIT -->
    <meta name="twitter:title" content="<?php echo $page->title; ?>"> <!-- EDIT -->
    <meta name="twitter:description" content="<?php echo $page->meta_description; ?>"> <!-- EDIT -->
    <meta name="twitter:image" content="<?php if($page->image !== null) { echo $page->image; } ?>"> <!-- EDIT -->
    @endsection

    @section('styles')

        @if(View::exists('theme.pages.'.$page->slug.'.css'))
            @include('theme.pages.'.$page->slug.'.css')
        @elseif($page->css !== null)
            <?php echo $page->css; ?>
        @elseif(View::exists('theme.pages.'.$page->slug.'/css.html'))
            @include('theme.pages.'.$page->slug.'/css.html')
        @endif

    @endsection

    @section('content')

        @if(View::exists('theme.pages.'.$page->slug.'.header'))
            @include('theme.pages.'.$page->slug.'.header')
        @elseif(file_exists("/resources/views/theme/pages/$page->slug/header.html"))
            {!! file_get_contents(("/resources/views/theme/pages/$page->slug/header.html")) !!}
        @endif

        @if(View::exists('theme.pages.'.$page->slug.'.body'))
            @include('theme.pages.'.$page->slug.'.body')
        @elseif(isset($page->html))
            {!! $page->html !!}
        @elseif(file_exists("/resources/views/theme/pages/$page->slug/body.html"))
            {!! file_get_contents(("/resources/views/theme/pages/$page->slug/body.html")) !!}
        @endif

        @if(View::exists('theme.pages.'.$page->slug.'.scripts'))
            @include('theme.pages.'.$page->slug.'.scripts')
        @elseif(file_exists("/resources/views/theme/pages/$page->slug/scripts.html"))
            {!! file_get_contents(("/resources/views/theme/pages/$page->slug/scripts.html")) !!}
        @elseif(isset($page->scripts))
            {!! $page->scripts !!}
        @endif

        @if(View::exists('theme.pages.'.$page->slug.'.footer'))
            @include('theme.pages.'.$page->slug.'.footer')
        @elseif(file_exists("/resources/views/theme/pages/$page->slug/footer.html"))
            {!! file_get_contents(("/resources/views/theme/pages/$page->slug/footer.html")) !!}
        @endif

    @endsection
@endif