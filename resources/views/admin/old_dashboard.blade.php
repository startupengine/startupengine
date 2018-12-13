<!doctype html>
<html class="no-js h-100" lang="en">
<head>
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
    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="styles/shards-dashboards.1.0.0.min.css">
    <link rel="stylesheet" href="styles/extras.1.0.0.min.css">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</head>
<body class="h-100">
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
    <div class="container-fluid">
        <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <div class="main-navbar">
                    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                        <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                            <div class="d-table m-auto">
                                <img id="main-logo" class="d-inline-block align-top mr-1"
                                     style="max-width: 30px;margin-top:-1px;margin-left:-10px;"
                                     src="images/startup-engine-logo.png" alt="Startup Engine">
                                <span class="d-none d-md-inline ml-1"
                                      style="vertical-align:middle;">Startup Engine</span>
                            </div>
                        </a>
                        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                            <i class="material-icons">&#xE5C4;</i>
                        </a>
                    </nav>
                </div>
                <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                    <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                        <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                               aria-label="Search"></div>
                </form>
                <div class="nav-wrapper">
                    <ul class="nav flex-column" id="sidebar">
                        <li class="nav-item" v-for="item in info.data" v-if="item.icon != null">
                            <a class="nav-link" v-bind:href="item.url">
                                <i class="material-icons">@{{ item.icon }}</i>@{{ item.text }}
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            <!-- End Main Sidebar -->
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white">
                    <!-- Main Navbar -->
                    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                        <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                            <div class="input-group input-group-seamless ml-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                                <input class="navbar-search form-control" type="text"
                                       placeholder="Search for something..." aria-label="Search"></div>
                        </form>
                        <ul class="navbar-nav border-left flex-row ">
                            <li class="nav-item border-right dropdown notifications" id="notificationsList">
                                <a class="nav-link nav-link-icon text-center" href="#" role="button"
                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <div class="nav-link-icon__wrapper">
                                        <i class="material-icons">&#xE7F4;</i>
                                        <span class="badge badge-pill badge-danger">@{{ info.count }}</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#" v-for="item in info.items" v-if="item.text != null">
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
                            <li class="nav-item dropdown" id="accountMenu">
                                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <img class="user-avatar rounded-circle mr-2" src="images/avatars/0.jpg"
                                         alt="User Avatar">
                                    <span class="d-none d-md-inline-block">@{{ info.data.userName }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-small">
                                    <a class="dropdown-item" href="user-profile-lite.html">
                                        <i class="material-icons">&#xE7FD;</i> Profile</a>
                                    <a class="dropdown-item" href="components-blog-posts.html">
                                        <i class="material-icons">vertical_split</i> My Content</a>
                                    <a class="dropdown-item" href="add-new-post.html">
                                        <i class="material-icons">note_add</i> Add New Post</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#">
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
                <!-- / .main-navbar -->
                <div class="main-content-container container-fluid px-4">
                    <!-- Page Header -->
                    <div class="page-header row no-gutters py-4">
                        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                            <h3 class="page-title">Dashboard</h3>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <!-- Small Stats Blocks -->
                    <div class="row" id="analyticCounts">
                        <div class="col-lg col-md-6 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Content Views</span>
                                            <h6 class="stats-small__value count my-3">{!! number_format(callApi('/api/demo/dashboard/analytics')->contentViewCount) !!}</h6>
                                        </div>
                                        <div class="stats-small__data">
                                            <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-6 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Page Views</span>
                                            <h6 class="stats-small__value count my-3">{!! number_format(callApi('/api/demo/dashboard/analytics')->pageViewCount) !!}</h6>
                                        </div>
                                        <div class="stats-small__data">
                                            <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Clicks</span>
                                            <h6 class="stats-small__value count my-3">{!! number_format(callApi('/api/demo/dashboard/analytics')->clickCount) !!}</h6>
                                        </div>
                                        <div class="stats-small__data">
                                            <span class="stats-small__percentage stats-small__percentage--decrease">3.8%</span>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Users</span>
                                            <h6 class="stats-small__value count my-3">{!! number_format(callApi('/api/demo/dashboard/analytics')->userCount) !!}</h6>
                                        </div>
                                        <div class="stats-small__data">
                                            <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-sm-12 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Subscribers</span>
                                            <h6 class="stats-small__value count my-3">{!! number_format(callApi('/api/demo/dashboard/analytics')->subscriberCount) !!}</h6>
                                        </div>
                                        <div class="stats-small__data">
                                            <span class="stats-small__percentage stats-small__percentage--decrease">2.4%</span>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Small Stats Blocks -->
                    <div class="row">

                        <!-- Recent Content Component -->
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                            <div class="card card-small blog-comments" id="recentContent">
                                <div class="card-header border-bottom">
                                    <h6 class="m-0">Recently Added Content</h6>
                                </div>
                                <div class="card-body p-0">

                                    <div class="blog-comments__item d-flex p-3" v-for="item in info" v-if="item.message != null" >
                                        <div class="blog-comments__avatar mr-3">
                                            <div v-bind:style="{ 'background-image': 'url(' + item.image + ')' }" style="display:block !important;height:50px;width:50px;border-radius:5px;background-size:cover;background-position:center;">
                                                &nbsp;</div>
                                        </div>
                                        <div class="blog-comments__content">
                                            <div class="blog-comments__meta text-muted">
                                                <a class="text-secondary" href="#">@{{ item.name }}</a> published<br>
                                                <a class="text-secondary" href="#">@{{ item.title }}</a>
                                                <span class="text-muted"> 5 days ago</span>
                                            </div>
                                            <p class="m-0 my-1 mb-2 text-muted">@{{ item.message }}</p>
                                            <div class="blog-comments__actions">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-white">
                                                      <span class="text-success">
                                                        <i class="material-icons">check</i>
                                                      </span> Publish
                                                    </button>
                                                    <button type="button" class="btn btn-white">
                                                      <span class="text-danger">
                                                        <i class="material-icons">clear</i>
                                                      </span> Block
                                                    </button>
                                                    <button type="button" class="btn btn-white">
                                                      <span class="text-light">
                                                        <i class="material-icons">more_vert</i>
                                                      </span> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-white">
                                                      <span class="text-light">
                                                        <i class="material-icons">search</i>
                                                      </span> View
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="row">
                                        <div class="col text-center view-report">
                                            <button type="submit" class="btn btn-white">View More Posts</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Discussions Component -->
                        <!-- Recent Social Component -->
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                            <div class="card card-small blog-comments" id="socialFeed">
                                <div class="card-header border-bottom">
                                    <h6 class="m-0">Social Feed</h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="blog-comments__item d-flex p-3" v-for="item in info" v-if="item.message != null" >
                                        <div class="blog-comments__avatar mr-3">
                                            <div v-bind:style="{ 'background-image': 'url(' + item.image + ')' }" style="display:block !important;height:50px;width:50px;border-radius:25px;background-size:cover;background-position:center;"></div>
                                        </div>
                                        <div class="blog-comments__content">
                                            <div class="blog-comments__meta text-muted">
                                                <a class="text-secondary" href="#">@{{ item.name }}</a> said<br>
                                            </div>
                                            <p class="m-0 my-1 mb-2 text-muted">@{{ item.message }}</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="row">
                                        <div class="col text-center view-report">
                                            <button type="submit" class="btn btn-white">View More Comments</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Discussions Component -->
                    </div>
                </div>
                <footer class="main-footer d-flex p-2 px-3 bg-white border-top" style="display:none !important;">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                    </ul>
                    <span class="copyright ml-auto my-auto mr-2">Copyright © 2018
              <a href="https://designrevision.com" rel="nofollow">DesignRevision</a>
            </span>
                </footer>
            </main>
        </div>
    </div>
    <div class="promo-popup animated" style="display:none;">
        <a href="http://bit.ly/shards-dashboard-pro" class="pp-cta extra-action">
            <img src="https://dgc2qnsehk7ta.cloudfront.net/uploads/sd-blog-promo-2.jpg"> </a>
        <div class="pp-intro-bar"> Need More Templates?
            <span class="close">
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="scripts/extras.1.0.0.min.js"></script>
    <script src="scripts/shards-dashboards.1.0.0.min.js"></script>
    <script src="scripts/app/app-blog-overview.1.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>

        var sidebar = new Vue({
            el: '#app #sidebar',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/menu')
                    .then(response => (this.info = response));
                //.then(console.log(this));
            }
        })

        var menu = new Vue({
            el: '#app #accountMenu',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/user')
                    .then(response => (this.info = response));
            }
        })

        var kpis = new Vue({
            el: '#app #analyticCounts',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/dashboard/analytics')
                    .then(response => (this.info = response.data));
            }
        })

        var notificationsList = new Vue({
            el: '#app #notificationsList',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/notifications')
                    .then(response => (this.info = response.data));
            }
        })

        var socialFeed = new Vue({
            el: '#app #socialFeed',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/dashboard/social')
                    .then(response => (this.info = response.data));
            }
        })

        var socialFeed = new Vue({
            el: '#app #recentContent',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/dashboard/content')
                    .then(response => (this.info = response.data));
            }
        })

    </script>
</div>
</body>
</html>