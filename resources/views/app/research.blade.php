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
                display:none;
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
                            <div class="col-md-4 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons location_bookmark"></i>&nbsp; Items</h5>
                                <ul class="list-group">
                                    <li class="list-group-item" style="text-align:center;"><a href="/app/new/item" class="btn btn-secondary-outline btn-round" data-toggle="modal" data-target="#newItem">New Item &nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a></li>
                                    <?php foreach($researchitems as $item) { ?>
                                    <li class="list-group-item" style="text-align:center;"><a href="/app/research/item/{{$item->id}}" class="btn btn-link" >{{ $item->url }}</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="col-md-4 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons education_agenda-bookmark"></i>&nbsp; Collections</h5>
                                <ul class="list-group">
                                    <li class="list-group-item" style="text-align:center;"><a href="/app/new/collection" class="btn btn-secondary-outline btn-round" data-toggle="modal" data-target="#newCollection">New Collection &nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a></li>
                                    <?php foreach($researchcollections as $collection) { ?>
                                    <li class="list-group-item" style="text-align:center;"><a href="/app/research/item/{{$collection->id}}" class="btn btn-link">{{ $collection->name }}</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="col-md-4 pull-left"  style="margin-bottom:15px;">
                                <h5><i class="now-ui-icons education_paper"></i>&nbsp; Feeds</h5>
                                <ul class="list-group">
                                    <li class="list-group-item" style="text-align:center;"><a href="/app/new/feed" class="btn btn-secondary-outline btn-round" data-toggle="modal" data-target="#newFeed">New Feed &nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a></li>
                                    <?php foreach($researchfeeds as $feed) { ?>
                                    <li class="list-group-item" style="text-align:center;"><a href="/app/research/feed/{{$feed->id}}" class="btn btn-link">{{ $feed->url }}</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <form action="/app/new/research/collection" method="post">
    <!-- Modal Core -->
    <div class="modal fade" id="newCollection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">New Collection</h4>
                </div>
                <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom:25px;">
                                <label for="collectionName">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="collectionName" placeholder="Enter a name" name="name">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary-outline">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <form action="/app/new/research/feed" method="post">
        <!-- Modal Core -->
        <div class="modal fade" id="newFeed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">New RSS Feed</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom:25px;">
                                <label for="feedUrl">URL</label>
                                <input type="text" class="form-control" id="url" aria-describedby="feedUrl" placeholder="Enter a url" name="url">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary-outline">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="/app/new/research/item" method="post">
        <!-- Modal Core -->
        <div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">New Research Item</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom:25px;">
                                <label for="feedUrl">URL</label>
                                <input type="text" class="form-control" id="url" aria-describedby="feedUrl" placeholder="Enter a url" name="url">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary-outline">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    </body>
@endsection