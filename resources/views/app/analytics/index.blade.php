@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .fluidMedia {
            position: relative;
            padding-bottom: 56.25%; /* proportion value to aspect ratio 16:9 (9 / 16 = 0.5625 or 56.25%) */
            padding-top: 30px;
            height: 100vh;
            overflow: visible;
        }

        .fluidMedia iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')

    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Analytics</h5>
            </div>
            <div class="col-md-12" style="margin-bottom:40px;">
                <div class="fluidMedia">
                    <iframe src="/app/analytics/{{$view}}" frameborder="0" style="min-height:100%;">
                    </iframe>
                </div>
            </div>
        </div>
    </main>

@endsection