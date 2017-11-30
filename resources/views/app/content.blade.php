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
        .badge-status {
            background:#555;
            border:1px solid #555;
            color:#fff;
            min-width:100px;
            padding:3px 8px;
            font-weight:400;
            border-radius:4px;
        }
        .badge-status-disabled {
            background:#999;
            border:1px solid #999;
            color:#fff;
            min-width:100px;
            padding:3px 8px;
            font-weight:400;
            border-radius:4px;
        }
        .badge-date, .badge-category {
            background:#fff;
            border:1px solid #999;
            color:#999;
            min-width:100px;
            padding:3px 8px;
            font-weight:400;
            border-radius:4px;
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
                            <h5 style="margin-bottom:25px;">Content</h5>
                            <div class="form-group" >
                                <form>
                                    <input type="text" value="" placeholder="Search content..." class="form-control" name="s" id="s">
                                </form>
                            </div>
                            <div style="margin-bottom:10px;" align="right">
                                <button type="button" class="btn btn-round btn-secondary-outline " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    New Item <i class="now-ui-icons ui-1_simple-add"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" align="center">
                                    <?php foreach($postTypes as $postType) { ?>
                                    <a href="/app/new/{{$postType->slug}}"
                                       class="dropdown-item"> <i class="now-ui-icons ui-1_simple-add"></i> &nbsp; New {{$postType->title}}</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <table class="table">
                                <thead class="hiddenOnMobile">
                                <tr>
                                    <th scope="col" class="hiddenOnMobile">Last Updated</th>
                                    <th scope="col" >Title</th>
                                    <th scope="col" class="hiddenOnMobile">Status</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td class="hiddenOnMobile"><span class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans() }}</span></td>
                                    <td>{{ ucfirst($post->title) }}<span><br><span style="opacity: 0.4;">{{ $post->postType()->title }}<span class="hiddenOnDesktop"> ({{ ucfirst(strtolower($post->status)) }})</span></span></span></td>
                                    <td scope="col" class="hiddenOnMobile"><span class="badge badge-status<?php if($post->status !== "PUBLISHED") { echo "-disabled"; } ?>">{{ $post->status }}</span></td>
                                    <td align="right">
                                        <a href="/app/view/post/{{ $post->id }}" class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</a>
                                        <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                            <a href="/app/view/post/{{ $post->id }}" class="btn btn-sm btn-secondary-outline">View</a>
                                            <a href="/app/edit/post/{{ $post->id }}" class="btn btn-sm btn-secondary-outline" style="border-left:none!important;">Edit</a>
                                            <a href="/app/delete/post/{{ $post->id }}" class="btn btn-sm btn-secondary-outline" style="border-left:none!important;"  data-toggle="modal" data-target="#deletePost" onclick=" $('#deleteButton').attr('href', $(this).attr('href'));this.href='#';">Delete</a>
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
        <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    </body>
@endsection