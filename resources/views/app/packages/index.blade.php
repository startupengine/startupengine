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

        .badge-status {
            background: #555;
            border: 1px solid #555;
            color: #fff;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .badge-status-disabled {
            background: #999;
            border: 1px solid #999;
            color: #fff;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .badge-date, .badge-category {
            background: #fff;
            border: 1px solid #999;
            color: #999;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
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
                            <h5 style="margin-bottom:25px;">Packages</h5>
                            <div class="form-group">
                                <form>
                                    <input type="text" value="" placeholder="Search packages..." class="form-control"
                                           name="s" id="s">
                                </form>
                            </div>
                            <div align="right">
                                <a href="/app/new/package" class="btn btn-round btn-secondary-outline "
                                   data-toggle="modal" data-target="#newPackage">
                                    Add Package &nbsp;<i class="now-ui-icons ui-1_simple-add"></i>
                                </a>
                            </div>
                            <table class="table">
                                <thead class="hiddenOnMobile">
                                <tr>
                                    <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                                    <th scope="col">Info</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td class="hiddenOnMobile updated_at_column"><span
                                                    class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($package->updated_at))->diffForHumans() }}</span>
                                        </td>
                                        <td>{{$package->json()->name}}<br>Version {{$package->json()->version}}</td>
                                        <td align="right">
                                            <a href="/app/view/package/{{ $package->id }}"
                                               class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</a>
                                            <div class="btn-group hiddenOnMobile" role="group"
                                                 aria-label="Basic example">
                                                <a href="/app/update/package/{{ $package->id }}"
                                                   class="btn btn-sm btn-secondary-outline"
                                                   data-toggle="modal"
                                                   data-target="#packageInfo"
                                                   onclick=" $('#packageUrl').attr('href', '{{$package->url}}'); $('#packageDescription').html('{{$package->json()->description}}'); $('#packageName').html('{{$package->json()->name}}');  $('#packageVersion').html('Version {{$package->json()->version}}');">Details</a>
                                                <a href="/app/update/package/{{ $package->id }}"
                                                   class="btn btn-sm btn-secondary-outline"
                                                   style="border-left:none!important;" data-toggle="modal"
                                                   data-target="#updatePackage"
                                                   onclick=" $('#syncButton').attr('href', $(this).attr('href'));this.href='#';">Update</a>
                                                <a href="/app/reset/package/{{ $package->id }}"
                                                   class="btn btn-sm btn-secondary-outline"
                                                   style="border-left:none!important;" data-toggle="modal"
                                                   data-target="#syncPackage"
                                                   onclick=" $('#resetButton').attr('href', $(this).attr('href'));this.href='#';">Reset</a>
                                                <a href="/app/delete/package/{{ $package->id }}"
                                                   class="btn btn-sm btn-secondary-outline"
                                                   style="border-left:none!important;" data-toggle="modal"
                                                   data-target="#deletePackage"
                                                   onclick=" $('#deleteButton').attr('href', $(this).attr('href'));this.href='#';">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="newPackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form action="/app/new/package" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Add A New Package</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <p>Paste the url to a git repository containing a StartupEngine package, then click install.</p>
                        </div>
                        <div class="form-group">
                            <label for="postStatus">URL</label><br>
                            <input name="url" class="form-control" placeholder="http://..." autocomplete="off"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-secondary" id="installButton">Install</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="deletePackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Once you delete this post, it will be unavailable unless an administrator un-deletes it.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="deleteButton">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="syncPackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Resetting the package will change any settings you've tweaked to their default states.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-secondary" id="resetButton">Reset Package</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="updatePackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Updating the package may overwrite some of the settings you've tweaked. Be sure to double-check after the update completes from the settings panel.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-secondary" id="syncButton">Update Package</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="packageInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="packageName"></h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p id="packageVersion" class="badge badge-category"></p>
                        <p id="packageDescription" style="margin-top:10px;"></p>
                        <p><a href="#" id="packageUrl" target="_blank" style="text-decoration: none;">View Package Repository</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
@endsection