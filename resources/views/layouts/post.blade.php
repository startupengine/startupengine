<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $post->title }} - {{ setting('site.title') }}</title>

    <!-- Styles -->
    @if(View::exists('theme.templates.global.css'))
        @include('theme.templates.global.css')
    @endif

    @if(View::exists('theme.templates.post.css'))
        @include('theme.templates.post.css')
    @endif

    @yield('styles')

    <!-- FAVICONS -->
    <?php if( setting('site.favicon') !== null) { ?>
    <link rel="icon" sizes="180x180" href="{{ setting('site.favicon') }}">
    <?php }  ?>

    <!-- Meta -->
    @yield('meta')
</head>
    @if(View::exists('theme.templates.global.header'))
        @include('theme.templates.global.header')
    @endif

    @if(View::exists('theme.templates.post.header'))
        @include('theme.templates.post.header')
    @endif

    @yield('content')

    @if(View::exists('theme.templates.global.scripts'))
        @include('theme.templates.global.scripts')
    @endif

    @if(View::exists('theme.templates.post.footer'))
        @include('theme.templates.post.footer')
    @elseif(View::exists('theme.templates.global.footer'))
        @include('theme.templates.post.footer')
    @endif
</html>