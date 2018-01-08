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
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;" class="hiddenOnMobile">Profile for {{$user->name}}  @if(\Auth::user()->hasPermissionTo('edit users')) {!! button("/app/edit/user/$user->id", "Edit", "new", "pull-right" ) !!} @endif</h5>
                <h5 style="margin-bottom:25px;" class="hiddenOnDesktop">User Profile @if(\Auth::user()->hasPermissionTo('edit users')) {!! button("/app/edit/user/$user->id", "Edit", "new", "pull-right" ) !!} @endif</h5>
            </div>
            <div class="col-md-3" style="float:left;">
                <div class="form-group">
                    <label>Image</label><br>
                    @if($user->avatar == 'users/default.png' OR $user->avatar == null)
                        <div style="width:50px; height:50px; background:url('/images/avatar.png');background-size:cover;background-position:center center;" id="avatar"></div></br>
                    @else
                        <div style="width:50px; height:50px; background:url('{{ $user->avatar }}');background-size:cover;background-position:center center;" id="avatar"></div></br>
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
            <div class="col-md-3" style="float:left;">
                <div class="form-group">
                    <label style="width:100%;">Roles</label>
                    @foreach($user->roles()->get() as $role)
                        @if(\Auth::user()->hasPermissionTo('edit roles'))
                        <a href="/app/edit/role/{{$role->id}}" class="btn btn-secondary btn-sm btn-round">{{ $role->display_name }}</a><br>
                        @elseif(\Auth::user()->hasPermissionTo('view roles'))
                            <a href="/app/view/role/{{$role->id}}" class="btn btn-secondary btn-sm">{{ $role->display_name }}</a><br>
                        @elseif(\Auth::user()->hasPermissionTo('read users') && \Auth::user()->hasPermissionTo('read roles'))
                            <div class="btn btn-secondary btn-sm">{{ $role->display_name }}</div><br>
                        @endif
                    @endforeach
                </div>
            </div>
            @if(\Auth::user()->hasPermissionTo('read roles'))
            <div class="col-md-3" style="float:left;">
                <div class="form-group">
                    <label style="width:100%;">Permissions</label>
                    @foreach($user->getAllPermissions() as $permission)
                        <div class="btn btn-simple btn-sm btn-round" style="cursor:unset !important;color:#000;border-color:#ddd;">{{ ucwords($permission->name) }}</div><br>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </main>
@endsection