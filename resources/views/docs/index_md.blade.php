@extends('layouts.shards_docs')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

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

        .hljs-attribute{
            color:mediumseagreen;
            font-weight:bold;
        }

        .table-sm td p {
            margin-bottom:5px;
            text-align: left;
        }

        .table-sm td p code {
            text-align: left;
            padding-left:0px;
        }

        .card-small {
            box-shadow:none !important;
            border:1px solid #ddd !important;
        }

        pre {
            background:#333;
            border-radius:4px;
            color:#fff;
            padding:5px 20px;
        }

        .page-title > h1 {
            font-size:25px !important;
        }

        .shards-landing-page--1 .welcome:before {
            background: linear-gradient(35deg, #6100b9 0%, #9451ff 77%) !important;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') @if(file_exists(docsPath().'/'.$folder.'/description.md')) {!! GrahamCampbell\Markdown\Facades\Markdown::convertToHtml(file_get_contents(docsPath().'/'.$folder.'/description.md')) !!} @endif @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row px-3" id="docsApp" v-if="info != null">
        <div class="col col-md-12">
            <div class="row">
                <div class="card documentation-card" style="width:100%;">
                    <div class="card-body pt-2 px-4 pb-4">
                        {!! $output !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 pb-3 px-0" align="left">
        <?php $nextDoc = prevDoc($folder, $file); ?>
        @if($nextDoc['has_prev'])


                <div class="btn btn-default btn-lg d-lg-inline-flex d-block mb-2">
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


                    <div class="btn btn-default btn-lg d-lg-inline-flex d-block float-lg-right" >
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

        <div class="col-md-12 text-right w-100 pr-0 pb-4 d-none">
            Built with <span class="ml-2">&nbsp;💖&nbsp;<span class="fa fa-fw fa-sm fa-plus dimmed mx-2"></span>&nbsp;⚡</span>
        </div>

    </div>

@endsection

@section('scripts')

@endsection