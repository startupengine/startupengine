@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        label {
            opacity:0.5;
        }
        #avatar {
            max-height:50px;
            border-radius:25px;
            margin-bottom:15px;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main " style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;" class="hiddenOnMobile">Profile for {{$user->name}}  @if(\Auth::user()->hasPermissionTo('edit users'))<a href="/app/edit/user/{{$user->id}}" class="btn btn-sm btn-secondary-outline pull-right">Edit</a>@endif</h5>
                <h5 style="margin-bottom:25px;" class="hiddenOnDesktop">User Profile @if(\Auth::user()->hasPermissionTo('edit users'))<a href="/app/edit/user/{{$user->id}}" class="btn btn-sm btn-secondary-outline pull-right">Edit</a>@endif</h5>
            </div>
            <div class="col-md-4" style="float:left;">
                <div class="form-group">
                    <label>Image</label><br>
                    @if($user->avatar == 'users/default.png' OR $user->avatar == null)
                        <img src="/images/avatar.png" id="avatar"/>
                    @else
                        <img src="{{$user->avatar}}" id="avatar"/>
                    @endif
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p>{{ $user->status }}</p>
                </div>
                <div class="form-group">
                    <label>Created</label>
                    <p>{{ $user->created_at->format('M d Y') }}</p>
                </div>
                @if($user->deleted_at !== null)
                    <div class="form-group">
                        <label>Deleted</label>
                        <p>{{ $user->deleted_at->format('M d Y') }}</p>
                    </div>
                @endif
            </div>
            <div class="col-md-4" style="float:left;">
                <div class="form-group">
                    <label style="width:100%;">Roles</label>
                    @foreach($user->roles()->get() as $role)
                        <p><a href="#" class="btn btn-secondary btn-sm">{{ $role->display_name }}</a></p>
                    @endforeach
                </div>
            </div>
            @if(\Auth::user()->hasPermissionTo('read roles'))
            <div class="col-md-4" style="float:left;">
                <div class="form-group">
                    <label style="width:100%;">Permissions</label>
                    @foreach($user->getAllPermissions() as $permission)
                        <div class="btn btn-simple btn-sm" style="display:block;cursor:unset !important;color:#000;border-color:#ddd;">{{ ucwords($permission->name) }}</div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </main>
@endsection