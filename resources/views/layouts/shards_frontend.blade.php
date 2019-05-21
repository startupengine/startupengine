
<?php  $viewOptions['navbar-classes'] = [];
        $viewOptions['navbar-scroll-add-classes'] = ['navbar-dark', 'dark'];
        $viewOptions['navbar-unscroll-remove-classes'] = ['navbar-dark', 'dark'];  ?>

@yield('php-variables')

<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | {{ setting('site.name', 'Startup Engine') }}</title>
    <meta name="description"
          content="@yield('meta-description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
    <script>
        NProgress.start(0.3);
    </script>


    <!-- CSS -->
    <link rel="stylesheet" href="/styles/bootstrap.4.0.0.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/styles/shards.min.css">
    <link rel="stylesheet" href="/styles/shards-extras.min.css">
    <link rel="stylesheet" href="/styles/shards-custom.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-snotify@3.2.1/styles/material.css">
    <link rel="stylesheet" href="/css/plyr.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>

    <style>
        html, body {
            height: 100%;
            min-height: 100vh !important;
            position:relative;
        }
        body {
            background:#ebf1fe !important;
        }
        #wrap {
            min-height: 100%;
        }

        #main {
            overflow:auto;
            padding-bottom:150px; /* this needs to be bigger than footer height*/
        }
        main#content {
            background:#ebf1fe !important;
        }

        #footer .navbar-dark {
            background:#101117 !important;
        }

        @media(max-width:991px) {
            #footer .justify-content-between .justify-content-left, #footer .justify-content-between .justify-content-right {
                width: 100% !important;
                text-align: center !important;
            }
            #footer .list-group-header {
                padding-bottom:20px !important;
                padding-top:20px !important;
            }
        }
        #footer {
            position: static;
            bottom: 0;
        }

        #footer .bg-dark {
            background: #101117 !important;
        }

        #footer .bg-dark .border-top {
            border-color: rgba(255,255,255,0.15) !important;
        }

        #footer .bg-dark .dimmed  {
            color:rgba(215,215,255,0.5) !important;
            opacity:1 !important;
        }

        #footer .bg-dark .fa {
            opacity:.5 !important;
            color:rgba(215,215,255,0.5) !important;
        }

        #footer .bg-dark .list-group-item {
            background: none !important;
            color:rgba(215,215,255,0.5) !important;
            border:none !important;
        }

        #footer .bg-dark .list-group-item a {
            color:#fff !important;
        }

        .plyr--video {
            border-radius:5px !important;
        }
    </style>
@yield('css')

<!-- FAVICONS -->
    <link rel="icon" sizes="180x180" href="{{ setting('site.favicon', '/images/startup-engine-logo.png') }}">
</head>
<body class="shards-landing-page--1 @if(isset($message)) hasMessage @endif w-100 d-flex flex-column">
<div id="wrap">
<div id="mainApp" class="toggleVisibility"  v-bind:class="{ visible: info != null }">
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
<div class="welcome d-flex justify-content-center flex-column @yield('splash-class')" style="@yield('splash-style');">
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

                            @if(pageIsPublished('features') OR hasSubscriptionProductsForSale())
                                <li class="nav-item">
                                    @if(count(getSubscriptionProducts()) == 1)
                                        <a class="nav-link" href="/features">Features</a>
                                    @endif
                                </li>
                            @endif
                            @if(pageIsPublished('content') OR view()->exists('pages.defaults.content.index'))
                                <li class="nav-item {{ Request::is('content*') ? 'active' : '' }}">
                                    <a href="/content" class="nav-link">Content</a>
                                </li>
                            @endif
                            @if(pageIsPublished('pricing') OR hasSubscriptionProductsForSale())
                                <li class="nav-item {{ Request::is('pricing*') ? 'active' : '' }}">
                                    <a class="nav-link" href="/pricing"
                                    >Pricing</a>
                                </li>
                            @endif
                            @if(hasDocs() && pageIsPublished('help'))
                                <li class="nav-item {{ Request::is('docs*') ? 'active' : '' }}">
                                    <a class="nav-link" href="/help" id="docsNavLink" data-toggle="popover" data-trigger="focus,hover" data-placement="bottom" data-content=
                                    '<div align="center" class="popover-menu">
                                    @foreach(docsFolders() as $docFolder)
                                        <a class="dropdown-item py-1 px-3 m-0" href="/docs/{{ $docFolder }}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a>
                                    @endforeach <div class="dropdown-divider"></div> <a class="dropdown-item py-1 px-3 m-0" href="/help">View All</a> </div>'
                                       data-html="true" >Help</a>
                                </li>
                            @endif
                        </ul>

                        @if(\Auth::user())
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown mx-2" id="accountDropdown">

                                    <a class="btn btn-pill btn-white text-dark raised" href="/app/account"
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
                                            <a class="btn btn-outline-white  raised" href="/login">Sign In</a>
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
                    @if(pageIsPublished('pricing') OR hasSubscriptionProductsForSale())
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

@if(\Auth::user() == null && isActiveFeature('newsletter'))
    <div class="w-100 p-4" align="center" style="background:rgb(215, 224, 255);">
        <div class="row">
            <div class="col-md-6 px-4 my-auto text-center text-lg-right">
                <h5 class="mb-2 my-4">
                    <span class="m-2">Want to be notified of new products and content?</span>
                </h5>
            </div>
            <div class="col-md-6 px-4 text-center text-lg-left my-auto">
                <div class="input-group d-inline-flex py-4" style="max-width:500px;">
                    <input id="newsletterInput" autocomplete="off" name="email" class="form-control form-control-lg form-control-translucent" placeholder="Your E-mail" style="border-radius:30px 0px 0px 30px;padding-left:20px !important;"><div class="btn btn-secondary btn-lg pl-3 py-3" style="border-radius: 0px 30px 30px 0px !important;" ><i class="fa fa-fw fa-envelope text-white mr-2"></i> Subscribe</div>
                </div>
            </div>
        </div>
    </div>
@endif

<?php $promos = \App\Promo::where('status', '=', 'PUBLISHED')->inRandomOrder()->get();?>
@if(count($promos) > 0 &&  !Request::is('promo*') )
    <section class="section section-promo bg-dark-blue border-0" style=" @if($promos[0]->getJsonContent('[sections][heading][fields][background]') != null) background-image: url({{ $promos[0]->getJsonContent('[sections][heading][fields][background]') }}) !important; @else background-image: url(https://images.unsplash.com/photo-1552688455-b6faba3c8631?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2000&q=95) !important; @endif background-size:cover !important; background-position:center !important;" >
        <div class="bg-filter py-4 ">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-6 m-auto text-lg-left text-center">
                        <h3 class="text-white my-3 font-weight-800">{{ $promos[0]->getJsonContent('[sections][heading][fields][headline]')  }}</h3>
                        @if($promos[0]->getJsonContent('[sections][heading][fields][description]') != null)<h5 class="text-white my-4">{{ $promos[0]->getJsonContent('[sections][heading][fields][description]')  }}</h5>@endif
                    </div>
                    <div class="col-md-6 m-auto text-center text-lg-right ">
                        <div class="btn-group my-5">
                            @if($promos[0]->getJsonContent('[sections][heading][fields][body]') != null)<a href="/promo/{{ $promos[0]->getHashId() }}" class="btn btn-white btn-lg my-auto raised-1 mr-3" style="border-radius:5px !important;">Learn More</a>@endif
                            @if($promos[0]->getJsonContent('[sections][heading][fields][button]') != null)<a @if($promos[0]->getJsonContent('[sections][heading][fields][link]') != null)href="/promo/{{ $promos[0]->getHashId() }}/outbound" @else href="/pricing?promo={{ $promos[0]->getHashId() }}" @endif class="btn btn-cta btn-lg my-auto raised-1" style="border-radius:5px !important;">{{ $promos[0]->getJsonContent('[sections][heading][fields][button]')  }}</a>@endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif

<!-- Footer Section -->
<footer  class="w-100" id="footer">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container justify-content-between py-2">
            <div class="justify-content-left">
            <a class="navbar-brand" href="/" ><span
                        class="dimmed mr-1">&copy;</span>{{ setting('site.name', 'Startup Engine') }} <span
                        class="dimmed">{{ \Carbon\Carbon::now()->format('Y') }}</span></a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @if(setting('site.tos') != null)
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="/">Terms of Service</a>
                        </li>
                    </ul>
                @endif
            </div>
            </div>
            @if(hasSubscriptionProductsForSale() && count($promos) == 0)
                <div class="justify-content-right text-right" id="navbarNav">
                    <div class="text-white">Get started today.
                        <a class="btn btn-primary btn-pill ml-2" href="/pricing">Sign Up <i
                                    class="fa fa-angle-right ml-2"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </nav>
    <div class="section bg-dark py-0">
    <div class="container">
        <div class="row border-top mx-1 py-4">
            @if(pageIsPublished('content') && count(\App\Post::all()) > 0)
            <div class="col-md-3 p-0 mb-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-header disabled text-primary"><i class="fa fa-fw fa-newspaper mr-2 text-primary"></i>Content</li>
                    @foreach(\App\PostType::all() as $postType)
                        @if(count($postType->posts()->get()) > 0)
                        <li class="list-group-item text-capitalize text-white"><a href="/content/type/{{ $postType->slug }}">{{ $postType->getPluralName() }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif
            @if(hasSubscriptionProductsForSale())
                <div class="col-md-3 p-0 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item list-group-header disabled text-primary"><i class="fa fa-fw fa-shopping-cart mr-2 text-primary"></i>Product<?php if(count(getSubscriptionProducts()) > 1) { echo "s"; } ?></li>
                        @foreach(getSubscriptionProducts() as $product)
                            <li class="list-group-item text-capitalize text-white"><a href="/products/{{ $product->stripe_id}}">{{ str_replace('_', ' ', ucwords($product->name)) }}</a></li>
                        @endforeach
                        @if(pageIsPublished('features') OR count(\App\Feature::all()) > 0)
                                @if(count(getSubscriptionProducts()) == 1)
                                <li class="list-group-item text-capitalize text-white"><a href="/features">Features</a></li>
                                @endif
                        @endif
                        <li class="list-group-item text-capitalize text-white"><a href="/pricing">Pricing</a></li>
                    </ul>
                </div>
            @endif
            <div class="col-md-3 p-0 mb-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-header disabled text-primary"><i class="fa fa-fw fa-book mr-2 text-primary"></i>Help</li>
                    @foreach(docsFolders() as $docFolder)
                        <li class="list-group-item text-capitalize text-white"><a href="/docs/{{ $docFolder }}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a></li>
                    @endforeach
                    <li class="list-group-item text-capitalize text-white"><a href="/docs/">View All Docs</a></li>
                </ul>
            </div>
            <div class="col-md-3 p-0 mb-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-header disabled text-primary"><i class="fa fa-fw fa-user mr-2 text-primary"></i>Account</li>
                    <li class="list-group-item text-capitalize text-white"><a href="/app/account">My Profile</a></li>
                    <li class="list-group-item text-capitalize text-white"><a href="/app/settings">My Settings</a></li>
                    <li class="list-group-item text-capitalize text-white"><a href="/app/subscriptions">My Subscriptions</a></li>
                </ul>
            </div>
        </div>
    </div>
    </div>
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
<?php /* <script src="/js/plyr/plyr.js"></script> */ ?>
<script src="https://cdn.plyr.io/3.5.2/plyr.polyfilled.js"></script>
<script>
    const player = new Plyr('#player');
</script>
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

    $("#mainApp").removeClass('toggleVisibility');
    NProgress.done();

    $('a').click(function(){
        if($(this).attr('href') !== '#') {
            NProgress.start();
            NProgress.set(0.1)
            $("#mainApp").addClass('toggleVisibility');
            $("#mainApp").addClass('invisible');
        }
    });
</script>

@yield('scripts')
{!! renderNotificationsApp() !!}

{!! renderConfirmActionScripts() !!}
</div>
</body>
</html>