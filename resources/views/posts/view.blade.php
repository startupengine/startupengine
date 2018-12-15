@extends('layouts.post')

@section('title')
    <?php echo $post->title; ?> - <?php echo setting('site.name'); ?>
@endsection

@section('meta')
<meta name="description" content="<?php echo $post->meta_description; ?>">
<!-- SOCIAL CARDS (ADD YOUR INFO) -->

<!-- FACEBOOK -->
<meta property="og:url" content="{{ \Request::url() }}"> <!-- YOUR URL -->
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $post->title; ?>"> <!-- EDIT -->
<meta property="og:description" content="<?php echo $post->meta_description; ?>"> <!-- EDIT -->
<meta property="og:updated_time" content="{{ \Carbon\Carbon::now()->toFormattedDateString() }}"> <!-- EDIT -->
<meta property="og:image" content="<?php if($post->thumbnail() !== null) { echo $post->thumbnail(); } ?>"> <!-- EDIT -->

<!-- TWITTER -->
<meta name="twitter:card" content="<?php if($post->thumbnail() !== null) { echo $post->thumbnail(); } ?>">
<meta name="twitter:site" content="@webslides"> <!-- EDIT -->
<meta name="twitter:creator" content="{{ setting('site.twitter_account') }}"> <!-- EDIT -->
<meta name="twitter:title" content="<?php echo $post->title; ?>"> <!-- EDIT -->
<meta name="twitter:description" content="<?php echo $post->meta_description; ?>"> <!-- EDIT -->
<meta name="twitter:image" content="<?php if($post->thumbnail() !== null) { echo $post->thumbnail(); } ?>"> <!-- EDIT -->
@endsection

@section('styles')
    @if(View::exists("theme.templates.$postType.css"))
        @include("theme.templates.$postType.css")
    @endif
    @if(isset($post->content()->code->css))
        {!! $post->content()->code->css !!}
    @endif
@endsection

@section('content')
    @if(View::exists("theme.templates.$postType.scripts"))
        @include("theme.templates.$postType.scripts")
    @endif
    @if(isset($post->content()->code->scripts))
        {!! $post->content()->code->scripts !!}
    @endif
@endsection