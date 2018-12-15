@extends('layouts.shards_frontend')

@section('title')
    Error 404
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection

@section('splash-style')
background-image:url('https://images.unsplash.com/photo-1510416096143-b3f355567e3d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80');
@endsection


@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row justify-content-center">
            <div class="col-md-12 mx-3 mb-3 ">
                <h1 class=" display-4 text-white text-center">Error 404</h1>
                <p class="text-white pt-2 text-center" style="font-size:130%;">Page not found.
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection