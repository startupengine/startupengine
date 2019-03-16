@extends('layouts.shards_frontend')

@section('title')
    {{ $feature->name }} - Feature Details
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
@endsection

@section('splash-style')
    @if($feature->getJsonContent('[sections][heading][fields][background]')  != null) background-image:url('{{ $feature->getJsonContent('[sections][heading][fields][background]')  }}');  @endif
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
            background: #252525e0 !important;
            @if($feature->getJsonContent('[sections][heading][fields][background]')  == null) opacity:1 !important; @else opacity:0.9 !important; @endif
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
                @if($feature->getJsonContent('[sections][heading][fields][body]') != null)
                <div class="row px-3 mt-0 pb-0">
                    <div class="col-md-12 px-4">
                        <div class="card flat mb-0" style="display:contents;min-height:50px !important;">
                            <div class="card-body text-left bg-white text-dark br-5 pt-5 px-5" style="font-size:115%;">
                                {!! $feature->getJsonContent('[sections][heading][fields][body]') !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

        </div>

        @if(count($feature->products()->get()) >= 1)
            <div class="blog section bg-white pt-3 pb-5">
                <div class="container">
                    <h4 class="section-title text-center mb-5 mt-3">Related Products</h4>
                    <div class="row px-0 pt-3 pb-0 mx-2" >
                        @foreach($feature->products()->get() as $product)
                            <div class="col-md-5 mb-5 mx-auto">
                                <div class="card text-center  h-auto" style=" min-height:auto !important;">
                                    <div class="card-body @if($product->getJsonContent('[sections][about][fields][description]') != null) pt-0 px-0 @endif">
                                        @if($product->getJsonContent('[sections][about][fields][image]') != null OR $product->getJsonContent('[sections][about][fields][background]') != null)
                                            <div class="card-post__image bg-light-blue text-center justify-content-center" style="background-image:url({{$product->getJsonContent('[sections][about][fields][background]')}}">
                                                @if($product->getJsonContent('[sections][about][fields][image]') != null)
                                                    <div class="rounded-circle bg-white p-5 mx-auto mt-5" style="position: absolute;
                                                            left: calc(50% - 75px);
                                                            bottom: calc(50% - 55px);border:15px solid #fff;height:150px;width:150px;background-image:url({{$product->getJsonContent('[sections][about][fields][image]')}}) !important; background-size:contain;"></div>
                                                @endif
                                            </div>
                                        @endif
                                        <h6 class="mt-3" @if($product->getJsonContent('[sections][about][fields][image]') != null) style="margin-top:80px !important;" @endif >{{ $product->name }}</h6>
                                        <p class="card-text">{{ $product->getJsonContent('[sections][about][fields][description]') }}</p>
                                        <a href="/products/{{ $product->stripe_id }}" class="btn btn-primary">Read More <i class="fa fa-fw fa-arrow-right ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </main>
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$feature->id'}", "SORT_BY" => 'views', "LIMIT" => 3]) !!}
@endsection