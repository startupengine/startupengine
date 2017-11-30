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
                            <h5 style="margin-bottom:25px;">Content Types</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom:40px;">
                                <form>
                                    <input type="text" value="" placeholder="Search content types..." class="form-control" id="s" name="s">
                                </form>
                            </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"> </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($postTypes as $postType)
                                    <tr>
                                        <td>{{ $postType->title }}</td>
                                        <td scope="col" class="hiddenOnMobile"><span
                                                    class="badge badge-status<?php if ($postType->enabled !== true) {
                                                        echo "-disabled";
                                                    } ?>"><?php if($postType->enabled) echo "ENABLED"; else { echo "DISABLED"; } ?></span></td>
                                        <td align="right">
                                            <a href="/app/edit/schema/{{ $postType->slug }}" class="btn btn-sm btn-secondary-outline" style="">Edit Schema</a>
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