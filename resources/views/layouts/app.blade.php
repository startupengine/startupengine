<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StartupEngine') }}</title>

    <!-- Styles -->
    @if(View::exists('theme.templates.global.css'))
        @include('theme.templates.global.css')
    @endif

    @yield('styles')

    @include('theme.templates.global.header')
</head>
<body>

@yield('content')

@if(View::exists('theme.templates.global.scripts'))
    @include('theme.templates.global.scripts')
@endif
</body>
</html>