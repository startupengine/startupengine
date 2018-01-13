@extends('layouts.admin')

@section('title')
    <?php echo setting('site.name') ?>
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
                <h5 style="margin-bottom:25px;">Content
                    <div class="dropdown" style="inline-block;float:right;z-index:1;">
                        {!! button(null, "New Item", "new", "pull-right",  null, 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"', 'button') !!}
                        <div class="dropdown-menu dropdown-menu-right" align="center" style="opacity:1;z-index:999 !important;background:#fff;">
                            @if($postTypes->isEmpty())
                                <a href="#" class="dropdown-item">No content types</a>
                            @endif
                            <?php foreach($postTypes as $postType) { ?>
                            <a href="/app/new/{{$postType->slug}}"
                               class="dropdown-item"> <i class="now-ui-icons ui-1_simple-add"></i> &nbsp;
                                New {{$postType->title}}</a>
                            <?php } ?>
                        </div>
                    </div>
                </h5>
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search content..." class="form-control" name="s"
                               id="s">
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
                    @foreach($posts as $post)
                        <tr>

                            <td class="hiddenOnMobile updated_at_column"><span
                                        class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans() }}</span>
                            </td>
                            <td scope="col" class="hiddenOnMobile status_column"><span
                                        class="badge badge-status<?php if ($post->status !== "PUBLISHED") {
                                            echo "-disabled";
                                        } ?>">{{ $post->status }}</span></td>
                            <td>
                                {{ ucfirst($post->title) }}<br>
                                <span style="opacity: 0.5;">{{ $post->postType()->title }}</span>
                                <span  style="opacity: 0.5;">published {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->published_at))->format('j/d/Y') }}</span>


                            </td>
                            <td align="right">

                                <a href="/app/edit/post/{{ $post->id }}"
                                   class="btn btn-sm btn-secondary-outline hiddenOnDesktop defaultClick">Edit</a>

                                <div class="btn-group hiddenOnMobile" role="group" aria-label="Basic example">
                                    <a href="/app/edit/post/{{ $post->id }}" class="btn btn-sm btn-secondary-outline">Edit</a>
                                    <a href="/app/delete/post/{{ $post->id }}" class="btn btn-sm btn-secondary-outline"
                                       style="border-left:none!important;" data-toggle="modal" data-target="#deletePost"
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
    <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
@endsection