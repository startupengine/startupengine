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
            padding-right: 20px !important;
            background: rgba(0, 0, 0, 0.3) !important;
        }

        input {
            -webkit-text-fill-color: #333 !important;
            -webkit-box-shadow: 0 0 0 30px white inset !important;
        }

        .help-block {
            color: #fff !important;
            text-align: center;
            margin-bottom: 15px;
            max-width: 75%;
            margin-top: -25px;
        }

        .shadowed {
            -webkit-filter: drop-shadow(0px 6px 3px rgba(15, 15, 150, 0.15)) !important;
            filter: url(#drop-shadow);
            -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=6, Color='#444')";
            filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=6, Color='#444')";
        }

        @media (max-width: 991px) {
            .row {
                margin-top: 25px !important;
                margin-left: 10px;
                margin-right: 10px;
            }
        }

        .btn-icon:hover, #signin:hover {
            transform: scale(1.1); /* Equal to scaleX(0.7) scaleY(0.7) */
        }

        .input-group input {
            border-radius: 0px 4px 4px 0px;
        }

        .input-group-addon {
            border-radius: 4px 0px 0px 4px;
        }
    </style>

@endsection


@section('content')
    <body class="index-page sidebar-collapse bg-gradient-light" style="height:100vh;">
    <div class="container">
        <div class="row" style="margin-top:5%;">

            <div class="card card-signup bg-gradient">

                {{ csrf_field() }}
                <div class="header text-center">
                    @if(setting('site.logo') !== null)
                        <div align="center" style="width:100%;">
                            <img src="{{ setting('site.logo') }}" style="max-height:70px;margin-bottom:15px;"
                                 class="shadowed"/>
                        </div>
                    @endif
                    <h4 style="font-weight:600 !important;" class="title title-up">Error 404</h4><h4>Page Not Found</h4>
                </div>


            </div>
        </div>
    </div>
    <div align="center" style="margin-top:15px;">
        <a href="/" class="btn btn-link">
            @if(setting('site.name') !== null)
                Back to {{setting('site.name')}}
            @else
                Back to {{ config('app.url') }}
            @endif
        </a>
        @if(!\Auth::user())
            <a href="/login" class="btn btn-link">Sign In</a>
        @endif
    </div>
    </body>
@endsection
