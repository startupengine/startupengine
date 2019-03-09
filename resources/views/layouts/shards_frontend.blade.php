
<?php  $viewOptions['navbar-classes'] = ['navbar-light', 'navbar-blend-light-blue'];
        $viewOptions['navbar-scroll-add-classes'] = ['navbar-dark', 'dark'];
        $viewOptions['navbar-unscroll-remove-classes'] = ['navbar-dark', 'dark'];  ?>

@yield('php-variables')

<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ setting('site.name', 'Startup Engine') }}</title>
    <meta name="description"
          content="@yield('meta-description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/styles/bootstrap.4.0.0.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/styles/shards.min.css">
    <link rel="stylesheet" href="/styles/shards-extras.min.css">
    <link rel="stylesheet" href="/styles/shards-custom.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-snotify@3.2.1/styles/material.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
@yield('css')

<!-- FAVICONS -->
    <link rel="icon" sizes="180x180" href="{{ setting('site.favicon', '/images/startup-engine-icon.png') }}">
</head>
<body class="shards-landing-page--1 @if(isset($message)) hasMessage @endif w-100">
<div id="mainApp">
@if(isset($message))
<!-- Welcome Section -->
<div class="message">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-2 py-2" id="messageNavbar">
        <div class="container px-0 justify-content-center">
        @if(isset($message['html'])){!! $message['html'] !!}
        @elseif(isset($message['text'])){{ $message['text'] }} @endif
        </div>
    </nav>

</div>
@endif

<!-- Welcome Section -->
<div class="welcome d-flex justify-content-center flex-column @yield('splash-class')" style="@yield('splash-style')">
    <div class="container">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark px-0 fixed-top @yield('navbar-classes') " id="topNavbar">
            <div class="container px-2 px-md-0">
                <a class="navbar-brand" href="/">
                    <img src="{{ setting('site.logo', '/images/startup-engine-logo.png') }}" style="min-width:30px;max-height:30px;display:inline-block;"
                         class="mr-1" alt="{{ setting('site.name', 'Startup Engine') }}">
                    <span>{{ setting('site.name', 'Startup Engine') }}</span>
                </a>
                <button class="navbar-toggler" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#navModal" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    @if(setting('site.top-nav'))
                        {!! setting('site.top-nav') !!}
                    @else
                        <ul class="navbar-nav">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            @if(pageIsPublished('services'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Services</a>
                                </li>
                            @endif

                            @if(pageIsPublished('resources'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Resources</a>
                                </li>
                            @endif
                            @if(pageIsPublished('content') OR view()->exists('pages.defaults.content.index'))
                                <li class="nav-item {{ Request::is('content*') ? 'active' : '' }}">
                                    <a href="/content" class="nav-link">Content</a>
                                </li>
                            @endif
                            @if(pageIsPublished('pricing') OR \App\Product::where('status', '=', 'ACTIVE') != null)
                                <li class="nav-item {{ Request::is('pricing*') ? 'active' : '' }}">
                                    <a class="nav-link" href="/pricing"
                                    >Pricing</a>
                                </li>
                            @endif
                            @if(pageIsPublished('help'))
                                <li class="nav-item {{ Request::is('help*') ? 'active' : '' }}">
                                    <a class="nav-link" href="#">Help</a>
                                </li>
                            @endif
                            @if(hasDocs())
                                <li class="nav-item {{ Request::is('docs*') ? 'active' : '' }}">
                                    <a class="nav-link" href="/docs" id="docsNavLink" data-toggle="popover" data-trigger="focus,hover" data-placement="bottom" data-content=
                                    '<div align="center" class="popover-menu">
                                    @foreach(docsFolders() as $docFolder)
                                        <a class="dropdown-item py-1 px-3 m-0" href="/docs/{{ $docFolder }}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a>
                                    @endforeach <div class="dropdown-divider"></div> <a class="dropdown-item py-1 px-3 m-0" href="/docs">View All</a> </div>'
                                       data-html="true" >Help</a>
                                </li>
                            @endif
                        </ul>

                        @if(\Auth::user())
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown mx-2" id="accountDropdown">

                                    <a class="btn btn-pill btn-white text-dark " href="/app/account"
                                       id="navbarDropdown" role="button"  aria-haspopup="true"
                                       data-toggle="popover" data-trigger="focus,hover" data-placement="bottom" data-content=
                                       '<div align="left" class="popover-menu">
                                    @if(\Auth::user()->hasPermissionTo('view backend'))
                                               <a class="dropdown-item py-1 px-3 m-0" href="/admin"><i
                                                    class="fa fa-fw fa-lock mr-2 "></i>Admin Panel</a><div class="dropdown-divider"></div>
                                    @endif <a class="dropdown-item py-1 px-3 m-0" href="/app/account"><i
                                                    class="fa fa-fw fa-cog mr-2 "></i>My Account</a> <a class="dropdown-item py-1 px-3 m-0" href="/logout"><i
                                                    class="fa fa-fw fa-sign-out-alt text-danger mr-2 "></i>Sign Out</a> </div>'
                                       data-html="true"
                                       aria-expanded="false">
                                        @if(\Auth::user()->avatar() != null) <span class="d-inline-block"
                                                                                 style="height:25px;width:25px;border-radius:25px;background:url('{{ \Auth::user()->avatar() }}');background-color:#eee;background-size:cover;background-position:center;top:10.5px;left:15px;margin-right:10px;position:absolute;float:left;">&nbsp;</span>
                                        @else<span class="d-inline-block"
                                                                                 style="height:25px;width:25px;border-radius:25px;background:url('/images/avatar.png');background-color:#eee;background-size:cover;background-position:center;top:10.5px;left:15px;margin-right:10px;position:absolute;float:left;">&nbsp;</span>
                                        @endif
                                        <span class="d-inline-block"
                                              style="margin-left:30px;height:20px;border-radius:20px;top:2px;margin-right:2px;position:relative;min-width:50px;">{{ \Auth::user()->name }} <i class="fa fa-fw fa-caret-down"></i></span>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    @if (!\Request::is('login'))
                                        <div class="btn-group ml-1">
                                            <a class="btn btn-outline-white" href="/login">Sign In</a>
                                        </div>
                                    @endif
                                    @if (!\Request::is('register'))
                                        <div class="btn-group ml-1">
                                            <a class="btn btn-white raised" href="/register">Sign Up</a>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                        @endif
                    @endif
                </div>
            </div>
        </nav>
        <!-- / Navigation -->
    </div> <!-- .container -->
    @yield('header')
</div>
<!-- / Welcome Section -->
<?php $sectionCount = 1; ?>
<main id="content">
    @yield('content')
</main>


<!-- Mobile Nav Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="navModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Navigation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="position:relative;right:-10px;top:0px;margin-top:-13px;">
                    <span aria-hidden="true">&times;</span>
                </button>

                </button>
            </div>
            <div class="modal-body">
                <ul class="nav w-100">
                    <li class="nav-item w-100">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    @if(pageIsPublished('services'))
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link">Services</a>
                        </li>
                    @endif
                    @if(pageIsPublished('content') OR view()->exists('pages.defaults.content.index'))
                        <li class="nav-item w-100">
                            <a href="/content" class="nav-link">Content</a>
                        </li>
                    @endif
                    @if(pageIsPublished('pricing') OR count(\App\Product::where('status', '=', 'ACTIVE')->get()) > 0)
                        <li class="nav-item w-100 ">
                            <a href="/pricing" class="nav-link">Pricing</a>
                        </li>
                    @endif
                    @if(pageIsPublished('help'))
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link">Help</a>
                        </li>
                    @endif
                    @if(hasDocs())
                        <li class="nav-item">
                            <a class="nav-link" href="/docs">Help</a>
                        </li>
                    @endif
                    @if(\Auth::user() && \Auth::user()->hasPermissionTo('view backend'))
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark" href="/admin">Admin Panel</a>
                        </li>
                    @endif
                    @if(\Auth::user())
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark" href="/app/account">My Account</a>
                        </li>

                        <li class="nav-item w-100">
                            <a class="nav-link text-danger" href="/logout">Sign Out <br><span
                                        class="text-dark dimmed mt-1">Logged in as {{ \Auth::user()->name }}</span></a>
                        </li>
                    @else
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark" href="/login">Sign In</a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark" href="/register">Sign Up</a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </div>
</div>
<!-- / Mobile Nav Modal -->

<!-- Footer Section -->
<footer style="position:static;bottom:0px;width:100%;" class="hiddenOnDesktop d-none">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#" style="margin-top:-3px;"><span
                        class="dimmed mr-1">&copy;</span>{{ setting('site.name') }} <span
                        class="dimmed">{{ \Carbon\Carbon::now()->format('Y') }}</span></a>
            @if(findAndFetch('slug', 'pricing'))
                <div class="justify-content-right" id="navbarNav">
                    <div class="text-white">Get started today.
                        <a class="btn btn-primary btn-pill ml-2" href="/pricing">Sign Up <i
                                    class="fa fa-angle-right ml-2"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </nav>
</footer>
<!-- / Footer Section -->
</div>

{!! renderConfirmActionModal() !!}



<!-- JavaScript Dependencies -->

<script src="/js/moment-2.22.js"></script>
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/jquery-ui-1.12.1.js"></script>
<script src="/js/popper.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/admin-panel/scripts/shards.min.js"></script>
<script src="/js/chart-min.js"></script>
<script src="/js/vue-chartjs-min.js"></script>

<script src="/js/jquery.sharre.min.js"></script>
<script src="/js/vue.js"></script>
<script src="https://unpkg.com/vue-snotify@3.2.1/vue-snotify.js"></script>

<script src="/js/axios-min.js"></script>
<script src="/js/polyfill-min.js"></script>
<script src="/js/bootstrap-vue.js"></script>
{!! renderPassportApp() !!}
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
<script>
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 2) {
                @foreach($viewOptions['navbar-classes'] as $class)
                    $('#topNavbar').removeClass('{{ $class }}');
                @endforeach
                @foreach($viewOptions['navbar-scroll-add-classes'] as $class)
                    $('#topNavbar').addClass('{{ $class }}');
                @endforeach
                $('#topNavbar').addClass('shadowed');
            }
        });
    });
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() < 2) {
                @foreach($viewOptions['navbar-unscroll-remove-classes'] as $class)
                    $('#topNavbar').removeClass('{{ $class }}');
                @endforeach
                $('#topNavbar').removeClass('shadowed');
                @foreach($viewOptions['navbar-classes'] as $class)
                $('#topNavbar').addClass('{{ $class }}');
                @endforeach
            }
        });
    });
    $('#docsNavLink').hover(function(){
        this.href = "#";
    });
    $('#navbarDropdown').hover(function(){
        this.href = "#";
    });

</script>

@yield('scripts')
{!! renderNotificationsApp() !!}

{!! renderConfirmActionScripts() !!}

</body>
</html>