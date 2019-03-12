@extends('layouts.shards_frontend')

@section('title') Pricing @endsection

@section('css')
    <style>
        td {
            line-height: 28px;
            vertical-align: middle;
        }

        nav li.page-item {
            box-shadow: none !important;
            border: 1px solid #ddd;
            border-right: 0px;
        }

        nav li.page-item:last-of-type {
            border-right: 1px solid #ddd;
        }

        nav li.page-item.active a {
            background: #555 !important;
        }

        nav li.page-item.active {
            border-color: #555;
        }

        nav li.page-item:hover a {
            color: #000 !important;
        }

        nav li.page-item.active:hover a {
            color: #fff !important;
        }

        .page-item a {
            color: #888;
        }

        table .badge-pill {
            min-width: 80px;
        }

        .actionButton {
            width: 120px !important;
        }

        .postTypeSelector {
            background: rgba(126, 186, 255, 0.1);
            border-left: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            padding: 15px 0px;
            transition: all 0.5s;
        }

        .postTypeSelector:hover {
            background: rgba(95, 114, 255, 0.1);
            border-left: 2px solid #333;
            cursor: pointer;
        }

        .postTypeSelector:last-of-type {
            margin-bottom: 0px !important;
        }

        .modal-header .close {
            padding: 1.25rem 5px;
            margin: -1rem -1rem -1rem auto;
        }

        .modal-footer {
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 25px;
            padding-left: 25px;
        }

        .card .postTag {
            display: none;
        }

        .card .postTag:first-of-type {
            display: inline-flex;
        }

        .modal .input-group-text {
            min-width: 130px;
        }

        #docsApp .card ul {
            line-height: 15%;
        }

        #docsApp .card {
            margin-bottom: 20px;
        }

        .hljs-attribute {
            color: mediumseagreen;
            font-weight: bold;
        }

        .table-sm td p {
            margin-bottom: 5px;
            text-align: left;
        }

        .table-sm td p code {
            text-align: left;
            padding-left: 0px;
        }

        .card-small {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .documentation-card {
            max-height: none !important;
            box-shadow: none !important;
        }

        pre {
            background: #333;
            border-radius: 4px;
            color: #fff;
            padding: 5px 20px;
        }

        .page-title > h1 {
            font-size: 25px !important;
        }

        .text-white p, .text-white h1, .text-white h2, .text-white h3, .text-white h4, .text-white h5, .text-white h6 {
            color: #333 !important;
        }

        .shards-landing-page--1 .welcome {
            height: auto !important;
            max-height: auto !important;
            min-height: 500px;
            background: none;
            /*background-image:url('https://images.unsplash.com/photo-1508796079212-a4b83cbf734d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80');*/
        }

        .shards-landing-page--1 .welcome h1 {
            margin: 80px 0px;
        }

        .documentation-card li {
            line-height: 250% !important;
            font-size: 110% !important;
        }

        .documentation-card h1, .documentation-card h2, .documentation-card h3, .documentation-card h4, .documentation-card h5, .documentation-card h6 {
            color: #2568ff;
            font-weight: 500;
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
            padding: 0px !important;
            margin-top: 10px;
            margin-bottom: 25px;
            padding-bottom: 15px !important;
            border-bottom: 1px solid #eee;
            border-radius: 6px !important;
        }

        .nav .nav-link.active {
            background: #dae4f97d !important;
        }

        .nav {
            border-radius: 5px !important;
        }

        .documentation-card .nav-link {
            border-radius: 0px !important;
        }

        .documentation-card .nav-item:first-of-type .nav-link {
            border-radius: 5px 5px 0px 0px !important;
        }

        .documentation-card.border, #sidebar {
            border: 1px solid rgba(0, 100, 150, 0.2) !important;
        }

        #description h1, #description h2, #description h3, #description h4, #description h5, #description h6 {
            margin: 15px;
            font-weight: 300;
        }

        #description {
            text-align: center !important;
        }

        .affix {
            position: fixed;
            top: 72;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        /* fixed to top styles */
        .affix.navbar {
            background-color: #333;
        }

        .affix.navbar .nav-item > a,
        .affix.navbar .navbar-brand {
            color: #fff;
        }


    </style>
    <style>
        #contentApp {
            display: contents !important;
            width: 100% !important;
        }
        .card-subtitle, .card-title {
            color: #333 !important;
        }
        .text-dull-blue h5, .text-dull-blue h6  {
            color:#557698 !important;
            text-align:center;
        }

        .card-subtitle {
            opacity:0.7;
        }
        .shards-landing-page--1 .welcome:before {
            background: #e9f0ff!important;
        }

    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Content @endsection

@section('navbar-classes')
    navbar-light navbar-blend-light-blue
@endsection

@section('header')
    <?php $softwareProducts = \App\Product::where('status', 'ACTIVE')->whereJsonContains('json->sections->about->fields->type', 'Software Subscription')->get(); ?>
    <?php $contentProducts = \App\Product::where('status', 'ACTIVE')->whereJsonContains('json->sections->about->fields->type', 'Content Subscription')->get(); ?>
    <?php $results = []; if(count($contentProducts) > 0 ){ $results[] = 'Content Subscription'; } if(count($softwareProducts) > 0 ){ $results[] = 'Software Subscription'; } ?>
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container" id="">
        <div class="row">
            <div class="col-md-12 px-4 text-white text-center py-5" id="description">
                <h2 class="page-title @if(count($results) > 1) mb-4 @endif text-dark">Pricing</h2>
                @if(count($results) > 1)
                    <div class="btn-group btn-group-sm mx-auto mt-3">
                        <div class="btn btn-black disabled">Showing</div>
                        <a class="btn btn-white border-white text-dark pl-4 truncate" href="#" aria-haspopup="true"
                           aria-expanded="false" tyle="border-left:none;"
                           data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content=
                           '<div align="center">@foreach($results as $type)
                                   <div class="dropdown-item py-1 px-3 m-0" onclick="changeContentType({&apos;label&apos;:&apos;{{ ucwords($type) }}&apos;,&apos;post_type&apos;:&apos;post_type={{ $type }}&apos;})">{{ ucwords($type) }}</div>
                                @endforeach</div>'
                           data-html="true">
                            <span class="mr-1" id="selectedContentType">Software Subscriptions</span><span
                                    class="ml-1 fa fa-fw fa-caret-down d-inline-block"></span></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection


@section('content')

    <?php $softwares = \App\Product::where('status', 'ACTIVE')->whereJsonContains('json->sections->about->fields->type', 'Software Subscription')->get(); ?>
    <main id="content"  style="min-height:calc(100% - 300px);">
        @foreach($softwares as $product)
            <?php $plans = $product->stripePlans()->data; ?>
            @if(count($plans) <= 1)
                <div class="blog section section-invert p-4"  style="min-height:calc(100% - 300px);">
                    <div class="container">
                        <div class="row px-0 pt-3 pb-5" >
                            <div class="row justify-content-center text-center" id="contentApp">
                                <div class="col-md-5 mx-auto">
                                    <div class="card  h-auto" style="@if(count($softwares) == 1)margin-top:-72px; @else margin-top:30px; @endif min-height:auto !important;">
                                        <div class="card-header text-dark-green bg-light-green">{{ $product->name }}</div>
                                        <div class="card-body h-auto text-center">
                                            <p class="card-text">@if($product->getJsonContent('[sections][about][fields][description]') != null){{ $product->getJsonContent('[sections][about][fields][description]') }} @endif</p>
                                            <h5 class="card-title mb-4"><small style="font-weight:400;  ">$</small>{{ $product->price/100 }}</h5>
                                            <h6 class="card-subtitle mb-4 text-muted">per month</h6>
                                            <div class="p-3">{{ $product->description }}</div>
                                        </div>
                                        <div class="card-footer text-center pt-0 pb-5">
                                            <a href="/subscribe" class="btn btn-default btn-cta btn-pill raised mt-0 ">Get Started</a>
                                            <a href="/products/{{ $product->stripe_id }}" class="btn btn-outline-primary btn-pill raised mt-0 ml-2">More Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(count($plans) > 1)
                    <div class="blog section section-invert p-4 pt-5 border-none" style="min-height:calc(100% - 300px);">
                        <div class="container">
                            @if(count($softwares) > 1)
                                <div class="row mb-4 pt-4 pb-0">
                                    <div class="col-md-12 text-dull-blue mb-0">
                                        <div class=" h-auto pt-3 px-4 pb-3 " style="min-height:auto !important;border-radius:5px !important;xwxw">
                                            <h5>{{ $product->name }}</h5>
                                            @if($product->getJsonContent('[sections][about][fields][description]') != null) <h6 class="dimmed">{{ $product->getJsonContent('[sections][about][fields][description]') }}</h6> @endif
                                            @if($product->description != null) <div class="p-3">{{ $product->description }} </div>@endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row" @if(count($softwares) == 1)  style="margin-top:-110px;" @endif>
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
                                                    <a href="/subscribe/{{ $product->stripe_id }}/{{ $plan->id }}" class="btn btn-default btn-cta btn-pill raised mt-0 ">Get Started</a>
                                                    <a href="/products/{{ $product->stripe_id }}" class="btn btn-outline-primary btn-pill raised mt-0 ml-2">More Info</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
            @endif
        @endforeach
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            var toggleAffix = function (affixElement, scrollElement, wrapper) {

                var height = affixElement.outerHeight(),
                    top = wrapper.offset().top;

                if (scrollElement.scrollTop() >= top) {
                    wrapper.height(height);
                    affixElement.addClass("affix");
                }
                else {
                    affixElement.removeClass("affix");
                    wrapper.height('auto');
                }

            };


            $('[data-toggle="affix"]').each(function () {
                var ele = $(this),
                    wrapper = $('<div></div>');

                ele.before(wrapper);
                $(window).on('scroll resize', function () {
                    toggleAffix(ele, $(this), wrapper);
                });

                // init
                toggleAffix(ele, $(window), wrapper);
            });

        });
    </script>
    <script>
        $("#search").change(function () {
            var search = $("#search").val();
            contentApp.updateSearch(search);
        });

        function changeContentType(input) {
            var newobj = {'post_type': input.post_type};
            contentApp.updateFilters(newobj);
            $("#selectedContentType").text(input.label);
        }

        function resetContentType() {
            contentApp.reset({'filters': true, 'search': true});
            $("#selectedContentType").text("All Content");
        }
    </script>
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME'=> 'contentApp', 'div_id'=> 'contentApp','url' => '/api/resources/product', 'DISPLAY_FORMAT' => 'cards']) !!}
@endsection