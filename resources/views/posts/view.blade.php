@extends('layouts.post')

@section('title')
    <?php echo $post->title; ?>
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
<meta property="og:image" content="<?php if($post->image !== null) { echo $post->image; } ?>"> <!-- EDIT -->

<!-- TWITTER -->
<meta name="twitter:card" content="<?php if($post->image !== null) { echo $post->image; } ?>">
<meta name="twitter:site" content="@webslides"> <!-- EDIT -->
<meta name="twitter:creator" content="{{ setting('site.twitter_account') }}"> <!-- EDIT -->
<meta name="twitter:title" content="<?php echo $post->title; ?>"> <!-- EDIT -->
<meta name="twitter:description" content="<?php echo $post->meta_description; ?>"> <!-- EDIT -->
<meta name="twitter:image" content="<?php if($post->image !== null) { echo $post->image; } ?>"> <!-- EDIT -->
@endsection

@section('styles')
    {!! html_entity_decode($post->css) !!}
@endsection

@section('content')
    {!! html_entity_decode($post->body) !!}
    @if($post->comments_enabled)
        <div id="comments-container">
            {!! html_entity_decode(setting('site.comments_code')) !!}
        </div>
    @endif
    {!! html_entity_decode(setting('site.menu_html')) !!}
    {!! html_entity_decode($post->scripts) !!}
@endsection