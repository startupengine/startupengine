@extends('layouts.shards_frontend')

@section('php-variables')
    <?php
    $viewOptions['navbar-classes'] = ['dark'];
    $viewOptions['navbar-scroll-add-classes'] = ['dark'];
    $viewOptions['navbar-unscroll-remove-classes'] = [];
    ?>
@endsection

@section('title')
    Verify E-Mail
@endsection

@section('splash-class')
    minimal
@endsection

@section('content')
    <div class="section section-invert" style="border:none !important;min-height:calc(100% - 130px);">

    <div class="container pt-4 blog">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center" style="min-height:auto !important;">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body" >
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a
                                href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection