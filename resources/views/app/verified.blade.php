@extends('layouts.shards_frontend')

@section('php-variables')
    <?php
    $viewOptions['navbar-classes'] = ['dark'];
    $viewOptions['navbar-scroll-add-classes'] = ['dark'];
    $viewOptions['navbar-unscroll-remove-classes'] = [];
    ?>
@endsection

@section('title')
    Account Verified
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection

@section('css')
    <style>
        .avatar-large {
            height: 50px;
            width: 50px;
            border-radius: 50px;
            display: inline-block;
            background-size: cover;
            background-position: center;
        }

        .card.border {
            border-color: #cfd8e2 !important;
        }

        .card-header {
            background: #fff !important;
        }

        .card {
            height: auto !important;
            min-height: auto !important;
        }


    </style>


    <style>
        #contentForm .col-lg-9 {
            min-width: 100% !important;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group-addon {
            min-width: 50px;
            background: #eee;
            border-radius: 5px 0px 0px 5px;
            color: #a3aac5;
            padding: 13px;
        }

        .btn-login {
            color: #fff;
            border: 1px solid #858a94 !important;
            padding: 9px 25px 10px 25px;
            background: linear-gradient(#858a94, #2d2d33) !important;
            margin: 0px 10px !important;
        }
        .input-group-addon i.text-danger {
            opacity:0.66 !important;
        }

        .input-group-addon-danger {
            background:#ffdfe2;
        }
    </style>
@endsection

@section('navbar-classes')
    @foreach($viewOptions['navbar-classes'] as $class)
        {{ $class }}
    @endforeach
@endsection

@section('splash-class')
    minimal
@endsection

@section('content')
    <div class=" section section-invert" style="border:none !important;min-height:100%;" id="newUserApp">
        <div class="container" align="center">
            <div class="row pt-5 px-3">
                <div class="card col-md-4 mx-auto mb-4 p-4">
                    <div class="card-body">
                        <i class="fa fa-fw fa-check text-success mb-3 d-block"></i><strong class=" mb-3 text-primary d-block">Success.</strong>
                        <p class="card-text">Your account has been verified.</p>
                        <div class="btn-group">
                            <a href="/app/account" class="btn btn-lg btn-pill btn-primary">Okay</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
