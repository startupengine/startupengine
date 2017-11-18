@extends('layouts.app')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media(max-width:991px) {
            .sidebar {
                display:none !important;
            }
        }
        @media(min-width:991px) {
            .mobile-nav {
                display:none;
            }
        }
        @media(max-width:991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }
        @media(min-width:991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
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
                            <h5 style="margin-bottom:25px;">Settings</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom:40px;">
                                <form>
                                    <input type="text" value="" placeholder="Search settings..." class="form-control" id="s" name="s">
                                </form>
                            </div>
                            @if($request->input('s') == null)
                            <div>
                                @foreach($postTypes as $postType)
                                    <div class="col-md-4" style="float:left;">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                {{ $postType->title }}
                                            </div>
                                            <div class="card-body" align="center" style="min-height:125px;">
                                                <p>{{ $postType->json()->description }}</p>
                                                <a href="#" class="btn btn-secondary-outline btn-round">Edit {{ $postType->title }} Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($settingsGroups as $group)
                                    <div class="col-md-4" style="float:left;">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                {{ ucfirst($group->group) }}
                                            </div>
                                            <div class="card-body" align="center" style="min-height:125px;">
                                                <a href="#" class="btn btn-secondary-outline btn-round">Edit {{ $group->group }} Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            @if($request->input('s') !== null)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="hiddenOnMobile">Value</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $setting)
                                <tr>
                                    <td>{{ $setting->display_name }}</td>
                                    <td class="hiddenOnMobile">{{ substr($setting->value, 0, 25)}}...</td>
                                    <td>{{ $setting->status }}</td>
                                    <td align="right">
                                        <a href="/app/edit/setting/{{ $setting->id }}" class="btn btn-sm btn-secondary-outline" style="">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    </body>
@endsection