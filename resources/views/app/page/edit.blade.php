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
                                        <?php $versions = $page->versions(); if ($versions == 0) {
                                            $versions = 1;
                                        }?>
                                        <?php $versioncount = 1; ?>
                                        <?php foreach (range(1, $versions) as $version) {?>

                                        <div class="card" style="margin-top:20px;">
                                            <ul class="nav nav-tabs nav-tabs-primary justify-content-center text-black"
                                                style="background:#fff;border-bottom:1px solid #ddd;"
                                                role="tablist">
                                                <?php $count = 0; ?>
                                                @foreach($page->json()->sections as $key => $value)
                                                    <li class="nav-item">
                                                        <a class="nav-link <?php if ($count == 0) {
                                                            echo "active";
                                                        } ?>" data-toggle="tab" href="#{{$key.$versioncount}}"
                                                           role="tab"
                                                           aria-expanded="false">{{ucfirst($value->title)}}</a>
                                                    </li>
                                                    <?php $count = $count + 1; ?>
                                                @endforeach
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#meta{{$versioncount}}"
                                                       role="tab" aria-expanded="false">Meta</a>
                                                </li>
                                            </ul>


                                            <div class="card-body">
                                                <div class="tab-content text-center">
                                                    <?php $count = 0; ?>
                                                    @foreach($page->json()->sections as $key => $section)
                                                        <div class="tab-pane <?php if ($count == 0) {
                                                            echo "active";
                                                        } ?>" id="{{$key.$versioncount}}" role="tabpanel">
                                                            @foreach($section->fields as $key => $value)
                                                                <div class="form-group" align="left">
                                                                    <label for="{{$key}}"><b>{{ucfirst($key)}}</b>
                                                                        - {{ucfirst($value->description)}}</label>
                                                                    <input type="{{$value->type}}" class="form-control"
                                                                           id="{{$key}}" aria-describedby="{{$key}}"
                                                                           placeholder="{{$value->placeholder}}"
                                                                           name="json[versions][{{ $versioncount }}][{{$section->slug}}][{{$key}}]"
                                                                           rows="2"
                                                                           <?php
                                                                           if ($page->json !== null) {
                                                                               $json = json_decode($page->json);
                                                                               $slug = $section->slug;
                                                                               if ($json->versions->$versioncount->$slug->$key !== null) {
                                                                                   echo 'value="' . $json->versions->$versioncount->$slug->$key . '"';
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
                                                    <div class="tab-pane" id="meta{{$versioncount}}" role="tabpanel" align="left">
                                                        <div class="form-group">
                                                            <label for="postExcerpt"><b>Excerpt</b></label>
                                                            <textarea type="text" class="form-control" id="excerpt"
                                                                      aria-describedby="postExcerpt"
                                                                      placeholder="Describe the page"
                                                                      name="excerpt"
                                                                      rows="2">{{$page->excerpt}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="postExcerpt"><b>Meta Description</b></label>
                                                            <textarea type="text" class="form-control"
                                                                      id="meta_description"
                                                                      name="meta_description"
                                                                      aria-describedby="postMetaDescription"
                                                                      placeholder="Describe the page for search engines."
                                                                      name="excerpt"
                                                                      rows="2">{{$page->meta_description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $versioncount = $versioncount + 1; ?>
                                        <?php } ?>
                                    @endif


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


    </body>
@endsection