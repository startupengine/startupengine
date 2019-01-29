<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.name', 'Startup Engine') }} - Dashboard</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Startup Engine - Dashboard</title>
    <meta name="description"
          content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0"
          href="/admin-panel/styles/shards-dashboards.1.0.0.min.css">

    <link rel="stylesheet" href="/admin-panel/styles/extras.1.0.0.min.css">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script async defer src="/js/app.js"></script>

    <!-- FAVICONS -->
    <?php if (setting('site.favicon') !== null) { ?>
    <link rel="icon" sizes="180x180" href="{{ setting('site.favicon') }}">
    <?php } ?>

    @yield('head')

    <style>
        @media (min-width: 768px) {
            #pageTitle {
                margin-bottom: 0px !important;
            }

            .hiddenOnDesktop {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .pageNav {
                min-width: 100% !important;
            }

            .hiddenOnMobile {
                display: none !important;
            }
        }

        .modal .control-label {
            color: #888;
            font-weight: bold;
        }

        .modal .help-block {
            padding-top: 10px !important;
            display: inline-block;
            opacity: 0.5;
        }

        .modal-header {
            padding: .9375rem 2rem .9375rem 1.25rem !important;
        }

        #menuAvatar {
            height: 30px;
            width: 30px;
            border-radius: 15px;
            background: url('{{ \Auth::user()->avatar() }}');
            display: inline-block;
            margin: 5px 5px 5px 5px;
            background-size: cover;
            background-position: center;
            pointer-events: none !important;
        }

        #menuUserName {
            display: inline-block;
            margin-top: 10px;
            margin-right: 15px;
            vertical-align: top;
        }

        #accountMenu .dropdown-toggle::after {
            top: 27px !important;
            right: 12px !important;
            position: absolute !important;
            pointer-events: none;
        }

        h3.page-title {
            margin-top: 5px;
        }

        .card tr:hover .btn-white {
            box-shadow: 0 2px 0 rgba(90, 97, 105, .11), 0 4px 8px rgba(90, 97, 105, .12), 0 10px 10px rgba(90, 97, 105, .06), 0 7px 70px rgba(90, 97, 105, .1);
        }

        .card tbody tr:hover {
            background: rgba(213, 218, 255, 0.25);
            transition: all 0.5s;
        }

        .modal .input-group-text {
            color: #5e7e98;
            background-color: #e1e5eb;
        }

        .raised {
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, .1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, .1), 0 0.25rem 0.53125rem rgba(90, 97, 105, .12), 0 0.125rem 0.1875rem rgba(90, 97, 105, .1);
        }

        .border-radius-5 {
            border-radius: 5px !important;
        }

        .border-radius-10 {
            border-radius: 10px !important;
        }

        .modal {
            z-index: 9999 !important;
        }

        .modal-header .close {
            margin-top: -0.6rem !important;
        }

        .CodeMirror {
            border-radius: 5px !important;
            border: 1px solid #eee;
        }

        .modal-fluid {
            min-width: 100% !important;
            padding: 15px !important;
            margin: 0px !important;
        }

        .modal-fluid {
            width: 100% !important;
            padding: 10px !important;
            margin: 0px !important;
            transition: all 0.3s !important;
            transition-timing-function: ease-in !important;
        }

        .modal-content {
            transition: all 0.3s !important;
            transition-timing-function: ease-in !important;
        }

        .modal-fluid .modal-content {
            height: calc(100vh - 20px) !important;
            min-height: 100% !important;
        }

        .modal-dialog {
            transition: all 0.3s !important;
            transition-timing-function: ease-in !important;
        }

        .modal-header .expand {
            top: 16px;
            right: 70px;
            position: absolute;
            opacity: 0.5;
            padding: 10px;
            cursor: pointer;
            -webkit-text-stroke: 1px #888;
        }

        .modal-fluid a.expand {
            opacity: 1 !important;
        }

        .modal-fluid a.expand i {
            color: #007bff !important;
            -webkit-text-stroke: 1px #007bff !important;
        }

        form .invalid-feedback {
            display: block;
        }

        .modal-backdrop {
            opacity: 0.4 !important;
        }

        .navbar-brand {
            background: none !important;
        }

        .modal-open {
            transition: all 0s;
        }

        .modal-open .main-sidebar {
            opacity: 0.4;
        }

        .modal-open .main-sidebar i {
            color: #999 !important;
        }

        .modal-open .navbar-brand {
            background-color: #c9c9c9 !important;
            border-bottom: 1px solid #999 !important;
            z-index: 0 !important;
        }

        #main-container {
            background-image: linear-gradient(180deg, #c2d2e9 0px, #f5f6f8 80px, #fff 90%) !important;
            background-attachment: fixed;
        }

        @media (min-width: 768px) {
            .main-content .header-navbar, .main-content > .main-navbar {
                box-shadow: none !important;
            }

            .main-sidebar {
                box-shadow: none !important;
                background: none !important;
            }

            .main-sidebar .nav .nav-item, .main-sidebar .nav .nav-link {
                background: none !important;
                border: none !important;
            }

            .main-sidebar .nav {
                margin-top: 10px;
            }

            .main-sidebar .nav .nav-item i {
                margin-right: 20px !important;
                margin-left: 0px;
            }

            .main-sidebar .nav .nav-item.active {
                border-left: 5px #000;
            }
        }

        @media (min-width: 768px) {
            .navbar-brand .d-table {
                margin: auto 30px !important;
            }

            .navbar-brand span {
                display: none !important;
            }

            #sidebar li span {
                display: none;
            }

            #top-nav {
                margin-left: 15px;
            }

        }

        @media (min-width: 991px) {
            .navbar-brand span {
                display: inline-block !important;
            }

            #sidebar li span {
                display: inline-block;
            }
        }

        .navbar-brand span {
            transition: all 0.3s;
        }

        @media (max-width: 1350px) {
            .navbar-brand span {
                font-size: 12px;
            }
        }

        @media (min-width: 1350px) {
            .navbar-brand span {
                font-size: unset;
            }
        }

        aside, .main-sidebar {
            z-index: 10 !important;
            transition: all 0s;
        }

        @media (max-width: 768px) {
            .main-sidebar {
                z-index: 10 !important;
                transition: all 0.15s;
            }
        }

        body {
            background: #fff !important;
        }

        main.main-content {
            min-height: 100vh;
        }

        .dimmed {
            opacity: 0.5;
            transition: all 0.25s;
        }

        .dimmed:hover {
            opacity: 1;
        }

        .badge.badge-light {
            background: #efefef !important;
        }

        .page-item.disabled .page-link {
            opacity: 0.4;
        }

        .page-item.disabled {
            cursor: not-allowed !important;
            background: #fff !important;
        }

        .card .tab-pane {
            margin-top: 15px !important;
        }

        .card pre {
            margin-bottom: 25px;
        }

        .card h6 {
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .card .text-muted {
            opacity: 0.5;
        }

        .card .card .btn {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .card .card-footer li, .card .card-footer li a.btn {
                display: inline-flex !important;
                width: 100% !important;
                margin-right: 0px !important;
            }
        }

        @media (min-width: 768px) {
            #brand-container {
                width: 255px;
            }
        }

        @media (min-width: 768px) {
            .navbar-brand .d-table {
                margin: auto 30px !important;
            }

            .navbar-brand span {
                display: none !important;
            }

            #sidebar li span {
                display: none;
            }

            #top-nav {
                margin-left: 15px;
            }

            .offset-lg-2 {
                margin-left: 7%;
            }

            .col-lg-10 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 93%;
                flex: 0 0 93%;
                max-width: 93%;
            }

        }

        @media (min-width: 991px) {
            .navbar-brand span {
                display: inline-block !important;
            }

            #sidebar li span {
                display: inline-block;
            }

            .offset-lg-2 {
                margin-left: 12%;
            }

            .col-lg-10 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 88%;
                flex: 0 0 88%;
                max-width: 88%;
            }
        }

        .documentation-card li {
            line-height: 250% !important;
            font-size: 110% !important;
        }

        .documentation-card h1, .documentation-card h2, .documentation-card h3, .documentation-card h4, .documentation-card h5, .documentation-card h6 {
            color: #2568ff;
            font-weight:500;
        }

        .documentation-card h1 {
            font-size: 150% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h2 {
            font-size: 125% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h3 {
            font-size: 110% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h4 {
            font-size: 100% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h5 {
            font-size: 100% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h6 {
            font-size: 100% !important;
            padding: 0px 15px !important;
        }

        .documentation-card h1, .documentation-card h2, .documentation-card h3, .documentation-card h4, .documentation-card h5, .documentation-card h6 {
            background: #e2f0ff;
            border-radius: 4px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .documentation-card h2 {
            opacity: 0.9;
        }

        .documentation-card h3 {
            opacity: 0.75;
        }

        .documentation-card > .card-body h1:first-child {
            font-size: 150% !important;
            color: #3d5170;
            background: none !important;
            padding:0px !important;
            margin-top: 10px;
            margin-bottom:25px;
            padding-bottom:15px !important;
            border-bottom: 1px solid #eee;
        }

        .main-sidebar .nav .nav-item .nav-link.active,
        .main-sidebar .nav .nav-item.active{
            background: linear-gradient(89deg, rgba(232, 236, 255, 0.53), #002bc700 120px) !important;
        }

        hr {
            margin-bottom:30px;
        }

        body .page-title h1:first-child {
            margin-bottom:0px !important;
        }

        .page-title > p {
            font-weight:300 !important;
        }


    </style>

    <!-- STYLES -->
    @yield('css')

</head>
<div id="app">
    <div class="color-switcher animated" style="display:none;">
        <h5>Accent Color</h5>
        <ul class="accent-colors">
            <li class="accent-primary active" data-color="primary">
                <i class="material-icons">check</i>
            </li>
            <li class="accent-secondary" data-color="secondary">
                <i class="material-icons">check</i>
            </li>
            <li class="accent-success" data-color="success">
                <i class="material-icons">check</i>
            </li>
            <li class="accent-info" data-color="info">
                <i class="material-icons">check</i>
            </li>
            <li class="accent-warning" data-color="warning">
                <i class="material-icons">check</i>
            </li>
            <li class="accent-danger" data-color="danger">
                <i class="material-icons">check</i>
            </li>
        </ul>
        <div class="actions mb-4">
            <a class="mb-2 btn btn-sm btn-primary w-100 d-table mx-auto extra-action"
               href="https://designrevision.com/downloads/shards-dashboard-lite/">
                <i class="material-icons">cloud</i> Download</a>
            <a class="mb-2 btn btn-sm btn-white w-100 d-table mx-auto extra-action"
               href="https://designrevision.com/docs/shards-dashboard-lite">
                <i class="material-icons">book</i> Documentation</a>
        </div>
        <div class="social-wrapper">
            <div class="social-actions">
                <h5 class="my-2">Help us Grow</h5>
                <div class="inner-wrapper">
                    <a class="github-button" href="https://github.com/DesignRevision/shards-dashboard"
                       data-icon="octicon-star" data-show-count="true"
                       aria-label="Star DesignRevision/shards-dashboard on GitHub">Star</a>
                    <!-- <iframe style="width: 91px; height: 21px;"src="https://yvoschaap.com/producthunt/counter.html#href=https%3A%2F%2Fwww.producthunt.com%2Fr%2Fp%2F112998&layout=wide" width="56" height="65" scrolling="no" frameborder="0" allowtransparency="true"></iframe> -->
                </div>
            </div>
            <div id="social-share" data-url="https://designrevision.com/downloads/shards-dashboard-lite/"
                 data-text="🔥 Check out Shards Dashboard Lite, a free and beautiful Bootstrap 4 admin dashboard template!"
                 data-title="share"></div>
            <div class="loading-overlay">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="close">
            <i class="material-icons">close</i>
        </div>
    </div>
    <div class="color-switcher-toggle animated pulse infinite" style="display:none;">
        <i class="material-icons">settings</i>
    </div>
    <div class="container-fluid" id="main-container">
        <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <div class="main-navbar" id="brand-container">
                    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                        <a class="navbar-brand w-100 mr-0" href="/" style="line-height: 25px;">
                            <div class="d-table m-auto" onclick="window.location.href='/admin/dashboard';">
                                <img id="main-logo" class="d-inline-block align-top mr-1"
                                     style="max-width: 30px;margin-top:-1px;margin-left:-10px;"
                                     src="/images/startup-engine-logo.png" alt="Startup Engine">
                                <span class="d-none d-md-inline ml-1"
                                      style="vertical-align:middle;">Startup Engine</span>
                            </div>
                        </a>
                        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                            <i class="material-icons">&#xE5C4;</i>
                        </a>
                    </nav>
                </div>


                <div class="nav-wrapper">
                    <ul class="nav flex-column" id="sidebar">

                        @foreach(docFiles($folder) as $markdownFile)
                            @if($markdownFile != 'description.md')
                            <li class="nav-item">
                                <a class="nav-link @if($file == $markdownFile) active @endif " href="/docs/{{ $folder }}/{{ $markdownFile }}">
                                    <span>{{ docsTitle($folder, $markdownFile) }}</span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                            
                    </ul>
                    <div class="col-md-12 py-2 d-sm-none d-block" align="left">
                        <a class="btn btn-neutral btn-pill mr-2 pl-1" href="{{ URL::to('/') }}">
                            <span class="fa fa-fw fa-arrow-left mr-1 ml-0"></span>Back To Home
                        </a>
                    </div>
                </div>

            </aside>
            <!-- End Main Sidebar -->
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white" id="top-nav">
                    <!-- Main Navbar -->
                    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap border-bottom p-0">
                        <div class="main-navbar hiddenOnDesktop" id="brand-container">
                            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                                <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                                    <div class="d-table m-auto" onclick="window.location.href='/admin/dashboard';">
                                        <img id="main-logo" class="d-inline-block align-top mr-1"
                                             style="max-width: 30px;margin-top:-1px;margin-left:10px;"
                                             src="/images/startup-engine-logo.png" alt="Startup Engine">
                                        <span class="hiddenOnDesktop ml-1"
                                              style="vertical-align:middle;">Startup Engine <span class="ml-2" style="opacity:0.5;">Docs</span></span>
                                    </div>
                                </a>
                            </nav>
                        </div>
                        <div class="p-2 hiddenOnMobile">
                            <div class="nav-link" style="margin-left:-15px;opacity:0.5;margin-top:2px;">Docs</div>

                        </div>

                        <nav class="nav">
                            <div class="nav-item dropdown  m-2 mr-4" style="padding-top:1px; border-radius:25px; padding-left:10px;padding-right:10px; border:1px solid #007bff;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2">{{ ucwords($folder) }}</span></a>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    @foreach(docsFolders() as $folder)
                                        <a class="dropdown-item" href="/docs/{{ $folder }}">{{ ucwords($folder) }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <a href="#"
                               class="hiddenOnDesktop nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                               data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                               aria-controls="header-navbar">
                                <i class="material-icons">&#xE5D2;</i>
                            </a>
                        </nav>

                    </nav>
                </div>
                <!-- / .main-navbar -->
                <div class="main-content-container container-fluid px-4">
                    <div id="contentApp">
                        <!-- Page Header -->
                        <div class="page-header row no-gutters py-4" style="margin-left:-10px;">
                            <div class="col-md-12 mb-2 px-2" id="pageTitle">
                                <div class="page-title text-center text-md-left">@yield('page-title')</div>
                            </div>
                            @yield('top-menu')
                        </div>
                        <!-- End Page Header -->
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="promo-popup animated" style="display:none;">
        <a href="http://bit.ly/shards-dashboard-pro" class="pp-cta extra-action">
            <img src="https://dgc2qnsehk7ta.cloudfront.net/uploads/sd-blog-promo-2.jpg"> </a>
        <div class="pp-intro-bar"> Need More Templates?
            <span class="close">/
          <i class="material-icons">close</i>
        </span>
            <span class="up">
          <i class="material-icons">keyboard_arrow_up</i>
        </span>
        </div>
        <div class="pp-inner-content">
            <h2>Startup Engine</h2>
            <p>A premium & modern Bootstrap 4 admin dashboard template pack.</p>
            <a class="pp-cta extra-action" href="http://bit.ly/shards-dashboard-pro">Download</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.22"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="/admin-panel/scripts/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
    <script src="/admin-panel/scripts/shards-dashboards.1.0.0.min.js"></script>
    <?php
/* <script src="/admin-panel/scripts/extras.1.0.0.min.js"></script> */
?>
    <script>
        var sidebar = new Vue({
            el: '#app #sidebar',
            data() {
                return {
                    info: null
                }
            },
            mounted() {
                axios
                    .get('http://127.0.0.1:8000/api/demo/menu')
                    .then(response = > (this.info = response)
            )
                ;
                //.then(console.log(this));
            }
        })

        var menu = new Vue({
            el: '#app #accountMenu',
            data() {
                return {
                    info: null
                }
            },
            mounted() {
                axios
                    .get('http://127.0.0.1:8000/api/demo/user')
                    .then(response = > (this.info = response)
            )
                ;
            }
        })

        var notificationsList = new Vue({
            el: '#app #notificationsList',
            data() {
                return {
                    info: null
                }
            },
            mounted() {
                axios
                    .get('http://127.0.0.1:8000/api/demo/notifications')
                    .then(response = > (this.info = response.data)
            )
                ;
            }
        })

    </script>

    @yield('scripts')

</div>
</body>
</html>