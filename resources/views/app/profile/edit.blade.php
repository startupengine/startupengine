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
            <form action="/app/edit/user" method="post">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;" class="hiddenOnMobile">Profile for {{$user->name}} @if(!$disabled && \Auth::user()->hasPermissionTo('edit users')){!! button(null, "Save Changes", "save", "pull-right", null, null, "button") !!}@endif</h5>
                <h5 style="margin-bottom:25px;" class="hiddenOnDesktop">User Profile @if(!$disabled && \Auth::user()->hasPermissionTo('edit users')){!! button(null, "Save Changes", "save", "pull-right", null, null, "button") !!}@endif</h5>
            </div>

                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" @if($disabled == 'disabled') disabled @endif type="text"
                               value="{{ $user->name }}" name="name"/>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" @if($disabled == 'disabled') disabled @endif type="text"
                               value="{{ $user->email }}" name="email"/>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="custom-select" id="status" name="status" @if($disabled == 'disabled') disabled
                                @endif
                                aria-describedby="postStatus" style="width:100%;">

                            <option <?php if ($user->status == "ACTIVE") {
                                    echo "SELECTED";
                                    } ?> value="ACTIVE">Active
                            </option>
                            <option <?php if ($user->status == "INACTIVE") {
                                    echo "SELECTED";
                                    } ?> value="INACTIVE">Inctive
                            </option>
                        </select>
                    </div>
                    @if(\Auth::user()->hasPermissionTo('edit users') && \Auth::user()->hasPermissionTo('edit roles'))
                        <div class="form-group">
                            <label>Roles</label>
                            <?php $roles = \App\Role::all();?>
                            <div class="card">
                                <div class="meta-fields card-body" id="meta" role="tabpanel"
                                     align="left" style="min-height:50px !important;">
                                    @foreach($roles as $role)
                                        <div class="checkbox">
                                            <?php $fieldname = $role->name; ;?>
                                            <input
                                                    id="roles[{{$fieldname}}]"
                                                    type="checkbox"
                                                    name="roles[{{$fieldname}}]"
                                                    @if($user->hasRole($role->name)) checked="" @endif />
                                            <label for="{{$fieldname}}">
                                                {{ ucwords($role->name) }}<br>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($disabled !== 'disabled')
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" @if($disabled == 'disabled') disabled @endif type="password"
                                   value="" name="password" autocomplete="new-password"/>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" @if($disabled == 'disabled') disabled @endif type="password"
                                   value="" name="confirm_password" autocomplete="new-password"/>
                        </div>
                    @endif
                </div>
                <div align="right" style="margin-bottom:35px;">
                    @if(!$disabled) <input type="hidden" name="user_id" value="{{$user->id}}"/>@endif
                    @if($disabled == 'disabled') <a href="/app/edit/user/{{$user->id}}"
                                                    class="btn btn-secondary-outline">Edit</a> @endif
                </div>
            </form>
        </div>
    </main>
@endsection