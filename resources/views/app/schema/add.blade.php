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
                <h5>Add Content Type</h5>
            </div>
            <form action="/app/new/schema" method="post">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input  type="text" class="form-control"
                               id="title" aria-describedby="settingDisplayName"
                               placeholder="Examples: Help, Blog Post, Frequently Asked Question" name="title">
                        <div class="form-group">
                            <label for="settingKey">Slug</label>
                            <input type="text" class="form-control"
                                   id="slug"
                                   aria-describedby="settingKey" placeholder="examples: help, post, faq"
                                   name="slug"/>
                        </div>
                        <div class="form-group">
                            <label for="settingValue">Schema</label>
                            <textarea name="json"></textarea>
                            <div id="json" style="min-height:350px;"></div>
                            <script src="//ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"
                                    type="text/javascript" charset="utf-8">
                            </script>
                            <script>
                                var editor = ace.edit("json");
                                var textarea = $('textarea[name="json"]').hide();
                                editor.setTheme("ace/theme/github");
                                editor.getSession().setMode("ace/mode/json");
                                editor.getSession().setValue(textarea.val());
                                editor.getSession().on('change', function () {
                                    textarea.val(editor.getSession().getValue());
                                });
                                editor.setValue(JSON.stringify({
                                    "title": "Example",
                                    "slug": "example",
                                    "version": "0.1",
                                    "description": "Fill in these values with your own data model.",
                                    "sections": {}}, null, '\t'));
                            </script>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div align="right" style="margin-bottom:35px;">
                            <button type="submit" class="btn btn-secondary-outline ">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection