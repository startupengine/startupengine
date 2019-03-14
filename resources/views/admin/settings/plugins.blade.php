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

        .input-group-text {
            min-width:40px !important;
            text-align:center !important;
        }

    </style>
@endsection

@section('head')
@endsection

@section('page-title') Plugin Settings @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="card card-small mb-4" style="height:calc(100% - 25px);">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Calendly</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <strong class="text-muted d-block mb-2">API Key</strong>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-code"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="API Key"
                                       aria-label="API Key">
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-small mb-4" style="height:calc(100% - 25px);">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Heroku</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <strong class="text-muted d-block mb-2">API Token</strong>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-code"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="API Token">
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
@endsection