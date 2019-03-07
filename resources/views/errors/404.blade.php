@extends('layouts.shards_frontend')

@section('title')
    Error 404
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
                <h1 class=" display-4 text-white text-center"><i class="fa fa-fw fa-lg fa-ban mb-3 text-dark" style="opacity:0.35;"></i></h1>
                <p class="text-white pt-2 text-center" style="font-size:130%;">Page not found.</p>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection