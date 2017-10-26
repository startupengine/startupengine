<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.mxpnl.com/libs/mixpanel-platform/css/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.mxpnl.com/libs/mixpanel-platform/build/mixpanel-platform.v0.latest.min.css">
    <script src="https://cdn.mxpnl.com/libs/mixpanel-platform/build/mixpanel-platform.v0.latest.min.js"></script>
    <style>
        .mixpanel-platform-select.event_selector_theme .select_menu .options_list .select_option:hover {
            background-color: #7777dd;
        }
        .mixpanel-platform-select.event_selector_theme .select_button:hover {
            border: 1px solid #7777dd;
        }
        .select_menu {
            border-radius: 0px 0px 4px 4px !important;
        }
        .mixpanel-platform-input .rounded_dropdown_label:hover, .mixpanel-platform-output .rounded_dropdown_label:hover, .mixpanel-platform-input .icon_textless_label:hover, .mixpanel-platform-output .icon_textless_label:hover {
            border: 1px solid #7777dd;
        }
        .mixpanel-platform-input .rounded_dropdown_item:hover, .mixpanel-platform-output .rounded_dropdown_item:hover {
            background-color: #7777dd;
        }
        .mixpanel-platform-select.event_selector_theme .select_menu .search_box_container .search_box:focus {
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 3px 1px rgba(68,68,221,0.5);
            -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 3px 1px rgba(68,68,221,0.5);
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 3px 1px rgba(68,68,221,0.5);
            border-color: #7777dd;
            outline: 0;
        }
        .mixpanel-platform-select.event_selector_theme .select_menu .search_box_container .search_box {
            border-radius: 4px !important;
        }
        .mixpanel-platform-calendar .body {
            background-color: #fff !important;
            padding: 5px !important;
            -webkit-box-shadow: 0 0 3px #aaa, inset 0 0 0 1px #fff;
            -moz-box-shadow: 0 0 3px #aaa,inset 0 0 0 1px #fff;
            box-shadow: 0 0 3px #aaa, inset 0 0 0 1px #fff;
        }
        .mixpanel-platform-calendar .body .ui-datepicker-header {
            padding: 8px 0;
            position: relative;
            border-bottom: 1px solid #fff;
            background-color: #fff;
            background-image: none !important;
            -webkit-box-shadow: inset 0 1px #f8f8f8;
            -moz-box-shadow: inset 0 1px #f8f8f8;
            box-shadow: inset 0 1px #f8f8f8;
            -webkit-border-radius: 4px 4px 0 0;
            -moz-border-radius: 4px 4px 0 0;
            border-radius: 4px 4px 0 0;
        }
        .mixpanel-platform-calendar .body .triangle div {
            border-bottom-color: #fff !important;
        }
        .mixpanel-platform-calendar .body .ui-datepicker-group {
            border: 1px solid #eee !important;
        }
        .mixpanel-platform-calendar .body table.ui-datepicker-calendar td.ui-datepicker-current-day {
            background-color: #7777dd !important;
            background-image:none !important;
            color:#fff !important;
        }
        .mixpanel-platform-calendar .body table.ui-datepicker-calendar td.ui-datepicker-current-day.ui-datepicker-unselectable span {
            color: #fff !important;
        }
        .mixpanel-platform-calendar .body {
            border-color: #7777dd !important;
            box-shadow:0px 5px 30px rgba(0,0,0,0.1);
        }
        .mixpanel-platform-calendar .body .triangle {
            border-bottom-color: #7777dd;
        }
        .mixpanel-platform-calendar .label.active {
            border-color: #7777dd !important;
        }
        .mixpanel-platform-button_primary, .mixpanel-platform-button_primary:visited {
            background-color: #7777dd;
            background-image: -moz-linear-gradient(top, #7777dd, #5555dd);
            background-image: -ms-linear-gradient(top, #7777dd, #53a0ee);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#7777dd), to(#5555dd));
            background-image: -webkit-linear-gradient(top, #7777dd, #5555dd);
            background-image: -o-linear-gradient(top, #7777dd 0, #5555dd 0);
            background-image: linear-gradient(top, #7777dd 0, #5555dd 0);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7777dd', endColorstr='#5555dd', GradientType=0);
            -webkit-box-shadow: inset 0 1px 1px #7777dd, 0 2px 2px -1px rgba(0,0,0,0.2);
            -moz-box-shadow: inset 0 1px 1px #7777dd,0 2px 2px -1px rgba(0,0,0,0.2);
            box-shadow: inset 0 1px 1px #7777dd, 0 2px 2px -1px rgba(0,0,0,0.2);
            border: 1px solid #5555dd;
        }
        .mixpanel-platform-button_primary:hover, .mixpanel-platform-button_primary:visited:hover, .mixpanel-platform-button_primary.hover, .mixpanel-platform-button_primary:visited.hover {
            background: #5555dd !important;
        }
        .mixpanel-platform-label {
            height:33px !important;

        }
        @media (max-width:500px) {
            .mixpanel-platform-date_picker {
                margin-top: 10px !important;
                margin-bottom: 7px !important;
            }
        }
        .mixpanel-platform-chart_header {
            max-height: 100% !important;
        }
    </style>
</head>
<body class="mixpanel-platform-body" >
<div class="mixpanel-platform-section" style="background:#fff;box-shadow:none;border:1px solid #d3e0e9;">
    <div id="eventSelect" style="float: left;"></div>
    <div id="by" class="mixpanel-platform-label" style="margin-left: 10px; display: none;">by</div>
    <div id="propSelect" style="float: left;"></div>
    <div id="dateSelect" style="float: right;"></div>
    <div style="clear: both;"></div>
    <div id="graph"></div>
</div>
<div id="table"></div>
<script>
    MP.api.setCredentials('<?php echo env('MIXPANEL_API_KEY'); ?>');
    var eventSelect = $('#eventSelect').MPEventSelect();
    var propSelect  = $('#propSelect').MPPropertySelect();
    var dateSelect  = $('#dateSelect').MPDatepicker();
    var eventGraph  = $('#graph').MPChart({chartType: 'line'});

        <?php
        /*
         * For querying the top values per event type
         * More info here: https://mixpanel.com/help/platform#query/topProperties
            var params = {
                limit: 100    // maximum number of results to return
            };

            MP.api.topProperties('Campaign Event', params).done(function(results) {
                console.log('top properties\n', results.values());
            });
        */ ?>

    var runQuery = function() {
            var eventName = eventSelect.MPEventSelect('value'),
                propName  = propSelect.MPPropertySelect('value'),
                dateRange = dateSelect.MPDatepicker('value');
            if (eventName) {
                MP.api.segment(eventName, propName, dateRange).done(function(results) {
                    eventGraph.MPChart('setData', results);
                });
            }
        };
    eventSelect.on('change', function(e, eventName) {
        propSelect.MPPropertySelect('setEvent', eventName);
        $("#by").show();
        runQuery();
    });
    propSelect.on('change', runQuery);
    dateSelect.on('change', runQuery);
</script>
</body>
</html>