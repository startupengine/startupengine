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

        .card-header{
            background:#fff !important;
        }

        .card{
            height:auto !important;
            min-height:auto !important;
        }

        .card-footer {
            border-top:1px solid #eee !important;
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
    <div class="blog section section-invert pt-4 pb-0" style="min-height:100vh;">
        <h3 class="section-title text-center mb-5 mt-3">My Account</h3>

        <div class="container">
            <div class="row pt-2">
                <div class="pt-0 mb-3 col-md-3 pull-left">
                    @include('app.account.partials.nav')
                </div>
                <div class="pt-0 mb-3 col-md-9" id="contentApp">
                    <?php $nowString = \Carbon\Carbon::now()->toDateString(); ?>
                    <?php $header = '<div class="btn-group">
                            <span class="btn btn-light border text-dark hiddenOnMobile" style="opacity:0.5;" v-bind:class="{ active: filters.type == \'\'}" v-on:click="reset({\'filters\':true})">
                                 <span class="hiddenOnMobile">Showing</span>
                                 <span class=""><i class="material-icons mx-0 mb-1">visibility</i></span>
                            </span>
                            <span class="btn btn-light border" v-bind:class="{ active: filters.status==\'trial_ends_at>='.$nowString.'\'}"  v-on:click="updateFilters({\'status\':\'trial_ends_at>='.$nowString.'\'})">
                                <span>Trialing</span>
                            </span>
                            <span class="btn btn-light border"  v-bind:class="{ active: filters.status==\'ends_at>='.$nowString.'\'}"  v-on:click="updateFilters({\'status\':\'ends_at>='.$nowString.'\'})">
                                <span>Active</span>
                            </span>
                            <span class="btn btn-light border"  v-bind:class="{ active: filters.status==\'ends_at<='.$nowString.'\'}"  v-on:click="updateFilters({\'status\':\'ends_at<='.$nowString.'\'})">
                                <span>Expired</span>
                            </span>
                        </div>'; ?>
                    <?php $tableRow = '<td align="left pl-3" class="text-capitalize">{{ item.name }}</td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-on:click="manageSubscription(item.id)"  class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
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
                    {!! renderResourceTableHtmlDynamically(['HEADER' => $header,  'TABLE_ROW' => $tableRow, 'PATH' => '/admin/content', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_BODY_HTML' => $cardHtml, 'CARD_FOOTER' => $cardFooter, 'WRAPPER_CLASS' => '']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/subscription', 'FILTERS' => "{'user_id':'user_id=".\Auth::user()->id."'}"]) !!}
@endsection