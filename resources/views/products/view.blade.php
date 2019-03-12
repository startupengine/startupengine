@extends('layouts.shards_frontend')

@section('title')
    {{ $product->name }} Features
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
@endsection


@section('splash-style')
     @if($product->thumbnail() != null) background-image:url('{{ $product->thumbnail() }}');  @endif
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
            background: linear-gradient(45deg, #c75aff, #ff7f79) !important;
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
                <h2 class="welcome-heading display-4 text-white text-center ">{{ $product->name }}</h2>
                <div align="center">
                    <span class="badge bg-light-blue text-dark-blue badge-pill mt-3 px-3">Product Overview</span>
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
            <div class="row px-3 mb-4">
                <div class="col-md-12 px-4">
                    <div class="card raised-1" style="margin-top:-60px; min-height:50px !important;">
                        <div class="card-body text-center bg-very-light-blue text-dark br-5 p-5">
                            {!! $product->getJsonContent('[sections][about][fields][richtext_description]') !!}
                        </div>
                    </div>
                </div>
            </div>
            @foreach($product->features()->get() as $feature)
                <div class="row px-3 my-4">
                    <div class="col-md-12 px-4">
                        <div class="card flat" style="min-height:50px !important;">
                            <div class="card-body text-center bg-white text-dark br-5 p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="text-left"><span class="underlined text-capitalize bg-white">{{ $feature->name }}</span></h3>
                                        <p class="card-text text-left py-4" style="font-size:150%;text-transform:unset !important;">{!! $feature->getJsonContent('[sections][heading][fields][description]') !!}</p>
                                        <div align="left" class="mb-4"><a href="/features/{{ $feature->id }}" class="btn btn-primary">@if($feature->getJsonContent('[sections][heading][fields][button]') != null){!! $feature->getJsonContent('[sections][heading][fields][button]') !!}@else Read More @endif</a></div>
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
        <?php $plans = $product->stripePlans()->data; ?>
        @if(count($plans) <= 1)
            <div class="blog section bg-white p-4"  style="">
                <div class="container">
                    <h4 class="section-title text-center mb-5 mt-5 pt-0">Pricing</h4>
                    <div class="row px-0 pt-3 pb-5" >
                            <div class="col-md-5 mx-auto">
                                <div class="card text-center  h-auto" style=" min-height:auto !important;">
                                    <div class="card-header text-dark-blue bg-light-blue">{{ $product->name }}</div>
                                    <div class="card-body h-auto text-center">
                                        <p class="card-text">@if($product->getJsonContent('[sections][about][fields][description]') != null){{ $product->getJsonContent('[sections][about][fields][description]') }} @endif</p>
                                        <h5 class="card-title mb-4"><small style="font-weight:400;  ">$</small>{{ $product->price/100 }}</h5>
                                        <h6 class="card-subtitle mb-4 text-muted">per month</h6>
                                        <div class="p-3">{{ $product->description }}</div>
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
                                    <h5>{{ $product->name }}</h5>
                                    @if($product->getJsonContent('[sections][about][fields][description]') != null) <h6 class="dimmed">{{ $product->getJsonContent('[sections][about][fields][description]') }}</h6> @endif
                                    @if($product->description != null) <div class="p-3">{{ $product->description }} </div>@endif
                                </div>
                            </div>
                        </div>


                    <div class="row" >
                        <div class="row justify-content-center text-center" id="contentApp" >
                            @foreach($plans as $plan)
                                <?php $dbEntry = \App\Plan::where('stripe_id', '=', $plan->id)->first(); ?>
                                <div class="@if(count($plans) > 2) col-md-4 @else col-md-6 @endif mb-5 mx-auto">
                                    <div class="card h-auto " style="min-height:auto !important;">
                                        <div class="card-header text-dark-blue bg-light-blue">{{ $plan->nickname }}</div>
                                        <div class="card-body h-auto text-center">
                                            @if($dbEntry != null && $dbEntry->getJsonContent('[sections][about][fields][description]') != null) <p class="card-text">{{ $dbEntry->getJsonContent('[sections][about][fields][description]')  }}</p>@endif
                                            <h5 class="card-title mb-4"><small style="font-weight:400;  ">$</small>{{ $plan->amount/100 }}</h5>
                                            <h6 class="card-subtitle mb-4 text-muted">per {{ $plan->interval }}</h6>
                                            @if($dbEntry != null && $dbEntry->getJsonContent('[sections][about][fields][features]') != null)<div>{!!  $dbEntry->getJsonContent('[sections][about][fields][features]') !!}</div>@endif
                                            @if($dbEntry->description != null) <div class="p-3">{{ $dbEntry->description }} </div>@endif
                                        </div>
                                        <div class="card-footer text-center pt-0 pb-5">
                                            <a href="/subscribe/{{ $product->stripe_id }}/{{ $plan->id }}" class="btn btn-default btn-cta btn-pill raised mt-0 ">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </main>
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$product->id'}", "SORT_BY" => 'views', "LIMIT" => 3]) !!}
@endsection