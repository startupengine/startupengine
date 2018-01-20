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

        @media(min-width:991px)  {
            .hiddenOnMobile {
                display:block;
            }
            .hiddenOnDesktop{
                display:none;
            }
        }
        @media(max-width:991px)  {
            .hiddenOnMobile {
                display:none;
            }
            .hiddenOnDesktop{
                display:block;
            }
        }
    </style>

    @if($view == "default")
        <script src="//cdn.jsdelivr.net/d3js/3.5.17/d3.min.js" charset="utf-8"></script>
        <script src="//cdn.jsdelivr.net/npm/taucharts@1/build/production/tauCharts.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/taucharts@1/build/production/tauCharts.min.css">
    @endif
@endsection

@section('content')

    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Analytics</h5>
            </div>
            <div class="col-md-12" style="margin-bottom:40px;">
                @if($view == "mixpanel")
                    <div class="fluidMedia">
                        <iframe src="/app/analytics/{{$view}}" frameborder="0" style="min-height:100%;">
                        </iframe>
                    </div>
                @endif
                @if($view == "default")
                    <div class="fluidMedia">
                        <div id="chart" class="" style="height:500px;min-height:calc(100vh - 250px);"></div>
                        <script>
                            var datasource = [
                                <?php
                                $count = 1;
                                foreach($analytics as $eventType => $collection) {
                                    foreach($collection as $date => $eventCount) {
                                        echo "{type:'$eventType', date: '$date', count:'".count($eventCount)."'},";
                                    }
                                } ?>
                                ];
                            var chart = new tauCharts.Chart({
                                data: datasource,
                                type: 'scatterplot',
                                x: 'date',
                                y: 'count',
                                size: 'count',
                                color: 'type',
                                plugins: [
                                    tauCharts.api.plugins.get('tooltip')(),
                                    tauCharts.api.plugins.get('quick-filter')()
                                ]
                            });
                            chart.renderTo('#chart');
                        </script>
                    </div>
                @endif
            </div>
        </div>
    </main>

@endsection