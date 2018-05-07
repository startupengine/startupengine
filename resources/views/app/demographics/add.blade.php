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
                <form action="/app/new/user" method="post">

                <h5>New User @if(\Auth::user()->hasPermissionTo('edit roles')){!! button(null, "Save User", "save", "pull-right", null, null, "button") !!}@endif</h5>


                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postTitle">Name</label>
                                <input required value="" type="text" class="form-control" id="name"
                                       aria-describedby="postTitle" placeholder="Sarah Connor"
                                       name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postSlug">E-Mail</label>
                                <input required value="" type="email" class="form-control" id="email"
                                       aria-describedby="postSlug" placeholder="example@example.com" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postStatus">Status</label><br>
                                <select required class="custom-select" id="status" name="status"
                                        aria-describedby="postStatus" style="width:100%;">
                                    <option value="ACTIVE">Active</option>
                                    <option selected value="INACTIVE">Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection