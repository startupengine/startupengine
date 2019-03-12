@extends('layouts.shards_frontend')

@section('title')
    {{ $feature->name }} - Feature Details
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
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
            background: linear-gradient(235deg, #62d3ff 10%, #7277ff 100%) !important;
            opacity:1 !important;
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
                <h2 class="welcome-heading display-4 text-white text-center ">{{ $feature->name }}</h2>
                <div align="center">
                    <span class="badge bg-light-blue text-dark-blue badge-pill mt-3 px-3">Feature Details</span>
                </div>
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
                        <div class="card-body text-center bg-very-light-blue text-dark br-5 p-5" style="font-size:150%;">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <img src="{!! $feature->getJsonContent('[sections][heading][fields][thumbnail]') !!}" style="max-width:100%;max-height:250px;"/>
                                </div>
                                <div class="col-md-8 pt-5 pt-lg-0 pt-md-0 text-left">
                                    {!! $feature->getJsonContent('[sections][heading][fields][description]') !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

                <div class="row px-3 mt-0 pb-5">
                    <div class="col-md-12 px-4">
                        <div class="card flat mb-5" style="display:contents;min-height:50px !important;">
                            <div class="card-body text-left bg-white text-dark br-5 p-5" style="font-size:115%;">
                                {!! $feature->getJsonContent('[sections][heading][fields][body]') !!}
                            </div>
                        </div>
                    </div>
                </div>

        </div>

        <?php /*
        <?php $plans = $feature->stripePlans()->data; ?>
        @if(count($plans) <= 1)
            <div class="blog section bg-white p-4"  style="min-height:calc(100% - 300px);">
                <div class="container">
                    <h4 class="section-title text-center mb-5 mt-3">Pricing</h4>
                    <div class="row px-0 pt-3 pb-5" >
                            <div class="col-md-5 mx-auto">
                                <div class="card text-center  h-auto" style=" min-height:auto !important;">
                                    <div class="card-header text-dark-green bg-light-green">{{ $feature->name }}</div>
                                    <div class="card-body h-auto text-center">
                                        <p class="card-text">@if($feature->getJsonContent('[sections][about][fields][description]') != null){{ $feature->getJsonContent('[sections][about][fields][description]') }} @endif</p>
                                        <h5 class="card-title mb-4"><small style="font-weight:400;  ">$</small>{{ $feature->price/100 }}</h5>
                                        <h6 class="card-subtitle mb-4 text-muted">per month</h6>
                                        <div class="p-3">{{ $feature->description }}</div>
                                    </div>
                                    <div class="card-footer text-center pt-0 pb-5">
                                        <a href="/subscribe" class="btn btn-default btn-cta btn-pill raised mt-0 ">Get Started</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        @elseif(count($plans) > 1)
            <div class="blog section section-invert p-4 pt-5 border-none" style="min-height:calc(100% - 300px);">
                <div class="container">

                        <div class="row mb-4 pt-4 pb-0">
                            <div class="col-md-12 text-dull-blue mb-0">
                                <div class=" h-auto pt-3 px-4 pb-3 " style="min-height:auto !important;border-radius:5px !important;xwxw">
                                    <h5>{{ $feature->name }}</h5>
                                    @if($feature->getJsonContent('[sections][about][fields][description]') != null) <h6 class="dimmed">{{ $feature->getJsonContent('[sections][about][fields][description]') }}</h6> @endif
                                    @if($feature->description != null) <div class="p-3">{{ $feature->description }} </div>@endif
                                </div>
                            </div>
                        </div>


                    <div class="row" >
                        <div class="row justify-content-center text-center" id="contentApp" >
                            @foreach($plans as $plan)
                                <?php $dbEntry = \App\Plan::where('stripe_id', '=', $plan->id)->first(); ?>
                                <div class="@if(count($plans) > 2) col-md-4 @else col-md-6 @endif mb-5 mx-auto">
                                    <div class="card h-auto " style="min-height:auto !important;">
                                        <div class="card-header text-dark-green bg-light-green">{{ $plan->nickname }}</div>
                                        <div class="card-body h-auto text-center">
                                            @if($dbEntry != null && $dbEntry->getJsonContent('[sections][about][fields][description]') != null) <p class="card-text">{{ $dbEntry->getJsonContent('[sections][about][fields][description]')  }}</p>@endif
                                            <h5 class="card-title mb-4"><small style="font-weight:400;  ">$</small>{{ $plan->amount/100 }}</h5>
                                            <h6 class="card-subtitle mb-4 text-muted">per {{ $plan->interval }}</h6>
                                            @if($dbEntry != null && $dbEntry->getJsonContent('[sections][about][fields][features]') != null)<div>{!!  $dbEntry->getJsonContent('[sections][about][fields][features]') !!}</div>@endif
                                            @if($dbEntry->description != null) <div class="p-3">{{ $dbEntry->description }} </div>@endif
                                        </div>
                                        <div class="card-footer text-center pt-0 pb-5">
                                            <a href="/subscribe/{{ $feature->stripe_id }}/{{ $plan->id }}" class="btn btn-default btn-cta btn-pill raised mt-0 ">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endif

 */ ?>
    </main>
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$feature->id'}", "SORT_BY" => 'views', "LIMIT" => 3]) !!}
@endsection