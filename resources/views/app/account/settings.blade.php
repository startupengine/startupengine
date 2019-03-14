@extends('layouts.shards_frontend')

@section('php-variables')
    <?php
    $viewOptions['navbar-classes'] = ['navbar-light', 'navbar-blend-light-blue'];
    $viewOptions['navbar-scroll-add-classes'] = ['navbar-dark', 'dark'];
    $viewOptions['navbar-unscroll-remove-classes'] = ['navbar-dark', 'dark'];
    ?>
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
            background: url('{{ \Auth::user()->avatar() }}');
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

        .card-footer {
            border-top: 1px solid #eee !important;
        }

        .action-cancel {
            border-color:#dc3545 !important;
            color:#dc3545 !important;
        }

        #contentForm .col-lg-9 {
            min-width: 100% !important;
        }

        .shards-landing-page--1 .welcome:before {
            background-color:#e9f0ff!important;
            opacity:1 !important;
            color:#333 !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js"></script>

@endsection

@section('navbar-classes')
    navbar-light navbar-blend-light-blue
@endsection

@section('splash-class')
    minimal
@endsection


@section('content')
    <!-- Related Content Section -->
    <div class="blog section section-invert pt-4 pb-0 full-screen-section">
        <h4 class="section-title text-center mb-5 mt-3">My Account</h4>

        <div class="container">
            <div class="row pt-2">
                <div class="pt-0 mb-3 col-md-3 pull-left">
                    @include('app.account.partials.nav')
                </div>
                <div class="pt-0 mb-3 col-md-9" id="settingsApp" v-if="info != null">
                    <?php $nowString = \Carbon\Carbon::now()->toDateString(); ?>
                    <?php $header = '
                        <h6 class="mb-0">Your Preferences</h6>'; ?>
                    <?php $tableHeader = '';?>
                    <?php $tableRow = '<td align="left" class="text-capitalize align-middle"><span class="pl-2">{{ item.description }}</span><span class="badge badge-light text-dark hiddenOnMobile ml-2"></td><td align="left" class="text-capitalize align-middle" style="width:50px;"><a :href="\'/app/settings/view?userpreference_id=\'+ item.id" class="btn btn-white btn-pill btn-sm">Edit</a></td>'; ?>

                    {!! renderResourceTableHtmlDynamically(['HEADER' => $header,  'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/setting', 'WRAPPER_CLASS' => '']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME' => 'settingsApp', 'div_id' => "settingsApp", 'url' => '/api/resources/userpreference', 'FILTERS' => "{'user_id':'user_id=".\Auth::user()->id."',    'status':'ends_at>=".$nowString."'}"]) !!}
@endsection