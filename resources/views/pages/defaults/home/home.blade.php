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
    @else 
        <?php $page->thumbnail = null; ?>
    @endif
    background-image:url('{{ $page->thumbnail }}');
@endsection

@section('css')
    <style>
        .shards-landing-page--1 .welcome:before {
            background: #000 !important;
            opacity:0.6;
        }
        .welcome-heading {
            font-weight:600 !important;
        }
        #contentApp {
            display: inline-table !important;
            width: 100% !important;
        }
    </style>
@endsection


@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row">
            <div class="col-md-12 px-4 mb-3">
                <h1 class="welcome-heading display-4 text-white text-center text-shadow">@if($page->title != null) {{ $page->title }} @else {{ setting('site.name', 'Startup Engine') }} @endif</h1>
                <p class="text-white pt-2 text-center text-shadow" style="font-size:130%;">@if($page->getJsonContent('[sections][heading][fields][headline]') != null) {{ $page->getJsonContent('[sections][heading][fields][headline]') }} @else {{ setting('site.description') }} @endif</p>
                <p align="center">
                    <a href="#content" class="mt-1 btn btn-md btn-white btn-pill align-self-center"
                       onclick="$('html, body').animate({scrollTop: $('#content').offset().top @if(isset($message)) -205 @else -155 @endif }, 500);">Read More</a>
                </p>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')

@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$page->id'}", "SORT_BY" => 'views']) !!}
@endsection