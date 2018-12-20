<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.name', 'Startup Engine') }} @if(setting('admin.name', 'Control Panel') != setting('site.name'))
            - {{ setting('admin.name', 'Control Panel') }}@endif</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Startup Engine - Dashboard</title>
    <meta name="description"
          content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php /*
            <link href="/styles/fontawesome-v5.0.6.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    */ ?>

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="/styles/bootstrap.4.0.0.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0"
          href="/admin-panel/styles/shards-dashboards.1.0.0.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <?php /*
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script async defer src="/js/app.js"></script>
    */ ?>

<!-- FAVICONS -->

    <link rel="icon" sizes="180x180" href="{{ setting('site.logo', '/images/startup-engine-logo.png') }}">

    @yield('head')

    @include('admin.styles.css')

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
    </div>
    <?php /*
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
                 data-title="share">
            </div>
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
        */ ?>
    <div class="container-fluid" id="main-container">
        <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <div class="main-navbar border-bottom" id="brand-container">
                    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom-0 p-0">
                        <a class="navbar-brand w-100 mr-0" href="/" style="line-height: 25px;">
                            <div class="d-table m-auto" onclick="window.location.href='/';">
                                <img id="main-logo" class="d-inline-block align-top mr-1"
                                     style="max-width: 30px;margin-top:-1px;margin-left:-10px;"
                                     src="{{ setting('site.logo', '/images/startup-engine-logo.png') }}"
                                     alt="Startup Engine">
                                <span class="d-none d-md-inline ml-1"
                                      style="vertical-align:middle;">{{ setting('admin.name', 'Control Panel') }}</span>
                            </div>
                        </a>
                        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                            <i class="material-icons">&#xE5C4;</i>
                        </a>
                    </nav>
                </div>
                <div id="navMenu">
                    <form autocomplete="off" action="/admin-panel/search" method="POST"
                          class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                        <div class="input-group input-group-seamless ml-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <input v-model="search" class="navbar-search form-control" type="text"
                                   placeholder="Search for something..." name="s"
                                   aria-label="Search"></div>
                        {{ csrf_field() }}
                    </form>


                    <div class="nav-wrapper" v-bind:class="{ hiddenOnMobile: search != '' && search != null }">
                        <ul class="nav flex-column" id="sidebar">
                            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Overview">view_quilt</i> <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/users">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Users">people</i> <span>Users</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/pages*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/pages">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Pages">library_books</i> <span>Pages</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/content*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/content">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Content">notes</i> <span>Content</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/settings*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/settings">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Settings">settings</i> <span>Settings</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/products">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Products">shopping_basket</i> <span>Products</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/analytics*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/analytics">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Analytics">bar_chart</i> <span>Analytics</span>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('admin/preferences*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/preferences/schemas">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Preferences">list_alt</i> <span>Preferences</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('admin/logs*') ? 'active' : '' }}">
                                <a class="nav-link" href="/admin/logs">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="System Logs">history</i> <span>System Logs</span>
                                </a>
                            </li>
                            @if(\Auth::user()->hasRole('admin'))
                                <li class="nav-item {{ Request::is('admin/realtime*') ? 'active' : '' }}">
                                    <a class="nav-link" href="/admin/realtime">
                                        <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                           title="Real Time Data">track_changes</i> <span>Real Time Data</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="/docs" target="_blank">
                                    <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                       title="Documentation">book</i> <span>Documentation</span>
                                </a>
                            </li>
                            @if(ENV('APP_ENV') == 'local')
                                <li class="nav-item">
                                    <a class="nav-link" href="/dev/telescope" target="_blank">
                                        <i class="material-icons" data-toggle="tooltip" data-placement="left"
                                           title="Developer Tools">code</i> <span>Developer Tools</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- End Main Sidebar -->
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white border-bottom" id="top-nav">
                    <!-- Main Navbar -->
                    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap border-bottom-0 p-0">
                        <form autocomplete="off" action="/admin-panel/search" method="POST"
                              class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                            <div class="input-group input-group-seamless">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                                <input class="navbar-search form-control" type="text" name="s"
                                       placeholder="Search for something..." aria-label="Search"></div>
                            {{ csrf_field() }}
                        </form>
                        <ul class="navbar-nav border-left flex-row ">
                            <li class="nav-item border-right dropdown notifications d-none" id="notificationsList">
                                <a class="nav-link nav-link-icon text-center" href="#" role="button"
                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <div class="nav-link-icon__wrapper">
                                        <i class="material-icons">&#xE7F4;</i>
                                        <span class="badge badge-pill badge-danger" v-if="info !== null"
                                              style="opacity:0;"
                                              v-bind:style="{ 'opacity': '1' }">@{{ info.count }}</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink"
                                     v-if="info !== null">
                                    <a class="dropdown-item" href="#" v-for="item in info.items"
                                       v-if="item.text != null">
                                        <div class="notification__icon-wrapper">
                                            <div class="notification__icon">
                                                <i class="material-icons">&#xE6E1;</i>
                                            </div>
                                        </div>
                                        <div class="notification__content">
                                            <span class="notification__category">@{{ item.category }}</span>
                                            <p>@{{ item.text }}</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item notification__all text-center" href="#"> View all
                                        Notifications </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" id="accountMenu" style="cursor:pointer;">
                                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <div id="menuAvatar"></div>
                                    <span id="menuUserName"
                                          class="d-none d-md-inline-block text-capitalize">{{ \Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small">
                                    <a class="dropdown-item" href="/admin/users/{{ \Auth::user()->id }}">
                                        <i class="material-icons">&#xE7FD;</i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                       href="/admin/users/{{ \Auth::user()->id }}/preferences">
                                        <i class="material-icons">settings</i> Preferences</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="/logout">
                                        <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                                </div>
                            </li>
                        </ul>
                        <nav class="nav">
                            <a href="#"
                               class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                               data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                               aria-controls="header-navbar">
                                <i class="material-icons">&#xE5D2;</i>
                            </a>
                        </nav>
                    </nav>
                </div>
                <div class="main-content-container container-fluid px-4">
                    @if (array_key_exists('content', View::getSections()))
                        <div id="contentApp">
                            <div class="page-header row no-gutters py-4 toggleVisibility" v-if="info != null"
                                 v-bind:class="{visible: (status != null), invisible: status == null }">
                                <div class="col-md-6 col-sm-12 text-center text-sm-center text-md-left mb-3"
                                     id="pageTitle">
                                    <h3 class="page-title mt-1 mb-1">@yield('page-title')</h3>
                                </div>
                                @yield('top-menu')
                            </div>

                            <div v-else class="page-header row no-gutters py-4 toggleVisibility"
                                 v-bind:class="{visible: (status == null || status != 'loading'), invisible: status == null }">
                                <div class="col-md-6 col-sm-12 text-center text-sm-center text-md-left mb-3"
                                     id="pageTitle">
                                    <h3 class="page-title mt-1 mb-1">@yield('page-title')</h3>
                                </div>
                                @yield('top-menu')
                            </div>
                            @yield('content')

                        </div>
                    @else
                        <div>
                            <div class="page-header row no-gutters py-4 ">
                                <div class="col-md-6 col-sm-6 text-center text-sm-left mb-3" id="pageTitle">
                                    <h3 class="page-title mt-1 mb-1">@yield('page-title')</h3>
                                </div>
                                @yield('top-menu')
                            </div>
                            @yield('alt_content')
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <?php /*
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
    */?>

    {!! renderConfirmActionModal() !!}

    <?php /*
        //<script src="https://cdn.jsdelivr.net/npm/moment@2.22"></script>
        //<script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        //<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
        //<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        //<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        //<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
        //<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        //<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
        //<script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
        //<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
    */?>
    <script src="/js/moment-2.22.js"></script>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/jquery-ui-1.12.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="/js/popper.js"></script>
    <script src="/admin-panel/scripts/shards.min.js"></script>
    <script src="/js/chart-min.js"></script>
    <script src="/js/vue-chartjs-min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.sharre.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/axios-min.js"></script>
    <script src="/js/polyfill-min.js"></script>
    <script src="/js/bootstrap-vue.js"></script>

    <script src="/admin-panel/scripts/shards-dashboards.1.0.0.min.js"></script>
    <?php /* <script src="/admin-panel/scripts/extras.1.0.0.min.js"></script> */ ?>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script>
        var sidebar = new Vue({
            el: '#app #navMenu',
            data() {
                return {
                    search: null
                }
            },
            mounted() {
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

    {!! renderConfirmActionScripts() !!}

</div>
</body>
</html>