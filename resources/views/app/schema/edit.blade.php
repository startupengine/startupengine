@extends('layouts.admin')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-6">
                <h5>Edit Content Type: {{ $postType->title }}</h5>
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
                            <input value="{{$postType->slug}}" type="text" class="form-control"
                                   id="slug"
                                   aria-describedby="settingKey" placeholder="site.main_color"
                                   name="slug"/>
                        </div>
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
                        <div class="form-group">
                            <label for="settingValue">Schema</label>
                            <textarea name="json"></textarea>
                            <div id="json" style="min-height:350px;"></div>
                            <script src="//ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"
                                    type="text/javascript" charset="utf-8">
                            </script>
                            <script>
                                    <?php if ($postType->json !== null) {
                                        $input = $postType->json;
                                    } else {
                                        $input = $postType->json;
                                    } ?>
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
                </div>
            </form>
        </div>
    </main>
@endsection