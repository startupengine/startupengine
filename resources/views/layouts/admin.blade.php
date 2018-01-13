<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site.title') }} {{ setting('admin.title') }}</title>
    @include('app.partials.css')
    @yield('styles')
    <!-- Vue -->
    <script src="https://unpkg.com/vue"></script>

</head>
<body class="index-page sidebar-collapse">
@include('app.partials.menu')
<div id="app">
    <div class="container-fluid" style="margin-top:15px;">
        <div class="card" style="margin-top:75px !important;">
            <div class="row">
            @if(isset($flash) && $flash !== null)
                    <div style="width:100%;background:#eee;text-align:center;padding:15px;">
                        {{ $flash }}
                    </div>
            @endif
            @include('app.partials.admin-sidebar')
            @yield('content')
            </div>
        </div>
        @include('app.partials.scripts')
    </div>
    @yield('modals')
    </div>

</body>
</html>