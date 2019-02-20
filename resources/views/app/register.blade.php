@extends('layouts.shards_frontend')

@section('php-variables')
    <?php
    $viewOptions['navbar-classes'] = ['dark'];
    $viewOptions['navbar-scroll-add-classes'] = ['dark'];
    $viewOptions['navbar-unscroll-remove-classes'] = [];
    ?>
@endsection

@section('title')
    Sign Up
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
                <div class="card col-md-4 mx-auto mb-4 p-4 toggleVisibility" v-if="status !== 'loading'"  v-bind:class="{ visible: status !== 'loading', 'd-block': status !== 'loading' }">
                    <form class="form-horizontal"
                          v-on:submit.prevent <?php /* method="POST" action="{{ route('login') }}" */ ?>>
                        {{ csrf_field() }}
                        <div class="card-header border-bottom text-center" v-if="info.status != 'success'">
                            @if(setting('site.logo') !== null)
                                <div>
                                    <img src="{{ setting('site.logo') }}" style="max-height:70px;margin-bottom:15px;"
                                         class="shadowed"/>
                                </div>
                            @endif
                            <h4 class="title title-up mb-1">Sign Up</h4>
                            <h6 class="mb-4">Enter your details below.</h6>
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
                        <div class="card-body" v-if="info != null">
                            <div v-if="info.status == 'success'">
                                <p class="card-text"><i class="fa fa-fw fa-lg fa-envelope text-light pb-3
    "></i><br><strong class="d-inline-block text-primary pb-3">Almost finished...</strong> <span class="d-inline-block">We just need to confirm your e-mail address. Check your e-mail for a link to complete your registration.</span>
                                </p>
                            </div>
                            <div v-else class="form-group form-group{{ $errors->has('email') ? ' has-error' : '' }}"
                                 align="center">
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
                                <span class="input-group-addon" v-bind:class="{ 'input-group-addon-danger': (info != null && info.status == 'error' && info.meta.fields.name.valid == false) }">
                                    <i class="fa fa-fw fa-user text-danger" v-if="info != null && info.status == 'error' && info.meta.fields.name.valid == false" ></i>
                                    <i class="fa fa-fw fa-user" v-else></i>
                                </span>
                                    <input v-model="newItemInput.name" v-on:input="changed()" type="text"
                                           class="form-control" placeholder="Name..." name="name"
                                           value="{{ old('name') }}" required autofocus>
                                </div>
                                <p v-if="info != null && info.status == 'error' && info.meta.fields.name.hasOwnProperty('first_error')" class="text-danger text-left mt-0 mb-3">@{{ info.meta.fields.name.first_error }}</p>
                                <div class="input-group ">
                                <span class="input-group-addon"  v-bind:class="{ 'input-group-addon-danger': (info != null && info.status == 'error' && info.meta.fields.email.valid == false) }">
                                    <i class="fa fa-fw fa-envelope text-danger" v-if="info != null && info.status == 'error' && info.meta.fields.email.valid == false" ></i>
                                    <i class="fa fa-fw fa-envelope" v-else></i>
                                </span>
                                    <input v-model="newItemInput.email" v-on:input="changed()" type="text"
                                           class="form-control" placeholder="Email..." name="email"
                                           value="{{ old('email') }}" required>
                                </div>
                                <p v-if="info != null && info.status == 'error' && info.meta.fields.email.hasOwnProperty('first_error')" class="text-danger text-left mt-0 mb-3">@{{ info.meta.fields.email.first_error}}</p>
                                <div class="input-group ">
                                <span class="input-group-addon"  v-bind:class="{ 'input-group-addon-danger': (info != null && info.status == 'error' && info.meta.fields.password.valid == false) }">
                                    <i class="fa fa-fw fa-lock text-danger" v-if="info != null && info.status == 'error' && info.meta.fields.password.valid == false" ></i>
                                    <i class="fa fa-fw fa-lock" v-else></i>
                                </span>
                                    <input v-model="newItemInput.password" v-on:input="changed()" type="password"
                                           placeholder="Password..." class="form-control" required
                                           name="password">
                                </div>
                                <p v-if="info != null && info.status == 'error' && info.meta.fields.password.hasOwnProperty('first_error')" class="text-danger text-left mt-0 mb-3">@{{ info.meta.fields.password.first_error }}</p>
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
                        <div class="footer text-center" v-if="info.status != 'success'">
                            <button @click="newItem({'type': 'user'})" class="btn btn-success btn-pill btn-lg mb-3" id="signin">Create
                                Account
                            </button>
                        </div>
                    </form>
                </div>
                <div v-else class="p-4 w-100" align="center">
                    Loading...
                </div>
            </div>
        </div>
        <div align="center" style="margin-top:15px;">
            <a href="/login" class="btn btn-outline-primary">
                Already have an account?
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

@section('scripts')
    {!! renderNewUserScripts() !!}
@endsection