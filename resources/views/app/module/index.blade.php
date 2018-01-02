@extends('layouts.app')

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

        @media (max-width: 991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
        }

        .badge-category {
            background: royalblue;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')

    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Modules</h5>
            </div>
            @foreach($modules as $module)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{ $module->name }}</div>
                        <div class="card-img-top"
                             style="background:url('{{ $module->image }}'); background-size:contain;background-position:center;background-repeat:no-repeat;height:200px;width:100%;">
                            &nbsp;</div>
                        <div class="card-body"
                             style="min-height:auto;border-top:1px solid #eee;">{{ $module->description }}</div>
                        <div class="card-footer" align="center"><a href="/app/modules/{{$module->slug}}/settings"
                                                                   class="nav-link">Configure</a></div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

@endsection

@section('modals')
    <!-- Modal Core -->
    <div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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