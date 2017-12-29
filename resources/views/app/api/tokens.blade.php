@extends('layouts.app')

@section('title')
    API Settings
@endsection

@section('meta')
    <meta name="description" content="API Settings">
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

    </style>
@endsection

@section('content')
    <body class="index-page sidebar-collapse bg-gradient">
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
                                <h5 style="margin-bottom:25px;">API Settings</h5>
                            </div>
                            <div class="col-md-12">

                                <!-- API Authentication -->
                                <passport-clients></passport-clients>
                                <passport-authorized-clients></passport-authorized-clients>
                                <passport-personal-access-tokens></passport-personal-access-tokens>

                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
@endsection