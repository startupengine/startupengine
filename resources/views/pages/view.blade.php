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
    @endif
@endsection

@section('content')
    @if(View::exists('theme.pages.'.$page->slug.'.body'))
        @include('theme.pages.'.$page->slug.'.body')
    @endif
    @if(View::exists('theme.pages.'.$page->slug.'.scripts'))
        @include('theme.pages.'.$page->slug.'.scripts')
    @endif
@endsection