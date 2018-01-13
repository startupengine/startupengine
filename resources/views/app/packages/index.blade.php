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
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Packages

                    <a href="#" class="btn btn-secondary-outline btn-pill pull-right" data-toggle="modal"
                       data-target="#help"><i class="fa fa-question fa-sm"></i></a>
                    {!! button(null, "New Package", "new", "pull-right", null, 'data-toggle="modal" data-target="#newPackage"') !!}
                </h5>
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search packages..." class="form-control"
                               name="s" id="s">
                    </form>
                </div>
                <table class="table ">
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
                            <td class="hiddenOnMobile updated_at_column clickable"><span
                                        class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($package->updated_at))->diffForHumans() }}</span>
                            </td>
                            <td class="clickable">{{$package->json()->name}}<br><span
                                        style="opacity:0.5;">Version {{$package->json()->version}}</span></td>
                            <td align="right">
                                <a href="/app/view/package/{{ $package->id }}"
                                   class="btn btn-sm btn-secondary-outline hiddenOnDesktop"
                                   data-toggle="modal"
                                   data-target="#packageInfo"
                                   onclick=" $('#packageUrl').attr('href', '{{$package->url}}'); $('#packageDescription').html('{{$package->json()->description}}'); $('#packageName').html('{{$package->json()->name}}');  $('#packageVersion').html('Version {{$package->json()->version}}');"
                                >View</a>
                                <div class="btn-group hiddenOnMobile" role="group"
                                     aria-label="Basic example">
                                    <a href="/app/update/package/{{ $package->id }}"
                                       class="btn btn-sm btn-secondary-outline defaultClick"
                                       data-toggle="modal"
                                       data-target="#packageInfo"
                                       onclick=" $('#packageUrl').attr('href', '{{$package->url}}'); $('#packageDescription').html('{{$package->json()->description}}'); $('#packageName').html('{{$package->json()->name}}');  $('#packageVersion').html('Version {{$package->json()->version}}');">View</a>
                                    <a href="/app/update/package/{{ $package->id }}"
                                       class="btn btn-sm btn-secondary-outline"
                                       style="border-left:none!important;" data-toggle="modal"
                                       data-target="#updatePackage"
                                       onclick=" $('#syncButton').attr('href', $(this).attr('href'));this.href='#';">Edit</a>
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


@endsection

@section('modals')

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
                            <p>Paste the url to a git repository containing a StartupEngine package, then click
                                install.</p>
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
    <div class="modal fade" id="deletePackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
    <div class="modal fade" id="syncPackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
    <div class="modal fade" id="updatePackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Editing the package will result in changes on your site. Be sure you know what you're installing. @if(env('APP_PLATFORM') == 'heroku') Changes will appear the next time the site is deployed.@endif</p>
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
    <div class="modal fade" id="packageInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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
                        <p><a href="#" id="packageUrl" target="_blank" style="text-decoration: none;">View the git
                                repository for this package</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">About Packages</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Packages are git repositories with Startup Engine pages, content models, permissions, and even entirely new functionality.<br><br> @if(env('APP_PLATFORM') == 'heroku') Package contents are installed when Startup Engine is deployed. @else Package contents are available immediately after being added. @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection