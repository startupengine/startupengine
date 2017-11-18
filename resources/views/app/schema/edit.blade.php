@extends('layouts.app')

@section('title')
    New Post
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
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="card" style="box-shadow:none;">
                                    <h5>Edit Content Type: {{ $postType->title }}</h5>
                                </div>
                            </div>
                            <form action="/app/edit/schema/{{ $postType->slug }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input value="{{$postType->title}}" type="text" class="form-control"
                                               id="title" aria-describedby="settingDisplayName"
                                               placeholder="What should this setting be called?" name="title">
                                        <div class="form-group">
                                            <label for="settingKey">Slug</label>
                                            <input value="{{$postType->slug}}" type="text" class="form-control" id="slug"
                                                   aria-describedby="settingKey" placeholder="site.main_color"
                                                   name="slug">
                                        </div>
                                        <div class="form-group">
                                            <label for="settingValue">Schema</label>


                                            <textarea name="json"></textarea>
                                            <div id="json" style="min-height:350px;"></div>

                                            <script src="//ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"
                                                    type="text/javascript" charset="utf-8"></script>

                                            <script>
                                                <?php if($postType->custom_json !== null) { $input = $postType->custom_json; } else { $input = $postType->json; } ?>

                                                var editor = ace.edit("json");
                                                var textarea = $('textarea[name="json"]').hide();

                                                editor.setTheme("ace/theme/github");
                                                editor.getSession().setMode("ace/mode/json");

                                                editor.getSession().setValue(textarea.val());
                                                editor.getSession().on('change', function () {
                                                    textarea.val(editor.getSession().getValue());
                                                });

                                                editor.setValue(JSON.stringify({!! $input !!}, null, '\t'));

                                            </script>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" id="id" value="" ?>
                                        <div align="right" style="margin-bottom:35px;">
                                            <button type="submit" class="btn btn-secondary-outline ">Save</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    </body>
@endsection