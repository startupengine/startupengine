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
                            <h5 style="margin-bottom:25px;">Users</h5>
                            <div class="form-group">
                                <form>
                                    <input type="text" value="" placeholder="Search users..." class="form-control" name="s" id="s">
                                </form>
                            </div>

                            <div style="margin-bottom:10px;" align="right">
                                <a href="/app/new/user" class="btn btn-secondary-outline btn-round">New User &nbsp;&nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="hiddenOnMobile">Last Activity</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td scope="col" class="hiddenOnMobile"><span class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->updated_at))->diffForHumans() }}</span></td>
                                    <td align="right">
                                        <a href="/app/view/user/{{$user->id}}" class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</a>
                                        <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                            <a href="/app/view/user/{{ $user->id }}" class="btn btn-sm btn-secondary-outline">View</a>
                                            <a href="/app/edit/user/{{ $user->id }}" class="btn btn-sm btn-secondary-outline" style="border-left:none !important;">Edit</a>
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