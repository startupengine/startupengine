<?php $viewOptions = [];?>
@yield('php-variables')
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ setting('site.name') }}</title>
    <meta name="description"
          content="@yield('meta-description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/styles/bootstrap.4.0.0.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/shards.min.css">
    <link rel="stylesheet" href="/styles/shards-extras.min.css">
    <link rel="stylesheet" href="/styles/shards-custom.css">
@yield('css')

<!-- FAVICONS -->
    <link rel="icon" sizes="180x180" href="{{ setting('site.favicon', '/images/startup-engine-logo.png') }}">
</head>
<body class="shards-landing-page--1 @if(isset($message)) hasMessage @endif w-100">

@if(isset($message))
<!-- Welcome Section -->
<div class="message">
    <nav class="navbar navbar-expand-lg navbar-dark px-2 fixed-top justify-content-center" id="messageNavbar">
        @if(isset($message['html'])){!! $message['html'] !!}
        @elseif(isset($message['text'])){{ $message['text'] }} @endif
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
                    <img src="{{ setting('site.logo', '/images/startup-engine-logo.png') }}" style="max-height:30px;"
                         class="mr-2" alt="{{ setting('site.name') }}">
                    <span class="ml-1">{{ setting('site.name') }}</span>
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
                            @if(pageIsPublished('products'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="popover" data-placement="bottom"
                                       data-trigger="hover focus" data-delay='{ "show": 100, "hide": 1500 }'
                                       data-html="true"
                                       data-content="And here's some amazing content. It's very engaging. Right? <a href='#'>Test</a>">Products</a>
                                </li>
                            @endif
                            @if(pageIsPublished('services'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Services</a>
                                </li>
                            @endif
                            @if(pageIsPublished('pricing'))
                                <li class="nav-item d-none">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>
                            @endif
                            @if(pageIsPublished('resources'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Resources</a>
                                </li>
                            @endif
                            @if(pageIsPublished('blog'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Blog</a>
                                </li>
                            @endif
                            @if(pageIsPublished('help'))
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Help</a>
                                </li>
                            @endif
                        </ul>

                        @if(\Auth::user())
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown" id="accountDropdown">

                                    <a class="btn btn-pill btn-light text-dark ml-2 dropdown-toggle" href="#"
                                       id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        @if(\Auth::user()->avatar != null) <span class="d-inline-block"
                                                                                 style="height:25px;width:25px;border-radius:25px;background:url('{{ \Auth::user()->avatar }}');background-color:#eee;background-size:cover;background-position:center;top:10.5px;left:20px;margin-right:10px;position:absolute;float:left;">&nbsp;</span> @endif
                                        <span class="d-inline-block"
                                              style="margin-left:23px;height:20px;width:20px;border-radius:20px;top:2px;margin-right:2px;position:relative;min-width:50px;">{{ \Auth::user()->name }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @if(\Auth::user()->hasPermissionTo('view backend'))<a class="dropdown-item"
                                                                                              href="/admin"><i
                                                    class="fa fa-fw fa-lock mr-2 dimmed"></i>Admin Panel</a>@endif
                                        <a class="dropdown-item" href="/admin"><i
                                                    class="fa fa-fw fa-cog mr-2 dimmed"></i>Profile</a>
                                        <a class="dropdown-item" href="/logout"><i
                                                    class="fa fa-fw fa-sign-out text-danger mr-2 dimmed"></i>Sign Out</a>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="btn btn-pill btn-light text-dark ml-2" href="/login">Sign In <i
                                                class="fa fa-fw fa-sign-in"></i></a>
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
<div class="modal" tabindex="-1" role="dialog" id="navModal">
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
                    @if(pageIsPublished('products'))
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link">Products</a>
                        </li>
                    @endif
                    @if(pageIsPublished('pricing'))
                        <li class="nav-item w-100 d-none">
                            <a href="#" class="nav-link">Pricing</a>
                        </li>
                    @endif
                    @if(pageIsPublished('resources'))
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link">Resources</a>
                        </li>
                    @endif
                    @if(pageIsPublished('blog'))
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link">Blog</a>
                        </li>
                    @endif
                    @if(pageIsPublished('help'))
                        <li class="nav-item w-100">
                            <a href="#" class="nav-link">Help</a>
                        </li>
                    @endif
                    @if(\Auth::user() && \Auth::user()->hasPermissionTo('view backend'))
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark" href="/admin">Admin Panel</a>
                        </li>
                    @endif
                    @if(\Auth::user())
                        <li class="nav-item w-100">
                            <a class="nav-link text-danger" href="/logout">Sign Out <br><span
                                        class="text-dark dimmed mt-1">Logged in as {{ \Auth::user()->name }}</span></a>
                        </li>
                    @else
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark" href="/login">Sign In <i class="fa fa-fw fa-sign-in"></i></a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </div>
</div>
<!-- / Mobile Nav Modal -->

<!-- Footer Section -->
<footer style="position:static;bottom:0px;width:100%;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#" style="margin-top:-3px;"><span
                        class="dimmed mr-2">&copy;</span>{{ setting('site.name') }} <span
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
<script src="/js/axios-min.js"></script>
<script src="/js/polyfill-min.js"></script>
<script src="/js/bootstrap-vue.js"></script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>
<script>
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 2) {
                $('#topNavbar').addClass('filled');
                $('#topNavbar').addClass('shadowed');
            }
        });
    });
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() < 2) {
                $('#topNavbar').removeClass('filled');
                $('#topNavbar').removeClass('shadowed');
            }
        });
    });
</script>

@yield('scripts')

</body>
</html>