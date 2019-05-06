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
    </style>
@endsection

@section('head')
@endsection

@section('page-title') System Logs @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 pull-right pageNav" align="right">
        {!! renderFilterButton() !!}
    </div>
@endsection

@section('content')
    <div class="row" id="contentApp" v-if="info != null">
        <?php $header = '<div class="btn-group">
                            <span class="btn btn-light border text-dark" style="opacity:0.5;" v-on:click="reset({\'filters\':true})">
                                 <span class="hiddenOnMobile">Showing</span>
                                 <span class=""><i class="material-icons mx-0 mb-1">visibility</i></span>
                            </span>
                            <span class="btn btn-light border text-dark" v-bind:class="{ active: filters.type==\'type=exception\'}"   v-on:click="updateFilters({\'type\':\'type=exception\'})">
                                <span class="hiddenOnMobile">Exceptions</span>
                                <span class="hiddenOnDesktop"><i class="material-icons">warning</i></span>
                            </span>
                            <span class="btn btn-light border text-dark" v-bind:class="{ active: filters.type==\'type=request\'}"  v-on:click="updateFilters({\'type\':\'type=request\'})">
                                <span class="hiddenOnMobile">Requests</span>
                                <span class="hiddenOnDesktop"><i class="material-icons">compare_arrows</i></span>
                            </span>
                            <span class="btn btn-light border text-dark" v-bind:class="{ active: filters.type==\'type=query\'}"  v-on:click="updateFilters({\'type\':\'type=query\'})">
                                <span class="hiddenOnMobile">Queries</span>
                                <span class="hiddenOnDesktop"><i class="material-icons">dns</i></span>
                            </span>
                            <span class="btn btn-light border text-dark" v-bind:class="{ active: filters.type==\'type=cache\'}"  v-on:click="updateFilters({\'type\':\'type=cache\'})">
                                <span class="hiddenOnMobile">Cached Responses</span>
                                <span class="hiddenOnDesktop"><i class="material-icons">cached</i></span>
                            </span>
                            <span class="btn btn-light border text-dark" v-bind:class="{ active: filters.type==\'type=event\'}"  v-on:click="updateFilters({\'type\':\'type=event\'})">
                                <span class="hiddenOnMobile">Events</span>
                                <span class="hiddenOnDesktop"><i class="material-icons">assignment_turned_in</i></span>
                            </span>
                        </div>'; ?>
        <?php $tableHeader = '<th scope="col" class="border-0" style="width:auto !important;text-align:left;">Item</th><th scope="col" class="border-0 h" style="width:50px;text-align:center;">&nbsp;</th>'; ?>
        <?php $tableRow = '<td align="left"><span class="badge badge-type text-dark mr-2">{{ item.type }}</span>
                                <span v-if="item.occurrences < 10" class="badge badge-danger-level-1 badge-occurrence text-dark mr-2">{{ item.occurrences + 1 }} Occurrences</span>
                                <span v-else-if="item.occurrences > 10 && item.occurrences < 100 " class="badge badge-danger-level-2 badge-occurrence text-dark mr-2">{{ item.occurrences + 1}} Occurrences</span>
                                <span v-else-if="item.occurrences > 100" class="badge badge-danger-level-3 badge-occurrence text-dark mr-2">{{ item.occurrences + 1}} Occurrences</span>
                                <span class="badge text-dark mr-2 px-0 truncate">{{ item.description }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/logs/\' + item.uuid" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
        {!! renderResourceTableHtml(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/logs/']) !!}
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
                'sort_fields'=>['Date Created' => 'created_at', 'Sequence ID' => 'sequence'],
                'created_fields' => ['24 hours' => '24 hours', 'week' => '7 days', 'month' => '30 days'],
                'filters' => [
                    'Type' => ['label' => 'type', 'options' =>
                        ['Any' => '', 'Exception' => 'type=exception', 'Request' => 'type=request', 'Query' => 'type=query', 'Cached Response' => 'type=cache', 'Event' => 'type=event']
                    ]
                ]
            ]
        ?>
        {!! renderResourceFilterModal($options) !!}

    </div>

@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/log', 'FILTERS' => "{type: 'type=exception'}", "LIMIT" => 50, "PER_PAGE" => 5]) !!}
@endsection