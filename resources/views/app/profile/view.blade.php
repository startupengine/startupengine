@extends('layouts.app')

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
                                <h5 style="margin-bottom:25px;">Profile</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" disabled type="text" value="{{ $user->name }}" />
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <input class="form-control" disabled type="text" value="{{ ucfirst($user->role()->name) }}" />
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" disabled type="text" value="{{ $user->email }}" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" disabled type="text" value="**********" />
                                </div>
                            </div>
                            <div align="right" style="margin-bottom:35px;">
                                <a href="/app/edit/profile" class="btn btn-secondary-outline">Edit</a>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
@endsection