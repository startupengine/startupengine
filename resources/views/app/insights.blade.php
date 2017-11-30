@extends('layouts.app')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media(max-width:991px) {
            .sidebar {
                display:none;
            }
        }
        @media(min-width:991px) {
            .mobile-nav {
                display:none;
            }
        }
        @media(max-width:991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }
        @media(min-width:991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
        }
    </style>
@endsection

@section('content')
    <body class="index-page sidebar-collapse bg-gradient">
    <div class="container-fluid" style="margin-top:15px;">
        <div class="card" style="min-height: calc(100vh - 30px);">
            <div class="card-header" style="padding-left:25px;" align="right">
                <div style="position:absolute;left:25px;top:25px;">Admin Panel</div>
                @include('app.admin-menu')
            </div>
            <div class="row">
                @include('app.admin-sidebar')
                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <div class="main col-md-12" style="background:none;margin-top:25px;">
                        <div class="col-md-12">
                            <div class="col-md-3 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons business_chart-bar-32"></i>&nbsp; Events</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Views</li>
                                    <li class="list-group-item">Engagements</li>
                                    <li class="list-group-item">Conversions</li>
                                </ul>
                            </div>
                            <div class="col-md-3 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons business_badge"></i>&nbsp; Users</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Signups</li>
                                    <li class="list-group-item">Sources</li>
                                    <li class="list-group-item">Countries</li>
                                    <li class="list-group-item">Ages</li>
                                    <li class="list-group-item">Genders</li>
                                </ul>
                            </div>

                            <div class="col-md-3 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons education_paper"></i>&nbsp; Content</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Categories</li>
                                    <li class="list-group-item">Posts</li>
                                    <li class="list-group-item">Concepts</li>
                                    <li class="list-group-item">Keywords</li>
                                    <li class="list-group-item">Sentiment</li>
                                </ul>
                            </div>

                            <div class="col-md-3 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons shopping_credit-card"></i>&nbsp; Revenue</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Products</li>
                                    <li class="list-group-item">Transactions</li>
                                    <li class="list-group-item">MRR</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    </body>
@endsection