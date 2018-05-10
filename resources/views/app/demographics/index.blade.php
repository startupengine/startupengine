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
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Demographics
                    {!! button("/app/new/demographic", "New Demographic", "new", "pull-right") !!}
                </h5>
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search demographics..." class="form-control" name="s" id="s">
                    </form>
                </div>

                <table class="table">
                    <thead class="hiddenOnMobile">
                    <tr>
                        <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                        <th scope="col">Demo</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $demographics = \App\Demographic::all(); ?>
                    @foreach($demographics as $demo)
                        <tr>
                            <td scope="col" class="hiddenOnMobile updated_at_column"><span
                                        class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($demo->updated_at))->diffForHumans() }}</span>
                            </td>

                            <td>{{ $demo->name }}</td>
                            <td align="right">
                                <a href="/app/view/demographic/{{$demo->id}}"
                                   class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</a>
                                <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                    <a href="/app/view/demographic/{{ $demo->id }}" class="btn btn-sm btn-secondary-outline">View</a>
                                    <a href="/app/edit/demographic/{{ $demo->id }}" class="btn btn-sm btn-secondary-outline"
                                       style="border-left:none !important;">Edit</a>
                                    <a href="/app/delete/demographic/{{ $demo->id }}" class="btn btn-sm btn-secondary-outline"
                                       style="border-left:none !important;" data-toggle="modal"
                                       data-target="#deleteDemographic"
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
    <div class="modal fade" id="deleteDemographic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        <p>Once you delete this demographic, it will be unavailable unless an administrator un-deletes it.</p>
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