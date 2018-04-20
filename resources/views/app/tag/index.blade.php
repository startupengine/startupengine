@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media (max-width: 991px) {
            .sidebar {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .mobile-nav {
                display: none;
            }
        }

        .main .card-body {
            min-height: 150px !important;
        }
    </style>
@endsection

@section('content')


    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;"><?php if ($request->input('group') !== null) {
                        echo ucfirst($request->input('group')) . ' ';
                    } ?> Tags
                    {!! button("/app/new/tag/group", "New Tag Group", "new", "pull-right") !!}
                </h5>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search tags..." class="form-control"
                               id="s" name="s">
                    </form>
                </div>


                    <table class="table clickable">
                        <thead class="hiddenOnMobile">
                        <tr>
                            <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                            <th scope="col">Info</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($tags as $tag)
                            <tr>
                                <td class="hiddenOnMobile updated_at_column"><span
                                            class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($tag->updated_at))->diffForHumans() }}</span>
                                </td>
                                <td>{{ $tag->name }}<br><span style="opacity:0.5;">{{$tag->count}} Item<?php if($tag->count > 1) { ?>s<?php } ?></span>
                                </td>
                                <td align="right">
                                    <?php if($tag->post() !== null){ ?>
                                        <a href="/app/edit/post/{{ $tag->post()->id }}"
                                       class="btn btn-sm btn-secondary-outline defaultClick" style="">Edit</a>"; <?php } ?>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </main>

@endsection