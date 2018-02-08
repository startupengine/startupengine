<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->title }} - {{ setting('site.name') }}</title>

    <!-- Styles -->
    @if(View::exists('theme.templates.global.css'))
        @include('theme.templates.global.css')
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

@yield('content')

@if((isset($page->content()->settings) && isset($page->content()->settings->use_global_menu) && $page->content()->settings->use_global_menu == "false"))
@else
    @include('theme.templates.global.menu')
@endif


@if(View::exists('theme.templates.global.scripts'))
    @include('theme.templates.global.scripts')
@endif

@if(View::exists('theme.templates.global.footer'))
    @include('theme.templates.global.footer')
@endif

</html>