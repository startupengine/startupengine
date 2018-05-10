@extends('layouts.admin')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .input-group:first-of-type .btn-remove {
            display:none !important;
        }

        .input-group input {
            max-width:250px;
        }
    </style>
@endsection

@section('content')

    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <form action="/app/new/demographic" method="post">

                    <h5>New Demographic {!! button(null, "Save <span class='hiddenOnMobile'>Demographic</span>", "save", "pull-right", null, null, "button") !!}</h5>

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postTitle">Name</label>
                                <input required value="" type="text" class="form-control" id="name"
                                       aria-describedby="postTitle" placeholder="Choose a name..."
                                       name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea required class="form-control" id="description"
                                          placeholder="What do you know about this demo?" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="subreddits">
                                <label>Reddit Communities</label>
                                <div class="input-group">
                                    <div class="input-group-prepend" style="padding:15px;background:#eee;border-radius:4px 0px 0px 4px;">
                                        <span class="input-group-text" id="basic-addon1"><span style="opacity:0.5;">reddit.com/r/</span></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="subreddit" style="border-radius:0px 4px 4px 0px !important;border-left:#eee 1px solid !important;" name="subreddits[]">
                                    <a href="#" class="btn btn-neutral" onclick="$(this).parents('.input-group').clone().appendTo('#subreddits');"><i style="color:#777;" class="fa fa-plus"></i></a>
                                    <a href="#" class="btn btn-neutral btn-remove" onclick="$(this).parents('.input-group').remove();"><i style="color:red;" class="fa fa-minus"></i></a>
                                </div>


                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection