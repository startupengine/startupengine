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

        .main .card-body {
            min-height: 150px !important;
        }
    </style>
@endsection

@section('content')


    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;"><?php if ($request->input('group') !== null) {
                        echo ucfirst($request->input('group')) . ' ';
                    } ?>Settings</h5>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search settings..." class="form-control"
                               id="s" name="s">
                    </form>
                </div>
                @if($request->input('s') == null && $request->input('group') == null)
                    <div style="margin-top:25px;" class="row row-eq-height">
                        <div class="col-md-4" style="display:inline-block !important;">
                            <div class="card" style="margin-bottom:25px;">
                                <div class="card-header" align="center">
                                    Content Types
                                </div>
                                <div class="card-body" align="center" style="min-height: 100px;">
                                    <p>Add or edit content types.</p>
                                </div>
                                <div class="card-footer" align="center">
                                    <a href="/app/schema" class="btn btn-secondary-outline btn-round">Content
                                        Types</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="display:inline-block !important;">
                            <div class="card" style="margin-bottom:25px;">
                                <div class="card-header" align="center">
                                    API Settings
                                </div>
                                <div class="card-body" align="center" style="min-height: 100px;">
                                    <p>Manage clients & personal access tokens.</p>
                                </div>
                                <div class="card-footer" align="center">
                                    <a href="/app/settings/api" class="btn btn-secondary-outline btn-round">API
                                        Settings</a>
                                </div>
                            </div>
                        </div>
                        @if(\Auth::user()->hasPermissionTo('browse packages'))
                            <div class="col-md-4" style="display:inline-block !important;">
                                <div class="card" style="margin-bottom:25px;">
                                    <div class="card-header" align="center">
                                        Packages
                                    </div>
                                    <div class="card-body" align="center" style="min-height: 100px;">
                                        <p>Update, Sync, &amp; Manage your git packages.</p>
                                    </div>
                                    <div class="card-footer" align="center">
                                        <a href="/app/packages" class="btn btn-secondary-outline btn-round">Manage
                                            Packages</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach($settingsGroups as $key => $value)
                            @if($key !== '' && $key !== null)
                                <div class="col-md-4" style="display:inline-block !important;">
                                    <div class="card" style="margin-bottom:25px;">
                                        <div class="card-header" align="center">
                                            {{ ucfirst($key) }}
                                        </div>
                                        <div class="card-body" align="center" style="min-height: 100px;">
                                            <?php $filtered = $value->where('key', strtolower($key) . '.settings_description')->first(); if ($filtered !== null) {
                                                echo "<p>" . $filtered->value . "</p>";
                                            } if ($filtered == null) {
                                                echo "Settings for " . strtolower(str_plural($key));
                                            } ?>
                                        </div>
                                        <div class="card-footer" align="center">
                                            <a href="/app/settings?group={{$key}}"
                                               class="btn btn-secondary-outline btn-round">{{ $key }}
                                                Settings</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                @if($request->input('s') !== null or $request->input('group') !== null)
                    <div align="right">
                        <a href="/app/new/setting" class="btn btn-secondary-outline btn-round btn-sm">New Setting
                            &nbsp;&nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                    </div>
                @endif
                @if($request->input('s') !== null or $request->input('group') !== null)
                    <table class="table clickable">
                        <thead class="hiddenOnMobile">
                        <tr>
                            <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                            <th scope="col" class="status_column">Status</th>
                            <th scope="col">Info</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $postType = $request->input('group'); ?>
                        <?php $postType = $postTypes->where('title', '=', $postType)->first(); ?>
                        @if($postType !== null)

                            <tr>
                                <td class="hiddenOnMobile updated_at_column"><span
                                            class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($postType->updated_at))->diffForHumans() }}</span>
                                </td>
                                <td class="hiddenOnMobile status_column">
                                                <span
                                                        class="badge badge-status<?php if ($postType->enabled !== true) {
                                                            echo "-disabled";
                                                        } ?>">
                                                <?php if ($postType->enabled) echo "ENABLED"; else {
                                                        echo "DISABLED";
                                                    } ?>
                                                </span>
                                </td>
                                <td>Content Type: {{ $postType->title }}<br><span
                                            style="opacity:0.5;">{{$postType->slug}}</span></td>
                                <td align="right">
                                    <a href="/app/edit/schema/{{ $postType->slug }}"
                                       class="btn btn-sm btn-secondary-outline" style="">Edit Schema</a>
                                </td>
                            </tr>
                        @endif
                        @foreach($settings as $setting)
                            <tr>
                                <td class="hiddenOnMobile updated_at_column"><span
                                            class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->updated_at))->diffForHumans() }}</span>
                                </td>
                                <td scope="col" class="hiddenOnMobile status_column"><span
                                            class="badge badge-status<?php if ($setting->status !== "PUBLISHED") {
                                                echo "-disabled";
                                            } ?>">{{ $setting->status }}</span></td>
                                <td>{{ $setting->display_name }}<br><span style="opacity:0.5;">{{$setting->key}}</span>
                                </td>
                                <td align="right">
                                    <a href="/app/edit/setting/{{ $setting->id }}"
                                       class="btn btn-sm btn-secondary-outline defaultClick" style="">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </main>

@endsection