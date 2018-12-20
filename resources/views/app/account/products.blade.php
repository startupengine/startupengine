@extends('layouts.shards_frontend')

@section('php-variables')
    <?php $viewOptions['splash-height'] = '300px'; ?>
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

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js"></script>

    <style>
        #contentForm .col-lg-9 {
            min-width: 100% !important;
        }
    </style>
@endsection

@section('navbar-classes')
    dark
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
                <div class="pt-0 mb-3 col-md-9" id="contentApp" v-if="info != null">
                    <?php $nowString = \Carbon\Carbon::now()->toDateString(); ?>
                    <?php $header = '
                        <h6 class="mb-0">Products</h6>'; ?>
                    <?php $tableHeader = '
                        <div class="text-center py-3  bg-very-light border-top">
                        <div class="input-group input-group-sm px-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text bg-white"><i class="fa fa-fw fa-search text-primary"></i></span>
                        </div>
                        <input class="form-control formFilter" id="s" name="s" autocomplete="off" placeholder="Search for products by name..." v-model="search" @change="updateSearch(search)" />
                        </div>
                    ';?>
                    <?php $tableRow = '<td align="left" class="text-capitalize align-middle"><span class="pl-2">{{ item.name }}</span><span class="badge badge-light text-dark hiddenOnMobile ml-2"></td><td align="center"  style="width:auto;vertical-align:middle;text-align:right;"><a href="#"  v-bind:href="\'/app/subscriptions/view?subscription_id=\' + item.id" v-on:click="manageSubscription(item.id)"  class="btn btn-sm btn-white btn-pill px-3 mr-2 d-none">Edit</a><a href="#" class="btn btn-white btn-sm btn-pill mr-2"   v-for="transformation in item.transformations"  v-on:click="transform(item.id, transformation)" :class="{[\'action-\'+transformation.slug]:true}" >{{ transformation.label }}</a></td>'; ?>
                    <?php $cardHtml = '<div class="mt-2" align="left"><span class="badge badge-type text-dark text-uppercase"><span class="dimmed mr-1">Type:</span>{{ item.schema.title }}</span><br><span class="badge badge-type text-dark mt-1 text-uppercase"><span class="dimmed mr-1">Status:</span>{{ item.status }}</span></div>'; ?>
                    <?php $cardFooter = '
             <div align="center">
                <div class="btn-group mb-2" role="group" aria-label="Table row actions">
                    <a href="" class="btn btn-outline-primary btn-pill"
                       v-bind:href="\'/admin/content/\' + item.id">
            Edit<i class="fa fa-edit ml-2" style="-webkit-text-stroke: 0px #000;font-size:8px;top:-2px;position:relative;"></i>
            </a>
            <a href="" target="_blank" class="btn btn-outline-primary btn-pill"
                       v-bind:href="\'/content/\' + item.id + \'/\' + item.slug">
            View<i class="fa fa-chevron-right ml-2" style="-webkit-text-stroke: 0px #000;font-size:8px;top:-1px;position:relative;"></i>
            </a>
        </div>
        </div>
        '; ?>
                    {!! renderResourceTableHtmlDynamically(['HEADER' => $header,  'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/product', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_BODY_HTML' => $cardHtml, 'CARD_FOOTER' => $cardFooter, 'WRAPPER_CLASS' => '']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')


    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME' => 'subscriptionsApp', 'url' => '/api/resources/product', 'FILTERS' => "{'user_id':'user_id=".\Auth::user()->id."',    'status':'ends_at>=".$nowString."'}"]) !!}
@endsection