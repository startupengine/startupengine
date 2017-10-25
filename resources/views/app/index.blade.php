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
    <body class="index-page sidebar-collapse bg-gradient-orange">
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
                        <div class="col-md-12 card-deck">
                            <div class="col-md-12" style="margin-bottom:40px;">
                                <h5 align="center" style="margin-bottom:40px;">Recent Activity</h5>
                                <div id="chart">
                                    <line-chart :data="chartData" width="100%" height="400px"></line-chart>
                                </div>

                                <script>
                                    var app = new Vue({
                                        el: "#chart",
                                        data: {
                                            chartData: [
                                                <?php
                                                    $count = 1;
                                                    $string = "name: 'Users', data: {";
                                                    foreach($userlist as $key => $value) {
                                                        $string = $string.'"'.$key.'": '.$value;
                                                        if($count <= count($userlist)) {
                                                            $string = $string.",";
                                                        }
                                                        $count = $count + 1;
                                                    }
                                                $string = "{" . $string . "}}";
                                                echo $string;
                                                ?>,
                                                <?php
                                                $count = 1;
                                                $string = "name: 'Posts', data: {";
                                                foreach($postlist as $key => $value) {
                                                    $string = $string.'"'.$key.'": '.$value;
                                                    if($count <= count($userlist)) {
                                                        $string = $string.",";
                                                    }
                                                    $count = $count + 1;
                                                }
                                                $string = "{" . $string . "}}";
                                                echo $string;
                                                ?>
                                                //{name: 'Workout', data: {'2013-02-10 00:00:00 -0800': 3, '2013-02-17 00:00:00 -0800': 4}},
                                                //{name: 'Call parents', data: {'2013-02-10 00:00:00 -0800': 5, '2013-02-17 00:00:00 -0800': 3}}
                                            ]
                                        }
                                    })
                                </script>
                            </div>
                            <div class="col-md-3 hiddenOnMobile">
                                <div class="card" style="box-shadow:none;">
                                    <h5 align="center" style="margin-bottom:0px;">{{ count($users) }}</h5>
                                    <h4 align="center">Users</h4>
                                </div>
                            </div>
                            <div class="col-md-3 hiddenOnMobile">
                                <div class="card" style="box-shadow:none;">
                                    <h5 align="center" style="margin-bottom:0px;">{{ count($pages) }}</h5>
                                    <h4 align="center">Pages</h4>
                                </div>
                            </div>
                            <div class="col-md-3 hiddenOnMobile">
                                <div class="card" style="box-shadow:none;">
                                    <h5 align="center" style="margin-bottom:0px;">{{ count($posts) }}</h5>
                                    <h4 align="center">Posts</h4>
                                </div>
                            </div>
                            <div class="col-md-3 hiddenOnMobile">
                                <div class="card" style="box-shadow:none;">
                                    <h5 align="center" style="margin-bottom:0px;">{{ count($categories) }}</h5>
                                    <h4 align="center">Categories</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    </body>
@endsection