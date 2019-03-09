@extends('layouts.shards_frontend')

@section('php-variables')

@endsection

@section('title')
    Account
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

        .card-header{
            background:#fff !important;
        }

        .card{
            height:auto !important;
            min-height:auto !important;
        }


    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js"></script>

    <style>
        #contentForm .col-lg-9 {
            min-width: 100% !important;
        }
        .input-group {
            margin-bottom:15px;
        }
        .input-group-addon {
            min-width:50px;
            background:#eee;
            border-radius:5px 0px 0px 5px;
            color:#a3aac5;
            padding:13px;
        }



    </style>
@endsection

@section('navbar-classes')
    navbar-light navbar-blend-light-blue
@endsection

@section('splash-class')
    minimal
@endsection

@section('content')
<div class=" section section-invert" style="border:none !important;min-height:100%;">
    <div class="container" align="center">
        <div class="row pt-5">
            <div class="card mx-auto mb-4 p-4">
                <form class="form-horizontal " method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="card-header border-bottom text-center">
                        @if(setting('site.logo') !== null)
                            <div>
                                <img src="{{ setting('site.logo') }}" style="max-height:70px;margin-bottom:15px;" class="shadowed"/>
                            </div>
                        @endif
                        <h4 class="title title-up mb-1">Sign In</h4>
                        <h6 class="mb-4">to continue</h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="social-line">
                            @if(setting('auth.enable-twitter-login') == 'true')
                            <a href="#login" class="btn btn-neutral btn-twitter btn-icon btn-lg  btn-round">
                                <i class="fa fa-twitter"></i>
                            </a>
                            @endif
                            @if(setting('auth.enable-facebook-login') == 'true')
                            <a href="#login" class="btn btn-neutral btn-facebook btn-icon btn-lg  btn-round">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            @endif
                            @if(setting('auth.enable-google-login') == 'true')
                            <a href="#login" class="btn btn-neutral btn-google btn-icon btn-lg  btn-round">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group{{ $errors->has('email') ? ' has-error' : '' }}" align="center">
                            @if ($errors->has('email'))
                                <div class="help-block" style="width:100% !important;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                            @if ($errors->has('password'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                            <div class="input-group ">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Email..." name="email"
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="input-group ">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-lock"></i>
                                </span>
                                <input type="password" placeholder="Password..." class="form-control" required
                                       name="password">
                            </div>
                                <?php if (Request::path() == "app/login") { ?>
                                <input type="hidden" name="redirect" value="/app"/>
                                <?php } ?>
                            <?php
/*
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-check" style="margin-top:15px;">
                                        <div class="checkbox" align="center">
                                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
                                            <label for="remember" style="color:#fff;">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            */
?>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button class="btn btn-success btn-pill btn-lg mb-3" id="signin">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div align="center" style="margin-top:15px;">
        <a href="/register" class="btn btn-outline-primary">
            Need to create
            an account?
        </a>
        <a href="/" class="btn btn-outline-secondary hiddenOnDesktop">
            @if(setting('site.name') !== null)
            Back to {{setting('site.name')}}
            @else
            Back to <i class="fa fa-fw fa-home"></i>
            @endif
        </a>
        @if(setting('auth.tos-link') !== null)
        <a href="{{setting('auth.tos-link')}}" target="_blank" class="btn btn-link">Terms of Service</a>
        @endif
    </div>
</div>
@endsection
