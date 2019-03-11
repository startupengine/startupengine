@extends('layouts.shards_frontend')

@section('title')
    @if($page->title != null){{ $page->title }} @else Home @endif
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
@endsection


@section('splash-style')
    @if($page->thumbnail() == null)
        <?php $page->thumbnail =
            "https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1607&q=80"; ?>
        background-image:url('{{ $page->thumbnail }}');
    @else
        <?php $page->thumbnail = null; ?>
    @endif

@endsection

@section('css')
    <style>


        .shards-landing-page--1 .welcome:before {
            background: #ebf1fe !important;
            opacity: 1;
        }

        .shards-landing-page--1 .welcome {
            min-height: 400px !important;
            height: auto !important;
        }

        #topNavbar {
            background: transparent !important;
        }

        .welcome-heading {
            font-weight: 800 !important;
            letter-spacing: 0px;
            font-size: 300% !important;
        }

        h6 {
            font-weight: 300 !important;
            font-size: 130% !important;
        }

        .welcome-heading, h1,h2,h3,h4,h5,h6 {
            color: #333b62 !important;
        }

    </style>
@endsection


@section('navbar-classes')
    navbar-light navbar-blend-light-blue
@endsection


@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row mt-5 pt-5">
            <div class="col-md-12 px-4 mb-3">
                <h1 class="welcome-heading display-4 text-dark text-center ">@if($page->title != null) {{ $page->title }} @else {{ setting('site.name', 'Startup Engine') }} @endif</h1>
                <h6 class="pt-2 text-center mb-4 mx-4">@if($page->getJsonContent('[sections][heading][fields][headline]') != null) {{ $page->getJsonContent('[sections][heading][fields][headline]') }} @else {{ setting('site.description') }} @endif</h6>
                <p align="center">
                    @if(hasSubscriptionProductsForSale())
                        <a href="/pricing" class="mt-1 btn btn-md btn-primary   align-self-center ml-2">Get Started</a>
                    @endif
                    @if($page->getJsonContent('[sections][body]') != null)
                        <a href="#content"
                           class="mt-1 btn btn-md btn-primary bg-light-blue text-dark-blue btn-no-border  align-self-center "
                           onclick="$('html, body').animate({scrollTop: $('#content').offset().top @if(isset($message)) -205 @else -155 @endif }, 500);">Learn
                            More</a>
                    @elseif(hasDocs())
                        <a href="/docs"
                           class="mt-1 btn btn-md btn-primary  bg-light-blue text-dark-blue btn-no-border align-self-center ">Learn
                            More</a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')
    @if(count(\App\Post::where('status', '=', 'PUBLISHED')->get()) > 0)
    <main id="content" style="min-height:calc(100vh - 400px)">
        <div class="blog section bg-none p-4  " style="min-height:30vh;border:none !important;">
            <div class="container">
                <div class="row px-0 pt-3">
                    <h5 class="text-left px-1 mb-3 ml-5 underlined" style="">Recent Content</h5>
                    <div class="row justify-content-center" id="contentApp" style="display:contents !important;" align="center">
                        {!! renderResourceTableHtmlDynamically(['CARD_CLASS' => 'card mb-4 mx-2', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_CONTAINER_CLASS' => 'col-md-4 mb-4', 'WRAPPER_CLASS' => "w-100", 'SHOW_TIMESTAMP' => false,  'SHOW_TAGS' => false,'SHOW_PAGINATION' => false, 'CARD_ROW_CLASS'=> 'px-4 justify-content-center', 'PATH' => '/content', 'WRAPPER_STYLE' => 'margin-top:20px;', 'CONTAINER_STYLE'=> 'width:calc(100%);opacity:0;']) !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endif
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME'=> 'contentApp', 'div_id'=> 'contentApp','url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', 'PER_PAGE' => 3, 'LIMIT' => 3]) !!}
@endsection