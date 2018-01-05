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
            <div class="col-md-12">

                <h5>New Permission</h5>

                <form action="/app/new/permission" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postTitle">Name</label>
                                <input required value="" type="text" class="form-control" id="name"
                                       aria-describedby="postTitle" placeholder="browse posts"
                                       name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postSlug">Guard Name</label>
                                <input required value="" type="text" class="form-control" id="guard_name"
                                       placeholder="web, api, etc" name="guard_name">
                            </div>
                        </div>
                    </div>

                    <div align="right" style="margin-bottom:35px;">
                        <button type="submit" class="btn btn-secondary-outline ">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection