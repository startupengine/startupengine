<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->title }} - {{ config('app.name', 'StartupEngine') }}</title>

    <?php $template = new \App\Template(); ?>
    {!! $template->raw('/templates/global/header.blade.php')  !!}

    <!-- Styles -->
    {!! $template->raw('/templates/global/css.blade.php')  !!}

    @yield('styles')

    <!-- FAVICONS -->
    <?php if( setting('site.favicon') !== null) { ?>
    <link rel="icon" sizes="180x180" href="{{ \Storage::disk('public')->url( setting('site.favicon') ) }}">
    <?php }  ?>

    <!-- Meta -->
    @yield('meta')
</head>
    {!! $template->raw('/templates/global/header.blade.php')  !!}
    {!! $page->raw($page->slug.'/header.blade.php') !!}
    @yield('content')
    {!! $template->raw('/templates/global/menu.blade.php')  !!}
    {!! $template->raw('/templates/global/scripts.blade.php')  !!}
    {!! $page->raw($page->slug.'/footer.blade.php') !!}
    {!! $template->raw('/templates/global/footer.blade.php')  !!}
</html>