@extends('layouts.shards_frontend')

@section('title')
    {{ $promo->name }}
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
@endsection

@section('splash-style')
    @if($promo->getJsonContent('[sections][heading][fields][background]')  != null) background-image:url('{{ $promo->getJsonContent('[sections][heading][fields][background]')  }}');  @endif
@endsection


@section('css')
    <style>
        #contentApp {
            display: inline-table !important;
            width: 100% !important;
        }

        h2.welcome-heading {
            font-size:220% !important;
            font-weight: 200;
        }

        .shards-landing-page--1 .welcome {
            min-height:400px !important;
            height:auto !important;
        }

        .shards-landing-page--1 .welcome:before {
            background:rgba(0, 26, 101, 0.76) !important;
            @if($promo->getJsonContent('[sections][heading][fields][background]')  == null) opacity:1; @else opacity:0.5 !important; @endif
            color:#fff !important;
            /*border-bottom:30px rgba(0,0,0,0.25) solid;*/
            /*box-shadow:0px 0px 90px rgba(0,0,150,0.5);*/
        }

        .shards-landing-page--1 .welcome h1,.shards-landing-page--1 .welcome h2 {
            color:#fff !important;
        }

        main#content {
            background:#fff !important;
        }
    </style>
@endsection

@section('navbar-classes')
    navbar-dark
@endsection

@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row">
            <div class="col-md-12 px-4 mb-3">
                <h2 class="welcome-heading font-weight-800 display-4 text-white text-center px-4">{{ $promo->getJsonContent('[sections][heading][fields][headline]')  }}</h2>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')
    <?php $sectionCount = 1; ?>
    <main id="content" class="bg-white">
        <div class="container bg-white">
            <div class="row px-3 mb-2">
                <div class="col-md-12 px-4">
                    <div class="card raised-1" style="margin-top:-60px; min-height:50px !important;">
                        <div class="card-body text-center bg-white raised-1 text-dark br-5 p-5" style="font-size:150%;">
                            <div class="row">
                                @if($promo->getJsonContent('[sections][heading][fields][thumbnail]') != null && $promo->getJsonContent('[sections][heading][fields][video]') == null)
                                    <div class="col-md-4 text-left">
                                        <img src="{!! $promo->getJsonContent('[sections][heading][fields][thumbnail]') !!}" style="max-width:100%;max-height:250px;"/>
                                    </div>
                                @endif
                                <div class="@if($promo->getJsonContent('[sections][heading][fields][thumbnail]') != null && $promo->getJsonContent('[sections][heading][fields][video]') == null) col-md-8 @else col-md-12 @endif text-center">
                                    @if($promo->getJsonContent('[sections][heading][fields][video]') != null)
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if(getVideoHost($promo->getJsonContent('[sections][heading][fields][video]')) == 'vimeo')
                                                <div id="player" style="background:#000;border-radius:5px !important;" data-plyr-provider="vimeo" data-plyr-embed-id="{{ getVideoId($promo->getJsonContent('[sections][heading][fields][video]')) }}"></div>
                                            @elseif(getVideoHost($promo->getJsonContent('[sections][heading][fields][video]')) == 'youtube')
                                            <div class="plyr__video-embed mb-4" id="player" style="border-radius:5px !important;">
                                                <iframe style="background:#000;"
                                                        src="{{ $promo->getJsonContent('[sections][heading][fields][video]') }}{{ getVideoQueryString($promo->getJsonContent('[sections][heading][fields][video]')) }}"
                                                        allowfullscreen
                                                        allowtransparency
                                                        allow="autoplay"
                                                ></iframe>
                                            </div>
                                            @else
                                                <video @if( $promo->getJsonContent('[sections][heading][fields][thumbnail]') != null ) poster="{{ $promo->getJsonContent('[sections][heading][fields][thumbnail]') }}" @endif id="player" playsinline controls>
                                                    <source src="{{ $promo->getJsonContent('[sections][heading][fields][video]') }}" type="video/mp4" />
                                                </video>
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-left m-auto pt-4 pt-lg-0 pt-md-0">
                                            <p class="m-auto pb-3">{!! $promo->getJsonContent('[sections][heading][fields][description]') !!}</p>
                                        </div>
                                    </div>
                                    @else
                                    <p style="font-size:12pt !important;"  class="m-auto">{!! $promo->getJsonContent('[sections][heading][fields][description]') !!}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                @if($promo->getJsonContent('[sections][heading][fields][body]') != null)
                <div class="row px-3 mt-0 pb-0">
                    <div class="col-md-12 px-4 pb-2">
                        <div class="card flat " style="display:contents;min-height:50px !important;">
                            <div class="card-body text-left bg-white text-dark br-5 pt-0 px-5 pb-5" style="font-size:115%;">
                                {!! $promo->getJsonContent('[sections][heading][fields][body]') !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

        </div>


    </main>
@endsection
