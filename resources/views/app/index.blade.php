@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
        }

        @media (min-width: 991px) {
            .mobile-nav {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
        }

        .col-md-3 .card {
            box-shadow: none;
        }
    </style>
@endsection

@section('content')

    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12 card-deck">
                <div class="col-md-12" style="margin-bottom:40px;">
                    <div id="chart">
                        <column-chart :data="chartData" width="100%" height="75vh"
                                      :colors="['#eee', '#eee']"></column-chart>
                    </div>
                    <script>
                        var app = new Vue({
                            el: "#chart",
                            data: {
                                chartData: [
                                    ['Users', {{count($users)}}],
                                    ['Pages', {{count($pages)}}],
                                    <?php
                                    $postTypes = \App\PostType::all();
                                    foreach ($postTypes as $postType) {
                                        $count = \App\Post::where('post_type', '=', $postType->slug)->get();
                                        $count = count($count);
                                        echo "['$postType->title Items', $count ],";
                                    } ?>
                                ]
                            }
                        })
                    </script>
                </div>
            </div>
        </div>
    </main>

@endsection