@extends('layouts.app')

@section('title')
    Login
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .card-header {
            width: 100% !important;
            min-width: 100% !important;
            position: relative !important;
            left: 0px !important;
            top: 0px !important;
        }

        .card {
            background: #fff !important;
        }

        #gradient {
            display: none;
        }

        .card-signup {
            /*background: orangered !important;*/
            background: linear-gradient(45deg, #9360ff, #4286ff) !important;
        }

        .card-signup .card-body i, .card-signup h4 {
            color: #fff !important;
        }

        #signin {
            color: #444 !important;
        }

        .bg-gradient-light {
            background: linear-gradient(-45deg, rgba(255, 235, 225, 0.71), #e7ecff);
        }

        .checkbox label::before, .checkbox label::after {
            background: #fff;
        }

        .input-group-addon {
            padding-right: 13px !important;
            background: rgba(0, 0, 0, 0.3) !important;
        }

        input {
            -webkit-text-fill-color: #333 !important;
            -webkit-box-shadow: 0 0 0 30px white inset !important;
        }

        .help-block {
            color:#fff !important;
            text-align: center;
            margin-bottom:15px;
        }

        .shadowed {
            -webkit-filter: drop-shadow(0px 6px 3px rgba(15,15,150,0.15)) !important;
            filter: url(#drop-shadow);
            -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=6, Color='#444')";
            filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=6, Color='#444')";
        }
        @media(max-width: 991px) {
            .row{
                margin-top:25px !important;
            }
        }
    </style>

@endsection


@section('content')
    <body class="index-page sidebar-collapse bg-gradient-light" style="height:100vh;">
    <div class="container" style="margin-top:15px;">
        <div class="row" style="margin-top:10%;">
            <div class="card card-signup bg-gradient">
                <form class="form-horizontal " method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="header text-center">
                        @if(setting('site.logo') !== null)
                            <div>
                                <img src="{{ setting('site.logo') }}" style="max-height:70px;margin-bottom:25px;" class="shadowed"/>
                            </div>
                        @endif
                        <h4 class="title title-up">Sign In</h4>
                        <div class="social-line">
                            @if(setting('auth.enable-twitter-login') == 'true')
                            <a href="#pablo" class="btn btn-neutral btn-twitter btn-icon btn-lg  btn-round">
                                <i class="fa fa-twitter"></i>
                            </a>
                            @endif
                            @if(setting('auth.enable-facebook-login') == 'true')
                            <a href="#pablo" class="btn btn-neutral btn-facebook btn-icon btn-lg  btn-round">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            @endif
                            @if(setting('auth.enable-google-login') == 'true')
                            <a href="#pablo" class="btn btn-neutral btn-google btn-icon btn-lg  btn-round">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
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
                            <div class="input-group form-group-no-border">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_email-85"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Email..." name="email"
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="input-group form-group-no-border">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_lock-circle-open"></i>
                                </span>
                                <input type="password" placeholder="Password..." class="form-control" required
                                       name="password">
                            </div>
                                <?php if(Request::path() == "app/login") {  ?>
                                <input type="hidden" name="redirect" value="/app"/>
                                <?php } ?>
                            <?php /*
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
                            */?>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button class="btn btn-neutral btn-round btn-lg" id="signin">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div align="center" style="margin-top:15px;">
        <a href="/" class="btn btn-link">Back to {{setting('site.name')}}.</a>
        @if(setting('auth.tos-link') !== null)
        <a href="{{setting('auth.tos-link')}}" target="_blank" class="btn btn-link">Terms of Service</a>
        @endif
    </div>
    </body>
@endsection
