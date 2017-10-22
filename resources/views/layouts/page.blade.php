<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->title }} - {{ config('app.name', 'StartupEngine') }}</title>

    @if(View::exists('templates.templates.global.header'))
        @include('templates.templates.global.header')
    @endif

    <!-- Styles -->
    @if(View::exists('templates.templates.global.css'))
        @include('templates.templates.global.css')
    @endif

    @yield('styles')

    <!-- FAVICONS -->
    <?php if( setting('site.favicon') !== null) { ?>
    <link rel="icon" sizes="180x180" href="{{ \Storage::disk('public')->url( setting('site.favicon') ) }}">
    <?php }  ?>

    <!-- Meta -->
    @yield('meta')
</head>
    @include('templates.templates.global.header')
    @if(View::exists('templates.pages.'.$page->slug.'.header'))
        @include('templates.pages.'.$page->slug.'.header')
    @endif
    @yield('content')
    @include('templates.templates.global.menu')
    @include('templates.templates.global.scripts')
    @if(View::exists('templates.pages.'.$page->slug.'.footer'))
        @include('templates.pages.'.$page->slug.'.footer')
    @endif
    @include('templates.templates.global.footer')
</html>