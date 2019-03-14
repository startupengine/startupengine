@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        .card {
            margin-bottom: 15px;
        }

        a p.card-text {
            color: #000 !important;
        }

        a .card-title {
            color: #444 !important;
        }

    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Billing Settings @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- Input & Button Groups -->
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Stripe</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <!-- Input Groups -->
                            <strong class="text-muted d-block mb-2">API Keys</strong>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Secret Key"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Public Key"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <button type="submit" class="btn btn-accent">Update Accounts</button>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- / Input & Button Groups -->
        </div>
    </div>
@endsection

@section('scripts')
@endsection