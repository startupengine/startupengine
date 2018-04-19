@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .card-deck .card {
            text-align:center;
            margin-bottom:25px;
        }
        .card-body {
            min-height:175px !important;
        }
        .card-body h3 {
            margin-bottom:10px;
        }
        .badge {
            background:rgba(151,255,169,0.5);color:green;
            border:none;
            font-size:100%;
            padding-right:13px;
            padding-left:13px;
            padding-top:6px;
            padding-bottom:6px;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12" style="padding-top:15px;">
                <div class="card-deck">
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-desktop" style="font-size:80%;color:#666;"></i><br>Pages</h3>
                            <span class="badge">{{ count(\App\Page::all()) }}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-pencil-square-o" style="font-size:80%;color:#666;"></i><br>Posts</h3>
                            <span class="badge">{{ count(\App\Post::all()) }}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-hashtag" style="font-size:80%;color:#666;"></i><br>Topics</h3>
                            <span class="badge">{{ count(\App\Tag::all()) }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-deck">
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-shopping-cart" style="font-size:80%;color:#666;"></i><br>Products</h3>
                            <span class="badge">{{ count(\App\AnalyticEvent::all()) }}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-money" style="font-size:80%;color:#666;"></i><br>Plans</h3>
                            <span class="badge">{{ count(\App\Plan::all()) }}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-credit-card" style="font-size:80%;color:#666;"></i><br>Purchases</h3>
                            <span class="badge">{{ count(\App\Subscription::all()) }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-deck">
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-bar-chart" style="font-size:80%;color:#666;"></i><br>Events</h3>
                            <span class="badge">{{ count(\App\AnalyticEvent::all()) }}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-user" style="font-size:80%;color:#666;"></i><br>Users</h3>
                            <span class="badge">{{ count(\App\User::all()) }}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3><i class="fa fa-cogs" style="font-size:80%;color:#666;"></i><br>Settings</h3>
                            <span class="badge">{{ count(\App\Setting::all()) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
