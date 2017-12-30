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
                            <h5 style="margin-bottom:25px;">Roles</h5>
                            <div class="form-group">
                                <form>
                                    <input type="text" value="" placeholder="Search roles..." class="form-control" name="s" id="s">
                                </form>
                            </div>

                            <div align="left">
                                <div class="btn-group">
                                <a href="/app/users" class="btn btn-secondary-outline  ">Users</a>
                                <a href="/app/roles" class="btn btn-secondary ">Roles</a>
                                </div>
                                <a href="/app/new/role" class="btn btn-secondary-outline btn-round pull-right">New Role &nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                            </div>


                            <table class="table">
                                <thead class="hiddenOnMobile">
                                <tr>
                                    <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td scope="col" class="hiddenOnMobile updated_at_column"><span class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($role->updated_at))->diffForHumans() }}</span></td>
                                    <td>{{ $role->display_name }}<br><span style="opacity:0.5;">{{ $role->email }}</span></td>
                                    <td align="right">
                                        <a href="/app/view/role/{{$role->id}}" class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</a>
                                        <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                            <a href="/app/view/role/{{ $role->id }}" class="btn btn-sm btn-secondary-outline">View</a>
                                            <a href="/app/edit/role/{{ $role->id }}" class="btn btn-sm btn-secondary-outline" style="border-left:none !important;">Edit</a>
                                            <a href="/app/delete/role/{{ $role->id }}" class="btn btn-sm btn-secondary-outline" style="border-left:none !important;" data-toggle="modal" data-target="#deleteUser" onclick=" $('#deleteButton').attr('href', $(this).attr('href'));this.href='#';">Delete</a>
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
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Once you delete this user, it will be unavailable unless an administrator un-deletes it. Since an e-mail address can only be used once, it will also be impossible for a new account to be created with this user's e-mail.</p>
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