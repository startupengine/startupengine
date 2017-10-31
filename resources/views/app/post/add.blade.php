@extends('layouts.app')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media(max-width:991px) {
            .sidebar {
                display:none;
            }
        }
        @media(min-width:991px) {
            .mobile-nav {
                display:none;
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
                            <div class="col-md-12">
                                <h5>New Post</h5>
                            </div>
                            <form action="/app/new/post" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postTitle">Title</label>
                                            <input  value="" type="text" class="form-control" id="title" aria-describedby="postTitle" placeholder="Enter a title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="postSlug">Slug</label>
                                            <input  value="" type="text" class="form-control" id="slug" aria-describedby="postSlug" placeholder="example-slug" name="slug">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postCategory">Category</label><br>

                                            <select class="custom-select" id="category" name="category" aria-describedby="potCategory" style="width:100%;">
                                                <option selected disabled>Choose a category</option>
                                                <?php foreach($categories as $category) { ?>
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="postStatus">Status</label><br>
                                            <select class="custom-select" id="status" name="status" aria-describedby="postStatus" style="width:100%;">
                                                <option value="PUBLISHED">Published</option>
                                                <option selected value="DRAFT">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="postExcerpt">Excerpt</label>
                                        <textarea type="text" class="form-control" id="excerpt" aria-describedby="postExcerpt" placeholder="Describe the post" name="excerpt" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="postBody">Content</label>
                                        <textarea id="body" name="body"></textarea>
                                        <script>
                                            var simplemde = new SimpleMDE({ element: document.getElementById("body") });
                                        </script>
                                    </div>
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