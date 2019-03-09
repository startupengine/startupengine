@extends('layouts.shards_admin')

@section('title') Logs - <?php echo setting('site.title'); ?> @endsection

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

        .truncate {
            width: 300px;
            white-space: nowrap;
            display:inline-flex;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align:left;
        }
        @media(max-width:768px){
            .truncate {
                width: 150px;
            }
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

@section('page-title') Settings @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 pull-right pageNav d-none" align="right">
        {!! renderFilterButton() !!}
    </div>
@endsection

@section('content')
    <div class="row" v-if="info != null">
    <?php $header = 'A list of settings grouped by type.'; ?>
        <?php $tableHeader = '<th scope="col" class="border-0 h hiddenOnMobile" style="width:100px;text-align:left;">Group</th><th scope="col" class="border-0" style="text-align:left;">Description</th><th scope="col" class="border-0 h" style="width:25px;text-align:center;">&nbsp;</th>'; ?>
        <?php $tableRow = '<td align="left" class="hiddenOnMobile" style="width:100px;"><span class="badge badge-type text-dark mr-2" style="width:100%;" v-if="item.group != null">{{ item.group }}</span></td><td align="left"><span class="badge text-dark mr-1 px-0">{{ item.value }}</span> <span class="badge text-dark mr-2 px-0 dimmed hiddenOnMobile">({{ item.items }} Items)</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/settings/group/\' + item.group" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
        {!! renderResourceTableHtml(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/products/']) !!}
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
                'display_formats' => ['list'],
                'per_page_options' => [10, 25, 100],
                'sort_fields'=>['Date Updated' => 'updated_at','Date Created' => 'created_at', 'Name' => 'name'],
                'created_fields' => ['24 hours' => '24 hours', 'week' => '7 days', 'month' => '30 days', 'year' => '365 days'],
                'filters' => [
                    'Type' => ['label' => 'type', 'options' =>
                        ['Any' => '', 'Physical Goods' => 'json->sections->about->fields->type=Physical%20Product', 'Software Subscriptions' => 'json->sections->about->fields->type=Software%20Subscription', 'Content Subscriptions' => 'json->sections->about->fields->type=Software%20Subscription']
                    ]
                ]
            ]
        ?>
        {!! renderResourceFilterModal($options) !!}
    </div>

@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' =>  URL::to('/').'/api/resources/settingsgroup']) !!}
@endsection