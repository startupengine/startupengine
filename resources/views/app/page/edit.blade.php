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
    <body class="index-page sidebar-collapse bg-gradient">
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
                            <h5>Edit Page</h5>
                            <form action="/app/edit/page" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postTitle">Title</label>
                                            <input value="{{$page->title}}" type="text" class="form-control" id="title"
                                                   aria-describedby="postTitle" placeholder="Enter a title"
                                                   name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postSlug">Slug</label>
                                            <input value="{{$page->slug}}" type="text" class="form-control" id="slug"
                                                   aria-describedby="postSlug" placeholder="example-slug" name="slug">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postStatus">Status</label><br>
                                            <select class="custom-select" id="status" name="status"
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
                                </div>
                                <div>
                                    @if($page->json() !== null && $page->json()->sections !== null)
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
                                                @foreach($page->json()->sections as $key => $value)
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
                                                    @foreach($page->json()->sections as $key => $section)
                                                        <div class="tab-pane <?php if ($count == 1) {
                                                            echo "active";
                                                        } ?>"
                                                             id="{{$key.$variationcount}}"
                                                             role="tabpanel"
                                                             data-section="{{$key}}">
                                                            @foreach($section->fields as $key => $value)
                                                                <div class="form-group" align="left">
                                                                    <label for="{{$key}}"><b>{{ucfirst($key)}}</b>
                                                                        - {{ucfirst($value->description)}}</label>
                                                                    <input type="{{$value->type}}" class="form-control"
                                                                           id="{{$key}}" aria-describedby="{{$key}}"
                                                                           placeholder="{{$value->placeholder}}"
                                                                           name="json[versions][{{ $variationcount }}][{{$section->slug}}][{{$key}}]"
                                                                           rows="2"
                                                                           data-field="{{$key}}"
                                                                           data-section="{{$section->slug}}"
                                                                           <?php
                                                                           if ($page->json !== null) {
                                                                               $json = json_decode($page->json);
                                                                               $slug = $section->slug;
                                                                               if (isset($json->versions->$variationcount->$slug->$key)) {
                                                                                   echo 'value="' . $json->versions->$variationcount->$slug->$key . '"';
                                                                               }
                                                                           }
                                                                           ?>
                                                                           }
                                                                    />
                                                                </div>
                                                            @endforeach
                                                            <?php $count = $count + 1; ?>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="card-footer" align="right">
                                                <a href="#deleteVariation{{$variationcount}}"
                                                   onclick="deleteConfirmation($(this));//$('#deleteButton').attr('href', $(this).attr('href'));this.href='#';"
                                                   class="btn btn-danger btn-simple btn-round pull-left delete-button"
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
                                        <div class="meta-fields" id="meta2" role="tabpanel"  align="left">

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
                                                                          rows="2">{{$page->css}}</textarea>
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
                                                            <div class="form-group" style="margin-top:25px !important;">
                                                                <input type="checkbox" name="show_footer"
                                                                       class="bootstrap-switch"
                                                                       data-on-label="YES"
                                                                       data-off-label="NO"
                                                                       <?php if($page->show_footer == true) { ?> checked="" <?php } ?>
                                                                />
                                                                <label for="show_footer">Show footer?</label>
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
                                                                <textarea type="text" class="form-control"
                                                                          id="schema"
                                                                          name="schema"
                                                                          aria-describedby="pageScripts"
                                                                          placeholder=""
                                                                          name="schema"
                                                                          rows="2">{{$page->schema}}</textarea>
                                                                <script>
                                                                    var schemaEditor = new SimpleMDE({
                                                                        element: document.getElementById("schema"),
                                                                        status: false,
                                                                        toolbar: false
                                                                    });
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
                                                        <label for="postMetaDescription"><strong>Meta Description</strong></label>
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
                        </div>
                        </form>
                    </div>
            </div>
            </main>
        </div>
    </div>
    </div>

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
                    <a href="#" class="btn btn-danger" id="deleteButton" onclick="deleteVariation();">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        var currentCard;
        function duplicateVariation(object) {
            currentCard = object.parent().closest('.variation');
            currentCard.clone().insertAfter(currentCard);
            updateIndexes();
        }
        function selectVariation(object) {
            currentCard = object.parent().closest('.variation');
            currentCard.remove();
        }
        function deleteConfirmation(object) {
            $("#deleteVariation").modal("toggle");
            currentCard = object.parent().closest('.variation');
        }

        function deleteVariation(object) {
            currentCard.remove();
            $("#deleteVariation").modal("toggle");
            updateIndexes();
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
    </script>
    </body>
@endsection