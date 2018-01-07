@extends('layouts.admin')

@section('title')
    Edit Content Item
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .nav-tabs {
            padding-left: 15px;
            padding-right: 15px;
        }

        .variation:first-of-type .delete-button {
            display: none !important;
        }

        .nav-link.active {
            border-color: #ddd !important;
            color: #444 !important;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5>@if($page->id == null) Add @endif @if($page->id !== null) Edit @endif Page</h5>
                <form action="/app/edit/page" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postTitle">Title</label>
                                <input required value="@if($page->title !== null){{$page->title}}" @endif type="text"
                                       class="form-control"
                                       id="title"
                                       aria-describedby="postTitle" placeholder="Enter a title"
                                       name="title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postSlug">Slug</label>
                                <input required value="{{$page->slug}}" type="text" class="form-control"
                                       id="slug"
                                       aria-describedby="postSlug" placeholder="example-slug" name="slug">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postStatus">Status</label><br>
                                <select required class="custom-select" id="status" name="status"
                                        aria-describedby="postStatus" style="width:100%;">
                                    <option <?php if ($page->status == "ACTIVE") {
                                        echo "selected";
                                    } ?> value="ACTIVE">Active
                                    </option>
                                    <option <?php if ($page->status == "INACTIVE") {
                                        echo "selected";
                                    } ?> value="INACTIVE">Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postStatus">Publish Date</label><br>
                                <?php if ($page->published_at == null) {
                                    $date = \Carbon\Carbon::now()->format("m/d/Y");
                                } else {
                                    $date = $page->published_at->format("m/d/Y");
                                } ?>
                                <input autocomplete="off" type="text" class="form-control date-picker" value="{{$date}}"
                                       name="published_at">
                            </div>
                        </div>
                    </div>
                    <div>
                        @if($page->schema() !== null)
                            <label style="margin-bottom:10px;">Content</label>
                            <?php $versions = $page->versions(); if ($versions == 0) {
                                $versions = 1;
                            }?>
                            <?php $variationcount = 1; ?>
                            <?php foreach (range(1, $versions) as $version) {?>

                            <div class="card variation">

                                <div class="card-header">
                                    Variation {{ $variationcount }}
                                </div>
                                <ul class="nav nav-tabs nav-tabs-primary justify-content-center text-black"
                                    style="background:#fff;border-bottom:1px solid #ddd;"
                                    role="tablist">
                                    <?php $count = 1; ?>
                                    @foreach($page->schema()->sections as $key => $value)
                                        <li class="nav-item">
                                            <a class="nav-link <?php if ($count == 1) {
                                                echo "active";
                                            } ?>" data-toggle="tab" href="#{{$key.$variationcount}}"
                                               data-section="{{$key}}"
                                               role="tab"
                                               aria-expanded="false">{{ucfirst($value->title)}}</a>
                                        </li>
                                        <?php $count = $count + 1; ?>
                                    @endforeach
                                </ul>
                                <div class="card-body">
                                    <div class="tab-content text-center">
                                        <?php $count = 1; ?>
                                        @foreach($page->schema()->sections as $key => $section)
                                            @if(isset($section->title))
                                                <div class="tab-pane <?php if ($count == 1) {
                                                    echo "active";
                                                } ?>"
                                                     id="{{$key.$variationcount}}"
                                                     role="tabpanel"
                                                     data-section="{{$key}}">
                                                    @foreach($section->fields as $field => $value)

                                                        @if($value->type == "text")
                                                            @include('app.page.partials.fields.text')
                                                        @endif
                                                        @if($value->type == "textarea")
                                                            @include('app.page.partials.fields.textarea')
                                                        @endif
                                                        @if($value->type == "richtext")
                                                            @include('app.page.partials.fields.richtext')
                                                        @endif
                                                        @if($value->type == "code")
                                                            @include('app.page.partials.fields.code')
                                                        @endif
                                                        @if($value->type == "select")
                                                            @include('app.page.partials.fields.select')
                                                        @endif

                                                    @endforeach
                                                    <?php $count = $count + 1; ?>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer" align="right">
                                    <a href="#deleteVariation{{$variationcount}}"
                                       onclick="deleteConfirmation($(this));//$('#deleteButton').attr('href', $(this).attr('href'));this.href='#';"
                                       class="btn btn-danger btn-simple btn-round pull-left delete-button"
                                       data-toggle="modal" data-target="#deleteVariation"
                                       style="padding: 10px 12px;">
                                        <i class="now-ui-icons ui-1_simple-remove"></i></a>
                                    <a href="#duplicate"
                                       onclick="duplicateVariation($(this));"
                                       class="btn btn-default btn-simple btn-round duplicate-button">Add
                                        another variation &nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                                </div>
                            </div>
                            <?php $variationcount = $variationcount + 1; ?>
                            <?php } ?>
                        @endif

                        <div>
                            <div class="meta-fields" id="meta2" role="tabpanel" align="left">

                                <label style="margin-bottom:10px;">Code</label>

                                <div class="card variation">

                                    <ul class="nav nav-tabs nav-tabs-primary justify-content-center text-black"
                                        style="background:#fff;border-bottom:1px solid #ddd;"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a href="#cssCode" class="nav-link active" data-section="css"
                                               data-toggle="tab" role="tab" aria-expanded="true">CSS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#layoutCode" class="nav-link" data-section="layout"
                                               data-toggle="tab" role="tab" aria-expanded="true">Layout</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#scriptsCode" class="nav-link " data-section="scripts"
                                               data-toggle="tab" role="tab" aria-expanded="true">Scripts</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#schemaCode" class="nav-link " data-section="schema"
                                               data-toggle="tab" role="tab" aria-expanded="true">Schema</a>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active"
                                                 id="cssCode"
                                                 role="tabpanel"
                                                 data-section="designCode">
                                                <div class="form-group">
                                                    <label for="pageCSS"><strong>CSS</strong></label>
                                                    <textarea type="text" class="form-control"
                                                              id="css"
                                                              name="css"
                                                              aria-describedby="pageCSS"
                                                              placeholder=""
                                                              name="css"
                                                              rows="2">{!! html_entity_decode($page->css) !!}</textarea>
                                                    <script>
                                                        var simplemde = new SimpleMDE({
                                                            element: document.getElementById("css"),
                                                            status: false,
                                                            toolbar: false
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="layoutCode"
                                                 role="tabpanel"
                                                 data-section="layout">
                                                <div class="form-group">
                                                    <label for="pageScripts"><strong>HTML</strong></label>
                                                    <textarea type="text" class="form-control"
                                                              id="html"
                                                              name="html"
                                                              aria-describedby="pageScripts"
                                                              placeholder=""
                                                              name="scripts"
                                                              rows="2">{{$page->html}}</textarea>
                                                    <script>
                                                        var htmlEditor = new SimpleMDE({
                                                            element: document.getElementById("html"),
                                                            status: false,
                                                            toolbar: false
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="tab-pane"
                                                 id="scriptsCode"
                                                 role="tabpanel"
                                                 data-section="scripts">

                                                <div class="form-group">
                                                    <label for="pageScripts"><strong>Scripts</strong></label>
                                                    <textarea type="text" class="form-control"
                                                              id="scripts"
                                                              name="scripts"
                                                              aria-describedby="pageScripts"
                                                              placeholder=""
                                                              name="scripts"
                                                              rows="2">{{$page->scripts}}</textarea>
                                                    <script>
                                                        var scriptsEditor = new SimpleMDE({
                                                            element: document.getElementById("scripts"),
                                                            status: false,
                                                            toolbar: false
                                                        });
                                                    </script>
                                                </div>

                                            </div>

                                            <div class="tab-pane"
                                                 id="schemaCode"
                                                 role="tabpanel"
                                                 data-section="schema">

                                                <div class="form-group">
                                                    <label for="pageScripts"><strong>Schema</strong></label>


                                                    <textarea name="schema"></textarea>
                                                    <div id="schema" style="min-height:350px;"></div>
                                                    <script src="//ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"
                                                            type="text/javascript" charset="utf-8">
                                                    </script>
                                                    <script>

                                                        var editor = ace.edit("schema");
                                                        var textarea = $('textarea[name="schema"]').hide();
                                                        editor.setTheme("ace/theme/github");
                                                        editor.getSession().setMode("ace/mode/json");
                                                        editor.getSession().setValue(textarea.val());
                                                        editor.getSession().on('change', function () {
                                                            textarea.val(editor.getSession().getValue());
                                                        });
                                                        @if($page->schema !== null && $page->schema !== 'null')
                                                            editor.setValue(JSON.stringify({!! $page->schemaToString() !!}, null, '\t'));
                                                        @endif
                                                    </script>


                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label style="margin-bottom:10px;">Meta</label>
                        <div class="card">
                            <ul class="nav nav-tabs nav-tabs-primary justify-content-center text-black"
                                style="background:#fff;border-bottom:1px solid #ddd;"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#seo"
                                       data-section="excerpt"
                                       role="tab"
                                       aria-expanded="false">Search Engine Optimization</a>
                                </li>
                            </ul>
                            <div class="meta-fields card-body" id="meta" role="tabpanel"
                                 align="left" style="margin-bottom:25px;">
                                <div class="tab-content">
                                    <div class="tab-pane active"
                                         id="seo"
                                         role="tabpanel"
                                         data-section="meta">
                                        <div class="form-group">
                                            <label for="postExcerpt"><strong>Excerpt</strong></label>
                                            <textarea type="text" class="form-control" id="excerpt"
                                                      aria-describedby="postExcerpt"
                                                      placeholder="Describe the page"
                                                      name="excerpt"
                                                      rows="2">{{$page->excerpt}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="postMetaDescription"><strong>Meta
                                                    Description</strong></label>
                                            <textarea type="text" class="form-control" id="meta_description"
                                                      aria-describedby="postMetaDescription"
                                                      placeholder="Describe the page"
                                                      name="meta_description"
                                                      rows="2">{{$page->meta_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id" value="{{$page->id}}" ?>
                    <div align="right" style="margin-bottom:35px;">
                        <button type="submit" class="btn btn-secondary-outline ">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </main>
    <script>

        var currentCard;

        function duplicateVariation(object) {
            currentCard = object.parent().closest('.variation');
            currentCard.clone().insertAfter(currentCard);
            updateIndexes();
            console.log('duplicateVariation');
        }

        function selectVariation(object) {
            currentCard = object.parent().closest('.variation');
            currentCard.remove();
            console.log('selectVariation');
        }

        function deleteConfirmation(object) {
            console.log(object);
            $("#deleteVariation").modal("toggle");
            currentCard = object.parent().closest('.variation');
            console.log('deleteConfirmation');
        }

        function deleteVariation(object) {
            currentCard.remove();
            $("#deleteVariation").modal("toggle");
            updateIndexes();
            console.log('deleteVariation');
        }

        function updateIndexes() {
            count = $('.variation').length;
            console.log(count);
            var variation = 0;
            $(".variation").each(function () {
                variation = variation + 1;
                $(this).attr('data-variation', variation);
                $(this).children().closest('.card-header').html('Variation ' + variation);
            });
            updateInputs();
            updateButtons();
            updateTabPanes();
            console.log('updateIndexes');
        }

        function updateInputs() {
            $(".variation :input").each(function () {
                var variation = $(this).parents().closest('.variation').attr('data-variation');
                var section = $(this).attr('data-section');
                var field = $(this).attr('data-field');
                var string = ('json[versions][' + variation + '][' + section + '][' + field + ']');
                $(this).attr('name', string);
            });
        }

        function updateButtons() {
            $(".variation .nav-link").each(function () {
                var variation = $(this).parents().closest('.variation').attr('data-variation');
                var section = $(this).attr('data-section');
                var string = ('#' + variation + section);
                $(this).attr('href', string);
            });
        }

        function updateTabPanes() {
            $(".variation .tab-pane").each(function () {
                var variation = $(this).parents().closest('.variation').attr('data-variation');
                var section = $(this).attr('data-section');
                var string = (variation + section);
                $(this).attr('id', string);
            });
        }

        function enableTabs() {
            $('.variation a.nav-link').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        }

        $(document).ready(function () {
            $( ".nav-link" ).click(function() {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });

            $( ".duplicate-button" ).click(function() {
                //$(this).addClass("active");
                duplicateVariation($(this));
                console.log($(this));
            });

            $( ".delete-button" ).click(function() {
                //$(this).addClass("active");
                deleteVariation($(this));
                console.log($(this));
            });
        });
    </script>
@endsection

@section('modals')
    <!-- Modal Core -->
    <div class="modal fade" id="deleteVariation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Deleting a variation cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="deleteButton" onclick="deleteVariation();" data-toggle="modal" data-target="#deleteVariation">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection