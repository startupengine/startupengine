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
                <h5 style="margin-bottom:25px;">Pages {!! button("/app/new/page", "New Page", "new", "pull-right" ) !!}</a> </h5>
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search pages..." class="form-control" name="s" id="s">
                    </form>
                </div>
                <table class="table clickable">
                    <thead class="hiddenOnMobile">
                    <tr>
                        <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                        <th scope="col" class="status_column">Status</th>
                        <th scope="col">Title</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td class="hiddenOnMobile updated_at_column"><span
                                        class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($page->updated_at))->diffForHumans() }}</span>
                            </td>
                            <td class="hiddenOnMobile status_column"><span
                                        class="badge badge-status<?php if ($page->status !== "ACTIVE") {
                                            echo "-disabled";
                                        } ?>">{{ $page->status }}</span></td>
                            <td>{{ $page->title }}<span class="hiddenOnMobile" style="opacity:0.5;display:block;">{{config('app.url')}}
                                    /{{ $page->slug }}</span><span class="hiddenOnDesktop"><br><span
                                            style="opacity: 0.4;">{{ ucfirst(strtolower($page->status)) }}</span></span>
                            </td>
                            <td align="right">
                                <a href="/app/edit/page/{{ $page->id }}"
                                   class="btn btn-sm btn-secondary-outline hiddenOnDesktop defaultClick">Edit</a>
                                <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                    <a href="/{{ $page->slug }}" class="btn btn-sm btn-secondary-outline"
                                       target="_blank">View</a>
                                    <a href="/app/edit/page/{{ $page->id }}" class="btn btn-sm btn-secondary-outline"
                                       style="border-left:none!important;">Edit</a>
                                    <a href="/app/delete/page/{{ $page->id }}" class="btn btn-sm btn-secondary-outline"
                                       style="border-left:none!important;" data-toggle="modal"
                                       data-target="#deletePage"
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
    <div class="modal fade" id="deletePage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        <p>Once you delete this page, it will be unavailable unless an administrator un-deletes it.</p>
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