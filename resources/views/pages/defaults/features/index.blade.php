@extends('layouts.shards_frontend')

@section('title')
    @if($page->title != null){{ $page->title }} @else Features @endif
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
            min-height: 210px !important;
            height: auto !important;
        }

        #topNavbar {
            background: transparent !important;
        }

        .welcome-heading {
            letter-spacing: 0px;
            font-size: 250% !important;
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
            <div class="col-md-12 px-4 mb-3 mt-4">
                <h2 class="welcome-heading display-4 text-dark text-center ">Features</h2>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')


    @if(hasSubscriptionProductsForSale() && count(\App\Feature::all()) > 0)
        <div class="container">
        @foreach(\App\Feature::where('status', 'PUBLISHED')->get() as $feature)
            <div class="row px-3 my-4">
                <div class="col-md-12 px-4 pb-3 mb-3 mt-3">
                    <div class="card mb-5 raised" style="min-height:50px !important;">
                        <div class="card-body text-center bg-white text-dark br-5 p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="text-left"><span class="underlined pb-4 d-block text-capitalize bg-white">{{ $feature->name }}</span></h3>
                                    <p class="card-text text-left py-4" style="font-size:150%;text-transform:unset !important;">{!! $feature->getJsonContent('[sections][heading][fields][description]') !!}</p>
                                    <div align="left" class="mb-4"><a href="/features/{{ $feature->slug }}" class="btn btn-primary">@if($feature->getJsonContent('[sections][heading][fields][button]') != null){!! $feature->getJsonContent('[sections][heading][fields][button]') !!}@else Read More @endif</a></div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{!! $feature->getJsonContent('[sections][heading][fields][thumbnail]') !!}" style="max-width:100%;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @endif
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME'=> 'contentApp', 'div_id'=> 'contentApp','url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', 'PER_PAGE' => 3, 'LIMIT' => 3]) !!}
@endsection