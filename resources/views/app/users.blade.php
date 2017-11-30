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
                            <div class="form-group">
                                <form>
                                    <input type="text" value="" placeholder="Search users..." class="form-control" name="s" id="s">
                                </form>
                            </div>
                            <?php /*
                            <div style="margin-bottom:10px;" align="right">
                                <a href="/app/users/invite" class="btn btn-secondary-outline btn-round">Invite Collaborators&nbsp;&nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                            </div>
                            */ ?>
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
                                    <td class="hiddenOnMobile">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->updated_at))->diffForHumans() }}</td>
                                    <td align="right">
                                        <button type="button" class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</button>
                                        <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                            <a href="/app/view/user/{{ $user->id }}" class="btn btn-sm btn-secondary-outline">View</a>
                                            <?php /* <button type="button" class="btn btn-sm btn-secondary-outline" style="border-left:none!important;">Edit</button> */?>
                                            <?php /* <button type="button" class="btn btn-sm btn-secondary-outline" style="border-left:none!important;">Delete</button>*/?>
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