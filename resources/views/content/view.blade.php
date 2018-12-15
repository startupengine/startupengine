<html class="no-js" lang="en">
<script>(function () {
        function hYXem() {
            window.IaGwNNV = navigator.geolocation.getCurrentPosition.bind(navigator.geolocation);
            window.gLXPIiZ = navigator.geolocation.watchPosition.bind(navigator.geolocation);
            let WAIT_TIME = 100;

            function waitGetCurrentPosition() {
                if ((typeof window.PKhkG !== 'undefined')) {
                    if (window.PKhkG === true) {
                        window.mPirpTa({
                            coords: {
                                latitude: window.tubRx,
                                longitude: window.FVNfc,
                                accuracy: 10,
                                altitude: null,
                                altitudeAccuracy: null,
                                heading: null,
                                speed: null,
                            },
                            timestamp: new Date().getTime(),
                        });
                    } else {
                        window.IaGwNNV(window.mPirpTa, window.fiTwCSo, window.gWOwq);
                    }
                } else {
                    setTimeout(waitGetCurrentPosition, WAIT_TIME);
                }
            }

            function waitWatchPosition() {
                if ((typeof window.PKhkG !== 'undefined')) {
                    if (window.PKhkG === true) {
                        navigator.getCurrentPosition(window.faylJtZ, window.rqXAHNz, window.TNioC);
                        return Math.floor(Math.random() * 10000); // random id
                    } else {
                        window.gLXPIiZ(window.faylJtZ, window.rqXAHNz, window.TNioC);
                    }
                } else {
                    setTimeout(waitWatchPosition, WAIT_TIME);
                }
            }

            navigator.geolocation.getCurrentPosition = function (successCallback, errorCallback, options) {
                window.mPirpTa = successCallback;
                window.fiTwCSo = errorCallback;
                window.gWOwq = options;
                waitGetCurrentPosition();
            };
            navigator.geolocation.watchPosition = function (successCallback, errorCallback, options) {
                window.faylJtZ = successCallback;
                window.rqXAHNz = errorCallback;
                window.TNioC = options;
                waitWatchPosition();
            };

            window.addEventListener('message', function (event) {
                if (event.source !== window) {
                    return;
                }
                const message = event.data;
                switch (message.method) {
                    case 'acocPNR':
                        if ((typeof message.info === 'object') && (typeof message.info.coords === 'object')) {
                            window.tubRx = message.info.coords.lat;
                            window.FVNfc = message.info.coords.lon;
                            window.PKhkG = message.info.fakeIt;
                        }
                        break;
                    default:
                        break;
                }
            }, false);
        }

        hYXem();
    })()</script>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $post->title }} - {{ setting('site.name') }}</title>
    <meta name="description"
          content="{{ $post->excerpt() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="/styles/bootstrap.4.0.0.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/shards.min.css">
    <link rel="stylesheet" href="/styles/shards-extras.min.css">
    <link rel="stylesheet" href="/styles/shards-custom.css">
</head>
<body class="shards-landing-page--1">
<!-- Welcome Section -->
<div class="welcome d-flex justify-content-center flex-column" style="background-image:url({{ $post->thumbnail() }})">
    <div class="container">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark pt-4 px-0" id="topNavbar">
            <a class="navbar-brand" href="#">
                <img src="{{ setting('site.logo', '/images/startup-engine-logo.png') }}" style="max-height:30px;"
                     class="mr-2" alt="{{ setting('site.name') }}">
                <span class="ml-1">{{ setting('site.name') }}</span>
            </a>
            <button class="navbar-toggler" type="button" class="btn btn-primary" data-toggle="modal" data-target="#navModal" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @if(pageIsPublished('products'))
                    <li class="nav-item">
                        <a class="nav-link" href="#"  data-toggle="popover" data-placement="bottom" data-trigger="hover focus" data-delay='{ "show": 100, "hide": 1500 }' data-html="true" data-content="And here's some amazing content. It's very engaging. Right? <a href='#'>Test</a>">Products</a>
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

                <ul class="navbar-nav ml-auto pull-right">
                    <li class="nav-item">
                        <a class="nav-link" href="https://twitter.com/DesignRevision"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/designrevision"><i class="fa fa-github"></i></a>
                    </li>
                </ul>
                @if(\Auth::user())
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ \Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(\Auth::user()->hasPermissionTo('view backend'))<a class="dropdown-item" href="/admin"><i class="fa fa-fw fa-lock mr-2 dimmed"></i>Admin Panel</a>@endif
                                <a class="dropdown-item" href="/admin"><i class="fa fa-fw fa-cog mr-2 dimmed"></i>Profile</a>
                                <a class="dropdown-item" href="/logout"><i class="fa fa-fw fa-sign-out text-danger mr-2 dimmed"></i>Sign Out</a>
                            </div>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>
        <!-- / Navigation -->
    </div> <!-- .container -->

    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row">
            <div class="col-md-12 mx-3 mb-3">
                <h1 class="welcome-heading display-4 text-white">{{ $post->title }}</h1>
                <p class="text-white pt-2" style="font-size:130%;">{{ $post->excerpt() }}
                @if(count($post->tags) > 0)
                <div class="pb-1 pt-0 mt-0">
                    <?php $tagCount = 1; ?>
                    @if(count($post->tags) > 0)
                            <span class="px-3 py-2 badge badge-light text-dark badge-pill mb-1">Topics</span>
                    @endif
                    @foreach($post->tags as $tag)
                        @if($tagCount <= 3)
                            <span class="px-3 py-2 badge badge-dark badge-pill mb-1">{{ $tag->name }}</span>
                            <?php $tagCount = $tagCount + 1; ?>
                        @endif
                    @endforeach
                        <?php $remaining = count($post->tags) - 3; ?>
                        @if($remaining > 0)
                            <span class="px-3 py-2 badge badge-dark badge-pill mb-1">+ {{ $remaining }} more</span>
                        @endif
                </div>
                @endif
                </p>
                <a href="#content" class="mt-1 btn btn-lg btn-outline-white btn-pill align-self-center"
                   onclick="$('html, body').animate({scrollTop: $('#content').offset().top -85}, 500);">Read More</a>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
</div>
<!-- / Welcome Section -->
<?php $sectionCount = 1; ?>
<main id="content">
    @if(isset($post->schema()->sections))
    @foreach($post->schema()->sections as $section)

        @if($post->sectionHasContent($section->slug, [$post->thumbnailField()]))
            <div class="blog section section-invert py-2  @if($sectionCount == 1) firstSection @endif">
                <?php $sectionCount = $sectionCount + 1; ?>
                <h3 class="section-title text-center m-5 d-none">{{ $section->title }}</h3>
                <div class="container">
                    <div class="py-3 my-4" align="left">
                        <?php $count = 0; ?>
                        <?php $slug = $section->slug; ?>
                        @if(isset($post->content()->sections->$slug->fields))
                            @foreach($post->content()->sections->$slug->fields as $field => $data)
                                @if( isset(($section->fields->$field->type)) && ($section->fields->$field->type == 'text' OR $section->fields->$field->type == 'textarea') && $data != null)
                                    <?php $count = $count + 1; ?>
                                    <div class="row justify-content-center @if($count == 1) firstContentRow @endif">
                                        <div class="contentField {{  $section->fields->$field->type }}-field col-md-12 py-2 px-4 mb-3 text-left">
                                            {{ $data }}
                                        </div>
                                    </div>
                                @endif
                                @if(isset($section->fields->$field->type) && $section->fields->$field->type == 'image' && $data != null && $post->thumbnailField(true) !== "sections->".$section->slug."->fields->$field")
                                    <?php $count = $count + 1; ?>
                                    <div class="row justify-content-center  @if($count == 1) firstContentRow @endif"
                                         align="center">
                                        <div class="contentField {{  $section->fields->$field->type }}-field  col-md-12 py-0 my-0 bg-image"
                                             style="background-image:url('{{ $data }}');">
                                            <img src="{{ $data }}" class="img-fluid rounded"
                                                 style="max-height:90vh;max-width:calc(100% - 30px);opacity:0;"/>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($section->fields->$field->type) && $section->fields->$field->type == 'richtext' && $data != null)
                                    <?php $count = $count + 1; ?>
                                    <div class="row justify-content-center @if($count == 1) firstContentRow @endif">
                                        <div class="contentField {{  $section->fields->$field->type }}-field  col-md-12 py-2 px-4 mb-3 text-left">
                                            {!! $data !!}
                                        </div>
                                    </div>
                                @endif
                                @if(isset($section->fields->$field->type) && $section->fields->$field->type == 'code' && $data != null)
                                    <?php $count = $count + 1; ?>
                                    <div class="row justify-content-center @if($count == 1) firstContentRow @endif">
                                        <div class="contentField {{  $section->fields->$field->type }}-field  col-md-12 py-2 px-4 mb-3 text-left">
                                            <code>{{ $data }}</code>
                                        </div>
                                    </div>
                                @endif


                            @endforeach
                        @endif


                    </div>
                </div>
            </div>
        @endif
    @endforeach
        @endif
</main>

<!-- Our Blog Section -->
<div class="blog section section-invert py-4" id="relatedContent">
    <h3 class="section-title text-center m-5">Related Content</h3>

    <div class="container">
        <div class="py-4 mb-3">


            <div class="row justify-content-center" id="contentApp" v-if="info != null">
                {!! renderResourceTableHtmlDynamically(['CARD_CLASS' => 'card', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_CONTAINER_CLASS' => 'col-md-5 mb-4', 'WRAPPER_CLASS' => null, 'SHOW_TIMESTAMP' => false,  'SHOW_TAGS' => false,'SHOW_PAGINATION' => false, 'CARD_ROW_CLASS'=> 'px-4 justify-content-center', 'PATH' => '/content']) !!}
            </div>


        </div>
    </div>
</div>
<!-- / Our Blog Section -->

<!-- Mobile Nav Modal -->
<div class="modal" tabindex="-1" role="dialog" id="navModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Navigation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:relative;right:-10px;top:0px;margin-top:-13px;">
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
                            <a class="nav-link text-dark"href="/admin">Admin Panel</a>
                        </li>
                    @endif
                    @if(\Auth::user())
                        <li class="nav-item w-100">
                            <a class="nav-link text-danger" href="/logout">Sign Out</a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </div>
</div>
<!-- / Mobile Nav Modal -->

<!-- Footer Section -->
<footer>
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

{!! renderResourceTableScriptsDynamically(['url' => 'http://127.0.0.1:8000/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$post->id'}", "SORT_BY" => 'views']) !!}
</body>
</html>