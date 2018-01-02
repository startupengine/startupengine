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
                <h5 style="margin-bottom:25px;">Content Types</h5>

                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search content types..." class="form-control" id="s"
                               name="s">
                    </form>
                </div>
                <div align="right">
                    <a href="/app/new/schema" class="btn btn-secondary-outline btn-round">New Content Type
                        &nbsp;&nbsp;<i class="now-ui-icons ui-1_simple-add"></i></a>
                </div>

                <table class="table clickable">
                    <thead class="hiddenOnMobile">
                    <tr>
                        <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                        <th scope="col" class="hiddenOnMobile status_column">Status</th>
                        <th scope="col">Info</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postTypes as $postType)
                        <tr>
                            <td class="hiddenOnMobile updated_at_column"><span
                                        class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($postType->updated_at))->diffForHumans() }}</span>
                            </td>
                            <td scope="col" class="hiddenOnMobile status_column"><span
                                        class="badge badge-status<?php if ($postType->enabled !== true) {
                                            echo "-disabled";
                                        } ?>"><?php if ($postType->enabled) echo "ENABLED"; else {
                                        echo "DISABLED";
                                    } ?></span></td>
                            <td>{{ $postType->title }}<br><span
                                        style="opacity:0.5;">{{$postType->json()->description}}</span></td>
                            <td align="right">
                                <a href="/app/edit/schema/{{ $postType->slug }}"
                                   class="btn btn-sm btn-secondary-outline defaultClick" style="">Edit Schema</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
@endsection