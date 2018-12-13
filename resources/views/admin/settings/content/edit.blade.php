@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        .card {
            margin-bottom: 15px;
        }

        a p.card-text {
            color: #000 !important;
        }

        a .card-title {
            color: #444 !important;
        }

    </style>

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

        label {
            margin-top: 10px;
            font-weight: bold;
            opacity: 0.5;
            color: #000;
            text-align: left;
            float: left;
            display: block;
        }

        div#json {
            border: 1px solid #e1e5eb !important;
            border-radius: 4px !important;
            transition: all 0.25s !important;
        }

        div#json.ace_focus {
            border-color: #007bff !important;
            box-shadow: 0 0.313rem 0.719rem rgba(0, 123, 255, .1), 0 0.156rem 0.125rem rgba(0, 0, 0, .06) !important;
            transition: all 0.25s !important;
        }

        .col-md-4 {
            float: left;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script src="//ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"
            type="text/javascript" charset="utf-8">
    </script>
@endsection

@section('page-title') Edit Content Model @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4" id="editPostType">
                <div class="card-header border-bottom" align="left"><h6 class="mb-0">{{ $postType->title }}</h6></div>
                <div class="card-body p-0 pb-0 text-center">
                    <form action="/app/edit/schema/{{ $postType->slug }}" method="post">
                        {{ csrf_field() }}
                        <div class="row px-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Title">Name</label>
                                    <input value="{{$postType->title}}" type="text" class="form-control"
                                           id="title" aria-describedby="settingDisplayName"
                                           placeholder="What should this setting be called?" name="title">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="settingKey">Slug</label>
                                    <input value="{{$postType->slug}}" type="text" class="form-control"
                                           id="slug"
                                           aria-describedby="settingKey" placeholder="site.main_color"
                                           name="slug"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postStatus">Status</label><br>
                                    <select class="custom-select" id="enabled" name="enabled"
                                            aria-describedby="postStatus" style="width:100%;">
                                        <option <?php if ($postType->enabled == false) {
                                            echo "SELECTED";
                                        } ?> value="FALSE">Disabled
                                        </option>
                                        <option <?php if ($postType->enabled == true) {
                                            echo "SELECTED";
                                        } ?> value="TRUE">Enabled
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="col-md-12 mt-0 pt-0">
                                <div class="form-group">
                                    <label for="settingValue">Schema</label>
                                    <?php if ($postType->json !== null) {
                                        $input = $postType->json;
                                    } else {
                                        $input = $postType->json;
                                    } ?>
                                    <textarea id="jsonTextArea" style="display:none;" name="json">Test</textarea>
                                    <div id="json" style="width:100%;min-height:350px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2 pb-2">
                            <input type="hidden" name="id" id="id" value="" ?>
                            <div align="right">
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        var editor = ace.edit("json");
        editor.setValue(JSON.stringify(JSON.parse(<?php echo json_encode($input, JSON_PRETTY_PRINT); ?>), null, '\t'));
        var textarea = $('textarea[name="json"]').hide();

        editor.getSession().setMode("ace/mode/json");
        editor.getSession().on('change', function () {
            textarea.val(editor.getSession().getValue());
        });

        textarea.val(editor.getSession().getValue());
    </script>
@endsection

@section('scripts')
@endsection