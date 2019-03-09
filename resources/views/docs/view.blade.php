@extends('layouts.shards_frontend')

@section('title') Documentation @endsection

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

            border-radius:5px !important;
        }

        .btn-lg {
            border-radius:5px !important;
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
            color: #fff !important;
        }

        .shards-landing-page--1 .welcome {
            height: auto !important;
            max-height: auto !important;
            min-height: 500px;
        }

        .shards-landing-page--1 .welcome h1 {
            margin: 80px 0px;
        }

        .documentation-card li {
            line-height: 250% !important;
            font-size: 110% !important;
        }

        ul.nav li:nth-child(odd) {
            border-radius:0px !important;
            background: rgba(200, 220, 240, 0.25) !important;
        }
        ul.nav li:nth-child(even) {
            border-radius:0px !important;
            background: rgba(200, 220, 240, 0.15) !important;
        }

        .documentation-card h1, .documentation-card h2, .documentation-card h3, .documentation-card h4, .documentation-card h5, .documentation-card h6 {
            color: #2568ff;
            font-weight: 500;
        }

        .documentation-card h1 {
            font-size: 150% !important;
            padding: 0px 15px !important;
            border-radius:0px !important;
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
            border-radius: 0px !important;
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
            border: 1px solid rgba(0, 50, 250, 0.15) !important;
        }

        #sidebar li:first-of-type{
            border-radius:5px 5px 0px 0px !important;
        }

        #sidebar li:last-of-type{
            border-radius:0px 0px 5px 5px !important;
        }

        #description h1, #description h2, #description h3, #description h4, #description h5, #description h6 {
            margin: 15px;
            font-weight:300 !important;
        }

        #description {
            text-align: center !important;
        }

        #description a {
            font-weight:600 !important;
        }

        .affix {
            position: fixed;
            top: 72;
            right: 0;
            left: 0;
            z-index: 999999 !important;
        }

        /* fixed to top styles */
        .affix.navbar {
            background-color: #333;
        }

        .affix.navbar .nav-item > a,
        .affix.navbar .navbar-brand {
            color: #fff;
        }

        .shards-landing-page--1 .welcome:before {
            background: linear-gradient(35deg, #6100b9 0%, #9451ff 77%) !important;
        }

        @media(max-width:991px) {
            #docContentCard {
                margin-top: -22px !important;
            }
        }
        @media(min-width:991px){
            #docContentCard {
                margin-top: -71px !important;
            }
            #sideBar{
                background:#fff;
                margin-top: -60px !important;
            }
        }

        #sidebar li.nav-item:hover > a.nav-link:not(.active) {
            background:#fff;
            transition: all 0.4s !important;
        }
        #sidebar li.nav-item:hover > a.active {
            background: #d1e8ff !important;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') @if(file_exists(docsPath().'/'.$folder.'/description.md')) {!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml(file_get_contents(docsPath().'/'.$folder.'/description.md')) !!} @endif @endsection

@section('top-menu')
@endsection

@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row">
            <div class="col-md-12 px-4 text-white py-5" id="description" >
                @if(file_exists(docsPath().'/'.$folder.'/description.md')) {!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml(file_get_contents(docsPath().'/'.$folder.'/description.md')) !!} @endif
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')
    <main id="content">

        @if(count(docsFolders()) > 1)
            <nav class="navbar navbar-expand-sm navbar-light d-block d-lg-none" data-toggle="affix" align="center"
                 style="background: #dae4f9;border: 1px solid rgba(0,0,0,0.05);">
                <div class="container" align="center">
                    <div class="btn-group btn-group-sm mx-auto">
                        <div class="btn btn-black disabled">Menu</div>
                        <a class="btn btn-white border-whitec pl-4 truncate" href="#" aria-haspopup="true" aria-expanded="false"
                           data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content=
                           '@foreach(docsFolders() as $docFolder)
                                   <a class="dropdown-item py-1 px-3 m-0 @if($folder == $docFolder) text-primary @endif" href="/docs/{{ $docFolder }}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a>
                                                @endforeach'
                           data-html="true">
                            <span class="mr-1">{{ str_replace('_', ' ', ucwords($folder)) }}</span><span
                                    class="ml-1 fa fa-fw fa-caret-down d-inline-block"></span></a>

                        @if(count(docsFolders($folder)) > 0)
                            <a class="btn btn-white pl-4 truncate" href="#" aria-haspopup="true"
                               aria-expanded="false" tyle="border-left:none;"
                               data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content=
                               '@foreach(docsFolders($folder) as $docFolder)
                                       <a class="dropdown-item py-1 px-3 m-0 @if($folder == $docFolder) text-primary @endif" href="/docs/{{ $folder }}/{{$docFolder}}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a>
                                                @endforeach'
                               data-html="true">
                                <span class="mr-1">@if(isset($subfolder)) {{ ucwords($subfolder) }}  @elseif(count(docsFolders($folder)) > 0) {{ ucwords(docsFolders($folder)[0]) }} @endif</span><span
                                        class="ml-1 fa fa-fw fa-caret-down d-inline-block"></span></a>
                        @endif
                    </div>
                </div>
            </nav>
        @endif

        <div class="blog section section-invert p-4  firstSection" style="background:#fff !important;">
            <div class="container">
                <div class="row px-3" id="docsApp">
                    <div class="col-md-4 d-none d-lg-block">
                        <div class="row">
                            <div  class="card documentation-card w-100 mr-3 h-auto flat" style="z-index:999;min-height:auto !important;">

                                <div class="nav-wrapper d-none d-sm-none d-lg-inline-flex">
                                    <ul class="nav flex-column w-100 " id="sidebar">
                                        <li class="hiddenOnMobile nav-item w-100 text-center py-3 px-1 border-bottom" style="border-color:rgba(0,0,200,0.1) !important;">
                                            <div class="btn-group btn-group-sm mx-auto">
                                                <div class="btn btn-black disabled">Menu</div>
                                                <a class="btn btn-white border-whitec pl-4 truncate" href="#" aria-haspopup="true" aria-expanded="false"
                                                   data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content=
                                                   '@foreach(docsFolders() as $docFolder)
                                                           <a class="dropdown-item py-1 px-3 m-0 @if($folder == $docFolder) text-primary @endif" href="/docs/{{ $docFolder }}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a>
                                                @endforeach'
                                                   data-html="true">
                                                    <span class="mr-1">{{ str_replace('_', ' ', ucwords($folder)) }}</span><span
                                                            class="ml-1 fa fa-fw fa-caret-down d-inline-block"></span></a>

                                                @if(count(docsFolders($folder)) > 0)
                                                    <a class="btn btn-white pl-4 truncate" href="#" aria-haspopup="true"
                                                       aria-expanded="false" tyle="border-left:none;"
                                                       data-toggle="popover" data-trigger="focus" data-placement="bottom" data-content=
                                                       '@foreach(docsFolders($folder) as $docFolder)
                                                               <a class="dropdown-item py-1 px-3 m-0 @if($folder == $docFolder) text-primary @endif" href="/docs/{{ $folder }}/{{$docFolder}}">{{ str_replace('_', ' ', ucwords($docFolder)) }}</a>
                                                @endforeach'
                                                       data-html="true">
                                                        <span class="mr-1">@if(isset($subfolder)) {{ ucwords($subfolder) }}  @elseif(count(docsFolders($folder)) > 0) {{ ucwords(docsFolders($folder)[0]) }} @endif</span><span
                                                                class="ml-1 fa fa-fw fa-caret-down d-inline-block"></span></a>
                                                @endif
                                            </div>
                                        </li>
                                        @foreach(docFiles($folder) as $markdownFile)
                                            @if($markdownFile != 'description.md')
                                                <li class="nav-item">
                                                    <a class="nav-link @if($file == $markdownFile) active @endif"
                                                       href="/docs/{{ $folder }}/<?php if (
                                                           isset($subfolder) &&
                                                           $subfolder != null
                                                       ) {
                                                           echo $subfolder . "/";
                                                       } ?>{{ $markdownFile }}">
                                                        <span>@if($file == $markdownFile) <i class="fa fa-fw fa-sm fa-caret-right mr-1 dimmed text-success"></i> @endif {{ docsTitle($folder, $markdownFile) }} @if($file == $markdownFile) <span class="badge  badge-pill badge-primary bg-light-blue text-dark-blue float-right m-2">Currently Viewing</span> @endif</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                    <div class="col-md-12 py-2 d-sm-none d-block text-center" align="left">
                                        <a class="btn btn-neutral btn-pill mr-2 pl-1" href="{{ URL::to('/') }}">
                                            <span class="fa fa-fw fa-arrow-left mr-1 ml-0"></span>Back To Home
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-8 mb-3">
                        <div class="row">
                            <div id="docContentCard" class="card documentation-card  flat  raised-lg-1 " style="width:100%;">
                                <div class="card-body pt-2 px-4 pb-4">
                                    {!! $output !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2 px-0 d-none d-lg-block" align="left">
                                <?php $nextDoc = prevDoc($folder, $file); ?>
                                @if($nextDoc['has_prev'])


                                    <div class="btn btn-white btn-lg mb-2">
                                        Previous: &nbsp;
                                        <a href="/docs/{{ $folder }}/<?php if (
                                            isset($subfolder) &&
                                            $subfolder != null
                                        ) {
                                            echo $subfolder . "/";
                                        } ?>{!! $nextDoc['prev_file'] !!}">{!! $nextDoc['prev_preview'] !!}</a>
                                    </div>


                                @endif
                                <?php $nextDoc = nextDoc($folder, $file); ?>
                                @if($nextDoc['has_next'])


                                    <div class="btn btn-white btn-lg  float-lg-right">
                                        Next: &nbsp;
                                        <a href="/docs/{{ $folder }}/<?php if (
                                            isset($subfolder) &&
                                            $subfolder != null
                                        ) {
                                            echo $subfolder . "/";
                                        } ?>{!! $nextDoc['next_file'] !!}">{!! $nextDoc['next_preview'] !!}</a>
                                    </div>


                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-block d-lg-none mt-0 mt-sm-5 mt-xs-5 ">
                        <div class="row">
                            <div class="card documentation-card w-100 flat h-auto" style="min-height:auto !important;">

                                <div class="nav-wrapper">
                                    <ul class="nav flex-column border   w-100" id="sidebar">
                                        @foreach(docFiles($folder) as $markdownFile)
                                            @if($markdownFile != 'description.md')
                                                <li class="nav-item">
                                                    <a class="nav-link @if($file == $markdownFile) active @endif"
                                                       href="/docs/{{ $folder }}/<?php if (
                                                           isset($subfolder) &&
                                                           $subfolder != null
                                                       ) {
                                                           echo $subfolder . "/";
                                                       } ?>{{ $markdownFile }}">
                                                        <span>@if($file == $markdownFile) <i class="fa fa-fw fa-sm fa-caret-right mr-1 dimmed text-success"></i> @endif {{ docsTitle($folder, $markdownFile) }} @if($file == $markdownFile) <span class="badge  badge-pill badge-primary bg-light-blue text-dark-blue float-right m-2">Currently Viewing</span> @endif</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 text-right w-100 pr-0 pb-4 d-none">
                        Built with <span class="ml-2">&nbsp;💖&nbsp;<span
                                    class="fa fa-fw fa-sm fa-plus dimmed mx-2"></span>&nbsp;⚡</span>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            var toggleAffix = function (affixElement, scrollElement, wrapper) {

                var height = affixElement.outerHeight(),
                    top = wrapper.offset().top;

                if (scrollElement.scrollTop() >= top -70) {
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
@endsection