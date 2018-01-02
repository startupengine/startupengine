@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
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
                <h5 style="margin-bottom:25px;">Profile for {{$user->name}}</h5>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" disabled type="text" value="{{ $user->name }}"/>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input class="form-control" disabled type="text" value="{{ ucfirst($user->role()->name) }}"/>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" disabled type="text" value="{{ $user->email }}"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" disabled type="text" value="**********"/>
                </div>
            </div>
            <div align="right" style="margin-bottom:35px;">
                <a href="/app/edit/profile" class="btn btn-secondary-outline">Edit</a>
            </div>
        </div>
    </main>
@endsection