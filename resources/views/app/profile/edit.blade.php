@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media (max-width: 991px) {
            .sidebar {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .mobile-nav {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
        }

        .badge-category {
            background: royalblue;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Profile for {{$user->name}}</h5>
            </div>
            <form action="/app/edit/user" method="post">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" @if($disabled == 'disabled') disabled @endif type="text"
                               value="{{ $user->name }}" name="name"/>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="custom-select" id="role_id" name="role_id" @if($disabled == 'disabled') disabled
                                @endif
                                aria-describedby="postStatus" style="width:100%;">
                            <?php $roles = \App\Role::all(); ?>
                            @foreach($roles as $role)
                                <option <?php if ($user->role()->id == $role->id) {
                                    echo "SELECTED";
                                } ?> value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" @if($disabled == 'disabled') disabled @endif type="text"
                               value="{{ $user->email }}" name="email"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" @if($disabled == 'disabled') disabled @endif type="password"
                               value="" name="password"/>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control" @if($disabled == 'disabled') disabled @endif type="password"
                               value="" name="confirm_password"/>
                    </div>
                </div>
                <div align="right" style="margin-bottom:35px;">
                    @if(!$disabled) <input type="hidden" name="user_id" value="{{$user->id}}"/>@endif
                    @if($disabled == 'disabled') <a href="/app/edit/user/{{$user->id}}"
                                                    class="btn btn-secondary-outline">Edit</a> @endif
                    @if(!$disabled)
                        <button type="submit" class="btn btn-secondary-outline ">Save</button> @endif
                </div>
            </form>
        </div>
    </main>
@endsection