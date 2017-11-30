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

                            <h5>New {{ $postType->title }}</h5>

                            <form action="/app/new/post" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postTitle">Title</label>
                                            <input value="" type="text" class="form-control" id="title"
                                                   aria-describedby="postTitle" placeholder="Enter a title"
                                                   name="title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postSlug">Slug</label>
                                            <input value="" type="text" class="form-control" id="slug"
                                                   aria-describedby="postSlug" placeholder="example-slug" name="slug">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postStatus">Status</label><br>
                                            <select class="custom-select" id="status" name="status"
                                                    aria-describedby="postStatus" style="width:100%;">
                                                <option value="PUBLISHED">Published</option>
                                                <option selected value="DRAFT">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @include('app.partials.fields')
                                <div align="right" style="margin-bottom:35px;">
                                    <input type="hidden" name="post_type" value="{{$postType->slug}}" />
                                    <button type="submit" class="btn btn-secondary-outline ">Save</button>
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