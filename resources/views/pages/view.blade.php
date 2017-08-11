@extends('layouts.webslides')

@section('title')<?php echo $page->getTitle(); ?>@endsection

@section('meta')
<meta name="description" content="<?php echo $page->getDescription(); ?>">
<!-- SOCIAL CARDS (ADD YOUR INFO) -->

<!-- FACEBOOK -->
<meta property="og:url" content="{{ \Request::url() }}"> <!-- YOUR URL -->
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $page->getTitle(); ?>"> <!-- EDIT -->
<meta property="og:description" content="<?php echo $page->getDescription(); ?>"> <!-- EDIT -->
<meta property="og:updated_time" content="{{ \Carbon\Carbon::now()->toFormattedDateString() }}"> <!-- EDIT -->
<meta property="og:image" content="<?php if($page->getFeaturedImage() !== null) { echo $page->getFeaturedImage()->getFile()->getUrl(); } ?>"> <!-- EDIT -->

<!-- TWITTER -->
<meta name="twitter:card" content="<?php if($page->getFeaturedImage() !== null) { echo $page->getFeaturedImage()->getFile()->getUrl(); } ?>">
<meta name="twitter:site" content="@webslides"> <!-- EDIT -->
<meta name="twitter:creator" content="@jlantunez"> <!-- EDIT -->
<meta name="twitter:title" content="<?php echo $page->getTitle(); ?>"> <!-- EDIT -->
<meta name="twitter:description" content="<?php echo $page->getDescription(); ?>"> <!-- EDIT -->
<meta name="twitter:image" content="<?php if($page->getFeaturedImage() !== null) { echo $page->getFeaturedImage()->getFile()->getUrl(); } ?>"> <!-- EDIT -->
@endsection

@section('styles')
    <?php if($page->getCss() !== null) { echo $page->getCss(); } ?>
@endsection

@section('content')
<article>
    <?php $count = 1; ?>
    @foreach($page->getSections() as $section)
        <?php $contentType = $section->getType(); ?>
        @include('sections.'.strtolower($contentType))
        <?php $count = $count + 1; ?>
        <?php echo $section->getHtml(); ?>
    @endforeach
    <?php if($page->getHtml() !== null) { echo $page->getHtml(); } ?>
    @include('components.comments')
</article>
@endsection