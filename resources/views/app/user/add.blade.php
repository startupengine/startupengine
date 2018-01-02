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

                <h5>New User</h5>

                <form action="/app/new/user" method="post">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postSlug">E-Mail</label>
                                <input required value="" type="email" class="form-control" id="email"
                                       aria-describedby="postSlug" placeholder="example@example.com" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select required class="custom-select" id="role_id" name="role_id"
                                        aria-describedby="postStatus" style="width:100%;">
                                    <?php $roles = \App\Role::all(); ?>
                                    <?php $user = new \App\User(); ?>
                                    <option disabled selected>Select a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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

                    <div align="right" style="margin-bottom:35px;">
                        <button type="submit" class="btn btn-secondary-outline ">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection