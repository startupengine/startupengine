@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
@endsection

@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Permissions  <a href="/app/new/permission" class="btn btn-secondary-outline btn-sm pull-right">New Permission &nbsp;<i
                                class="now-ui-icons ui-1_simple-add"></i></a></h5>
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search roles..." class="form-control" name="s" id="s">
                    </form>
                </div>

                <div align="center">
                    <div class="btn-group">
                        <a href="/app/users" class="btn btn-secondary-outline btn-sm ">Users</a>
                        <a href="/app/roles" class="btn btn-secondary-outline btn-sm"  style="border-left:none !important;">Roles</a>
                        <a href="/app/permissions" class="btn btn-secondary btn-sm " style="border-left:none !important;">Permissions</a>
                    </div>

                </div>


                <table class="table">
                    <thead class="hiddenOnMobile">
                    <tr>
                        <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                        <th scope="col">Permission</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td scope="col" class="hiddenOnMobile updated_at_column"><span
                                        class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($permission->updated_at))->diffForHumans() }}</span>
                            </td>
                            <td>{{ ucwords($permission->name) }}<br><span style="opacity:0.5;">{{$permission->guard_name}}</span></td>
                            <td align="right">


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
    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        <p>Once you delete this user, it will be unavailable unless an administrator un-deletes it.
                            Since an e-mail address can only be used once, it will also be impossible for a new account
                            to be created with this user's e-mail.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="deleteButton">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection