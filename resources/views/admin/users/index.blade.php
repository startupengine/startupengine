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

        .avatar {
            width:30px;
            height:30px;
            border-radius:15px;
            display:inline-block;
            background-size:cover;
            background-position:center;
            float:left;
        }
    </style>
@endsection

@section('head')
@endsection

@section('page-title') Users @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 pull-right pageNav" align="right">
        {!! renderFilterButton() !!}
    </div>
@endsection

@section('content')
    <div class="row" v-if="info != null && info.data != null">
    <?php $header = '<div class="btn-group">
                            <span class="btn btn-light border text-dark" style="opacity:0.5;" v-bind:class="{ active: filters.type == \'\'}" v-on:click="reset({\'filters\':true})">
                                 <span class="hiddenOnMobile">Showing</span>
                                 <span class=""><i class="material-icons mx-1 mb-1">visibility</i></span>
                            </span>
                            <span class="btn btn-light border" v-bind:class="{ active: filters.type==\'status=ACTIVE\'}"   v-on:click="updateFilters({\'type\':\'status=ACTIVE\'})">
                                <span>Active</span>
                            </span>
                            <span class="btn btn-light border"  v-bind:class="{ active: filters.type==\'status=INACTIVE\'}" v-on:click="updateFilters({\'type\':\'status=INACTIVE\'})">
                                <span>Inactive</span>
                            </span>
                        </div>'; ?>
        <?php $tableHeader =
            '<th scope="col" class="border-0" style="width:30px !important;text-align:left;">&nbsp;</th><th scope="col" class="border-0 hiddenOnMobile" style="width:100px !important;text-align:left;">Status</th><th scope="col" class="border-0 h hiddenOnMobile" style="max-width:100px;text-align:left;">Name</th><th scope="col" class="border-0 h" style="text-align:left;">E-mail</th><th scope="col" class="border-0" style="width:50px;text-align:center;">&nbsp;</th>'; ?>
        <?php $tableRow =
            '<td align="left" style="width:30px;"><div class="avatar" v-if="item.avatar != null" v-bind:style="{ backgroundImage: \'url(\' + item.avatar + \')\' }"></div><div class="avatar" v-else></div></td><td align="left" style="width:100px;" class="hiddenOnMobile"><span class="badge badge-type text-dark mr-2" style="width:100%;">{{ item.status }}</span></td><td align="left" class="hiddenOnMobile" style="width:100px;"><span class="badge text-dark hiddenOnMobile px-0" v-if="item.name != null">{{ item.name }}</span></td><td align="left"><span class="badge text-dark mr-2 px-0 ">{{ item.email }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/users/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
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

        <?php $options = [
            'display_formats' => ['list'],
            'per_page_options' => [10, 25, 100],
            'sort_fields' => ['Date Created' => 'created_at', 'Name' => 'name'],
            'created_fields' => [
                '24 hours' => '24 hours',
                'week' => '7 days',
                'month' => '30 days',
                'year' => '365 days'
            ],
            'filters' => [
                'Status' => [
                    'label' => 'status',
                    'options' => [
                        'Any' => '',
                        'Active' => 'status=ACTIVE',
                        'Inactive' => 'status=INACTIVE'
                    ]
                ]
            ]
        ]; ?>
        {!! renderResourceFilterModal($options) !!}
    </div>

@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' =>  URL::to('/').'/api/resources/user', 'LIMIT' => 1000]) !!}
@endsection