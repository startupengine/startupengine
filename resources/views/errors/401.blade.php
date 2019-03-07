@extends('layouts.shards_frontend')

@section('title')
    Error 401 - Sign In Required
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection

@section('splash-style')

@endsection


@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row justify-content-center">
            <div class="col-md-12 mx-3 mb-3 ">
                <h1 class=" display-4 text-white text-center"><i class="fa fa-fw fa-lg fa-lock mb-3 text-dark" style="opacity:0.35;"></i></h1>
                <p class="text-white pt-2 text-center" style="font-size:130%;"><span class="d-inline-block">You must </span><a href="/login" class="btn btn-white btn-pill mx-2 d-inline-blockl">Sign In <i class="fa fa-fw fa-sign-in-alt ml-2 text-dark"></i></a><span class="d-inline-block"> to view this page.</span>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection