@extends('layouts.shards_admin')

@section('title') CTAs - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        td {
            line-height: 28px;
            vertical-align: middle;
        }

        nav li.page-item {
            box-shadow: none !important;
            border: 1px solid #ddd;
            border-right: 0px;
        }

        nav li.page-item:last-of-type {
            border-right: 1px solid #ddd;
        }

        nav li.page-item.active a {
            background: #555 !important;
        }

        nav li.page-item.active {
            border-color: #555;
        }

        nav li.page-item:hover a {
            color: #000 !important;
        }

        nav li.page-item.active:hover a {
            color: #fff !important;
        }

        .page-item a {
            color: #888;
        }

        table .badge-pill {
            min-width: 80px;
        }

        .actionButton {
            width: 120px !important;
        }

        .postTypeSelector {
            background: rgba(126, 186, 255, 0.1);
            border-left: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            padding: 15px 0px;
            transition: all 0.5s;
        }

        .postTypeSelector:hover {
            background: rgba(95, 114, 255, 0.1);
            border-left: 2px solid #333;
            cursor: pointer;
        }

        .postTypeSelector:last-of-type {
            margin-bottom: 0px !important;
        }

        .modal-header .close {
            padding: 1.25rem 5px;
            margin: -1rem -1rem -1rem auto;
        }

        .modal-footer {
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 25px;
            padding-left: 25px;
        }

        .card .postTag {
            display:none;
        }

        .card .postTag:first-of-type {
            display:inline-flex;
        }

        .modal .input-group-text {
            min-width:130px;
        }

        .badge-light {
            max-width:300px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display:inline;
            border:1px solid #efefef;
        }

        .badge-outline-light{
            border-color:#ddd;
        }

        .badge-occurrence {
            min-width:100px;
        }
        .badge-type {
            min-width:60px !important;
            background:#eee;
            border:1px solid #eee;
        }

        .badge-danger-level-1 {
            background: #ffd2ca;
            color:white !important;
        }
        .badge-danger-level-2 {
            background: #ff9463;
            color:white !important;
        }
        .badge-danger-level-3 {
            background:red;
            color:white !important;
        }

        .thumbnail {
            width:50px;
            height:25px;
            border-radius:4px;
            background-color:#eee;
            display:inline-block;
            background-size:cover;
            background-position:center;
            float:left;
            margin-top:3px;
        }


    </style>
@endsection

@section('head')

@endsection

@section('page-title') Promos @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 pull-right pageNav" align="right">
        {!! renderDisplayFormatButton() !!}
        {!! renderFilterButton() !!}
        <div class="btn-group mb-1">
        <a href="#" class="btn btn-primary actionButton ml-1" data-toggle="modal" v-if="info != null"
           onclick="newItemApp.newItem({'callback': contentApp.updateData, 'type':'promo'});$('#newItemModal').modal('show');"
           style="width:auto !important;padding-top:10px;float:right;"><i class="fa fa-plus"></i> &nbsp;New Item</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" v-if="info != null">
    <?php $header = '<div class="btn-group">

                            <span class="btn btn-light btn-sm border px-2" v-bind:class="{ active: filters.status==\'status=DRAFT\'}"  v-on:click="updateFilters({\'status\':\'status=DRAFT\'})">
                                <span>Drafts</span>
                            </span>
                            <span class="btn btn-light btn-sm border px-2" v-bind:class="{ active: filters.status==\'status=PENDING\'}"  v-on:click="updateFilters({\'status\':\'status=PENDING\'})">
                                <span>Pending</span>
                            </span>
                            <span class="btn btn-light btn-sm border px-2" v-bind:class="{ active: filters.status==\'status=PUBLISHED\'}"   v-on:click="updateFilters({\'status\':\'status=PUBLISHED\'})">
                                <span>Published</span>
                            </span>
                            <span class="btn btn-light btn-sm border px-2"  v-bind:class="{ active: filters.status==\'status=UNPUBLISHED\'}" v-on:click="updateFilters({\'status\':\'status=UNPUBLISHED\'})">
                                <span>Unpublished</span>
                            </span>
                        </div>'; ?>
        <?php $tableHeader = '<th scope="col" class="border-0" style="width:50px !important;text-align:left;">Image</th><th scope="col" class="border-0 hiddenOnMobile" style="width:100px !important;text-align:left;">Status</th><th scope="col" class="border-0 " style="text-align:left;">Title</th><th scope="col" class="border-0">&nbsp;</th>'; ?>
        <?php $tableRow = '<td align="left" style="width:30px;"><span class="thumbnail" v-if="item.thumbnail != null" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span><span class="thumbnail" v-else></span></td><td align="left" style="width:100px;" class="hiddenOnMobile"><span class="badge badge-type text-dark mr-2" style="width:100%;" >{{ item.status }}</span></td><td style="width:auto;" align="left"><span class="badge text-dark mr-2 px-0 truncate-100 text-left">{{ item.name }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/promos/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
        <?php $cardHtml = '<div class="mt-2" align="left"><span class="badge badge-type text-dark text-uppercase"><span class="dimmed mr-1">Type:</span>{{ item.schema.title }}</span><br><span class="badge badge-type text-dark mt-1 text-uppercase"><span class="dimmed mr-1">Status:</span>{{ item.status }}</span></div>'; ?>
        <?php $cardFooter = '
             <div align="center">
                <div class="btn-group mb-2" role="group" aria-label="Table row actions">
                    <a href="" class="btn btn-outline-primary btn-pill"
                       v-bind:href="\'/admin/promos/\' + item.id">
            Edit<i class="fa fa-edit ml-2" style="-webkit-text-stroke: 0px #000;font-size:8px;top:-2px;position:relative;"></i>
            </a>
            <a href="" target="_blank" class="btn btn-outline-primary btn-pill"
                       v-bind:href="\'/promos/\' + item.id + \'/\' + item.slug">
            View<i class="fa fa-chevron-right ml-2" style="-webkit-text-stroke: 0px #000;font-size:8px;top:-1px;position:relative;"></i>
            </a>
        </div>
        </div>
        '; ?>

        {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/promos', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_BODY_HTML' => $cardHtml, 'CARD_FOOTER' => $cardFooter]) !!}

        <!-- New Product Form Modal -->
        <div class="modal fade" id="modal-new-content-title" tabindex="-1" role="dialog" >
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="width:100%;">
                            New Product
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Create Product Form -->
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label style="margin-bottom:2rem!important;">Name this content.</label>
                                <div class="input-group">
                                    <input name="name" v-model="itemName" class="form-control" autocomplete="off" placeholder="i.e., Iterating Grace" />
                                </div>
                            </div>
                            <br class="mb-2 pb-2"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-danger" data-toggle="modal"
                             data-target="#modal-new-product">Cancel</div>
                        <div class="btn btn-success" v-on:click="save()" data-dismiss="modal">Save New Content</div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $options = [
                'display_formats' => ['list', 'cards'],
                'per_page_options' => [10, 25, 100],
                'sort_fields'=>['Date Created' => 'created_at', 'Name' => 'name'],
                'created_fields' => ['24 hours' => '24 hours', 'week' => '7 days', 'month' => '30 days', 'year' => '365 days'],
                'filters' => [
                    'Status' => ['label' => 'status', 'options' =>
                        ['Any' => '', 'Pending' => 'status=PENDING', 'Published' => 'status=PUBLISHED', 'Unpublished' => 'status=UNPUBLISHED']
                    ]
                ]
            ]
        ?>
        {!! renderResourceFilterModal($options) !!}
    </div>

@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => URL::to('/').'/api/resources/promo', 'FILTERS' => "{status: 'status=PUBLISHED'}", 'VUE_APP_NAME' => 'contentApp', 'LIMIT' => 1000]) !!}
@endsection