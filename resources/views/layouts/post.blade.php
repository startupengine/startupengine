<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $post->title }} - {{ config('app.name', 'StartupEngine') }}</title>

    {!! html_entity_decode(setting('site.global_header')) !!}

    <!-- Styles -->
    {!! html_entity_decode(setting('site.global_css')) !!}
    @yield('styles')

    <!-- FAVICONS -->
    <?php if( setting('site.favicon') !== null) { ?>
    <link rel="icon" sizes="180x180" href="{{ \Storage::disk('public')->url( setting('site.favicon') ) }}">
    <?php }  ?>

    <!-- Meta -->
    @yield('meta')
</head>
    <?php echo setting('post.header_html'); ?>
    @yield('content')
    {!! html_entity_decode(setting('site.menu_html')) !!}
    {!! html_entity_decode(setting('site.global_scripts')) !!}
    <?php echo setting('post.footer_html'); ?>
</html>