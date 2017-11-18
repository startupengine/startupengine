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
                            @if($request->input('s') == null && $request->input('group') == null)
                            <div>
                                <div class="col-md-4" style="float:left;">
                                    <div class="card">
                                        <div class="card-header" align="center">
                                            Content Types
                                        </div>
                                        <div class="card-body" align="center" style="min-height: 100px;">
                                            <p>Add or edit content types.</p>
                                        </div>
                                        <div class="card-footer" align="center">
                                            <a href="/app/schema" class="btn btn-secondary-outline btn-round">Content Types</a>
                                        </div>
                                    </div>
                                </div>
                                @foreach($settingsGroups as $key => $value)
                                    <div class="col-md-4" style="float:left;">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                {{ ucfirst($key) }}
                                            </div>
                                            <div class="card-body" align="center" style="min-height: 100px;">
                                                <?php $filtered = $value->where('key', strtolower($key).'.settings_description')->first(); if($filtered !== null) { echo "<p>".$filtered->value."</p>"; } if($filtered == null ) { echo "Settings for ".strtolower(str_plural($key)); } ?>
                                            </div>
                                            <div class="card-footer" align="center">
                                                <a href="/app/settings?group={{$key}}" class="btn btn-secondary-outline btn-round" >{{ $key }} Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            @if($request->input('s') !== null or $request->input('group') !== null)
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
                                <?php $postType = $request->input('group'); ?>
                                <?php $postType = $postTypes->where('title', '=', $postType)->first(); ?>
                                @if($postType !== null)

                                    <tr>
                                        <td>Content Type: {{ $postType->title }}</td>
                                        <td class="hiddenOnMobile"></td>
                                        <td><?php if($postType->enabled) echo "ENABLED"; else { echo "DISABLED"; } ?></td>
                                        <td align="right">
                                            <a href="/app/edit/schema/{{ $postType->slug }}" class="btn btn-sm btn-secondary-outline" style="">Edit Schema</a>
                                        </td>
                                    </tr>
                                @endif
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