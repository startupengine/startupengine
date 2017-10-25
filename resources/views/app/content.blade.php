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
                            <div class="form-group" >
                                <form>
                                    <input type="text" value="" placeholder="Search content..." class="form-control" name="s" id="s">
                                </form>
                            </div>
                            <div style="margin-bottom:10px;" align="right">
                                <a href="/app/new/post" class="btn btn-secondary-outline btn-round">New Post &nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col" class="hiddenOnMobile">Excerpt</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="hiddenOnMobile">Last Activity</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td class="hiddenOnMobile">{{ $post->excerpt }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td class="hiddenOnMobile">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans() }}</td>
                                    <td align="right">
                                        <button type="button" class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</button>
                                        <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-secondary-outline">View</button>
                                            <button type="button" class="btn btn-sm btn-secondary-outline" style="border-left:none!important;">Edit</button>
                                            <button type="button" class="btn btn-sm btn-secondary-outline" style="border-left:none!important;">Delete</button>
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


    </body>
@endsection