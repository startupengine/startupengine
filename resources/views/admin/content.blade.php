@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

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
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Content @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 pull-right pageNav" align="right">


        <a href="#" class="btn btn-outline-primary pull-right ml-2 actionButton" data-toggle="modal"
           data-target="#modal-new-content" style="padding-top:10px;float:right;"><i class="fa fa-plus-circle"></i> &nbsp;New
            Item</a>
            <a href="#" class="btn btn-secondary pull-right ml-2 actionButton" data-toggle="modal"
               data-target="#modal-filter-content" style="width:auto !important;padding-top:10px;float:right;"><i class="fa fa-filter"></i> &nbsp;Filter Results</a>




    </div>
@endsection

@section('content')
    <div class="row" id="contentApp" v-if="info != null">
        <div class="col" v-if="info != null & info.data != null" style="opacity:0;" v-bind:style="{ 'opacity': '1' }">
            <div class="card card-small mb-4" id="listView">
                <div class="card-header border-bottom" align="left">
                    <strong class="text-dark">
                        List View
                    </strong>
                </div>
                <div class="card-body p-0 pb-0 text-center">
                    <table class="table mb-0" >
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0" style="min-width:150px !important;text-align:left;">Title</th>
                            <th scope="col" class="border-0 d-none d-md-block" style="text-align:left;">Description</th>
                            <th scope="col" class="border-0 hiddenOnMobile" style="text-align:center;">Status</th>
                            <th scope="col" class="border-0 d-none d-md-block" style="text-align:center;">Last Updated</th>
                            <th scope="col" class="border-0" style="width:50px;text-align:center;">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="dataRow" v-for="item in info.data">

                            <td align="left" style="line-height:28px;vertical-align: middle;">
                                <span class="hiddenOnMobile" v-if="item.content != null" style="height: 28px;border-radius: 5px;display: inline-block;width: 44px;float: left;background:#eee;background-size:cover;background-position:center;margin-right: 5px;" v-bind:style="{ backgroundImage: 'url(' + item.content.sections.heading.fields.background + ')' }"></span>
                                @{{ item.title }}
                            </td>
                            <td v-if="item.excerpt != null" align="left" class="d-none d-md-block" style="width:auto;line-height:28px;vertical-align: middle;">@{{ item.excerpt }} &nbsp;</td>
                            <td v-else align="left" class="d-none d-md-block" style="width:auto;line-height:28px;vertical-align: middle;"><span style="opacity:0.5;">No description.</span></td>
                            <td class="hiddenOnMobile">
                                <span class="badge badge-pill badge-outline-success" style="text-transform:uppercase !important;" v-if="item.status == 'PUBLISHED'">@{{ item.status }}</span>
                                <span class="badge badge-pill badge-outline-dark" style="opacity:0.5;text-transform:uppercase !important;" v-else>@{{ item.status }}</span>
                            </td>
                            <td class="d-none d-md-block"><span class="badge badge-pill badge-light">@{{ item.last_updated  }}</span> &nbsp;</td>
                            <td align="center" style="width:50px;">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions" v-if="item.deleted_at == null">
                                        <a href="#" class="btn btn-white" v-bind:href="'/admin/content/view/' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:6px 5px 6px 7px;">
                                            <i class="fa fa-fw fa-angle-right"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions" v-else>
                                        <div class="btn btn-outline-danger" style="border-radius:15px;margin-right:5px;min-width:30px;height:30px;padding:6px 10px 6px 10px;" v-on:click="undelete(item)" >
                                            <i class="fa fa-fw material-icons" style="">unarchive</i> Unarchive
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr v-if="info.total == 0 && status != 'loading'">
                            <td colspan="5" align="center">No results.</td>
                        </tr>
                        <tr class="loadingRow" v-if="status == 'loading'">
                            <td colspan="5" align="center">
                                <span style="display:none;">Loading...</span><i class="fa fa-fw fa-spin fa-spinner"></i>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5">
                                <b-pagination-nav :link-gen="linkGen" :number-of-pages="info.pages"  v-model="currentPage" align="center" class="mt-3 mb-2" />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="cardView" style="display:none;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4 dataRow" v-if="info.total == 0" style="float:left;display:block;">
                        <div class="card card-small card-post raised h-100" >
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="text-ford-blue" href="#">No results.</a>
                                </h5>
                                <p class="card-text">Try changing your filters or search terms.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4 loadingRow" v-if="status == 'loading'"  style="float:left;">
                        <div class="card card-small card-post raised h-100" >
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="text-ford-blue" href="#">Loading...</a>
                                </h5>
                                <p class="card-text" align="center"><i class="fa fa-fw fa-spinner fa-spin"></i></p>
                            </div>
                        </div>
                    </div>
                    <div v-if="info.data != null" class="col-lg-3 col-md-6 col-sm-12 mb-4 dataRow" v-for="item in info.data" style="float:left;">
                        <div class="card card-small card-post raised h-100" v-if="item.content != null && item.content.sections != null">
                            <div v-if="(item.content.sections.heading.fields.background != null && item.content.sections.heading.fields.background != '')" class="card-post__image"  v-bind:style="{ backgroundImage: 'url(' + item.content.sections.heading.fields.background + ')' }"
                                 style="background: #333; );">
                                <span v-for="tag in item.tags.slice(0,3)" class="badge badge-dark badge-pill mt-2 mr-2" v-if="tag != null" style="float:right;">@{{ tag.name }}</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="text-ford-blue" v-bind:href="'/admin/content/view/' + item.id">@{{ item.title }}</a>
                                </h5>
                                <p class="card-text mb-2">@{{ item.excerpt }}</p>
                                <div v-if="item.content.sections.heading.fields.background == null" align="left">
                                    <span v-for="tag in item.tags.slice(0,3)" class="badge badge-dark badge-pill mt-2 mr-2" style="float:left;">@{{ tag.name }}</span>
                                </div>
                            </div>
                            <div class="card-footer border-top p-0 pt-3 pb-3" align="center">
                                <div align="center">
                                    <div class="btn-group mb-2" role="group" aria-label="Table row actions">
                                        <a href="" class="btn btn-outline-primary btn-pill" v-bind:href="'/admin/content/view/' + item.post_type + '/' + item.id">
                                            <i class="material-icons">search</i> View
                                        </a>
                                        <?php /*
                                        <a href="" class="btn btn-white" v-bind:href="'/admin/content/edit/' + item.post_type + '/' + item.id">
                                            <i class="material-icons">bar_chart</i> Analytics
                                        </a> */ ?>
                                    </div>
                                </div>
                                <div class="d-inline-block flex-column justify-content-center ml-1 mr-1">
                                    <small class="card-text text-muted" style="text-transform:capitalize;">Last Updated @{{ item.last_updated  }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pb-4" align="center">
                    <b-pagination-nav :link-gen="linkGen" :number-of-pages="info.pages"  v-model="currentPage" align="center" class="mt-3 mb-2" />
                </div>
            </div>
        </div>
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

        <!-- New Content Item Modal -->
        <div class="modal fade" id="modal-new-content" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="width:100%;">
                            New Content Item
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->

                        <!-- Create Client Form -->
                        <form class="form-horizontal" role="form">
                            <label style="margin-bottom:2rem!important;">Select a content type...</label>
                            @foreach($postTypes as $postType)
                                <div class="form-group postTypeSelector" v-on:click="contentType('<?php echo $postType->slug; ?>')"  data-toggle="modal"  data-dismiss="modal"
                                     aria-hidden="true"
                                     data-target="#modal-new-content-title">
                                    <div class="col-md-12">
                                        <h5 class="m-0 p-0">{{ $postType->title }}<br><small class="card-text">{{ $postType->json()->description }}</small></h5>
                                    </div>
                                </div>
                                <br class="mb-2 pb-2"/>
                            @endforeach

                        </form>
                    </div>


                </div>
            </div>
        </div>

        <!-- Filter Content Modal -->
        <div class="modal fade" id="modal-filter-content" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="width:100%;">
                            Filter Results
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body pt-4">
                        <!-- Form Errors -->

                        <!-- Create Client Form -->
                        <form class="form-horizontal" id="formFilters" role="form">
                            <label style="margin-bottom:1.5rem!important;margin-top:0px;">Display Options</label>
                            <div class="input-group mb-2" style="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Display Format</span>
                                </div>
                                <select class="custom-select" style="border-radius:0px 4px 4px 0px;" id="viewMode">
                                    <option selected  value="#listView">List</option>
                                    <option value="#cardView">Cards</option>
                                </select>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Results Per Page</span>
                                </div>
                                <select class="custom-select formFilter" id="statusFilter">
                                    <option selected value="perPage=10">Default</option>
                                    <option value="perPage=10">10</option>
                                    <option value="perPage=25">25</option>
                                    <option value="perPage=100">100</option>
                                </select>
                            </div>
                            <label style="margin-bottom:1.5rem!important;">Filters</label>

                            <div class="input-group mb-2" style="height:36px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Search</span>
                                </div>
                                <input class="form-control formFilter" id="s" name="s" autocomplete="off" />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Status</span>
                                </div>
                                <select class="custom-select formFilter" id="statusFilter">
                                    <option selected value="">Any</option>
                                    <option value="filters[status]=PUBLISHED">Published</option>
                                    <option value="filters[status]=PENDING">Pending</option>
                                    <option value="filters[status]=PRIVATE">Private</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Created</span>
                                </div>
                                <select class="custom-select formFilter" id="createdAtFilter">
                                    <option selected value="filters[created_at]={{ \Carbon\Carbon::now()->toDateTimeString() }},<">Any</option>
                                    <option value="filters[created_at]={{ \Carbon\Carbon::now()->subHours(24)->toDateTimeString() }},>=">Within the last 24 hours</option>
                                    <option value="filters[created_at]={{ \Carbon\Carbon::now()->subDays(7)->toDateTimeString() }},>=">Within the last week</option>
                                    <option value="filters[created_at]={{ \Carbon\Carbon::now()->subDays(30)->toDateTimeString() }},>=">Within the last month</option>
                                    <option value="filters[created_at]={{ \Carbon\Carbon::now()->subDays(365)->toDateTimeString() }},>=">Within the last year</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Updated</span>
                                </div>
                                <select class="custom-select formFilter" id="updatedAtFilter">
                                    <option selected value="filters[updated_at]={{ \Carbon\Carbon::now()->toDateTimeString() }},<">Any</option>
                                    <option value="filters[updated_at]={{ \Carbon\Carbon::now()->subHours(24)->toDateTimeString() }},>=">Within the last 24 hours</option>
                                    <option value="filters[updated_at]={{ \Carbon\Carbon::now()->subDays(7)->toDateTimeString() }},>=">Within the last week</option>
                                    <option value="filters[updated_at]={{ \Carbon\Carbon::now()->subDays(30)->toDateTimeString() }},>=">Within the last month</option>
                                    <option value="filters[updated_at]={{ \Carbon\Carbon::now()->subDays(365)->toDateTimeString() }},>=">Within the last year</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Sort By</span>
                                </div>
                                <select class="custom-select formFilter" id="sortFilter">
                                    <option selected value="sortBy=created_at" selected>Default</option>
                                    <option value="sortBy=title">Title</option>
                                    <option value="sortBy=created_at">Date Created</option>
                                    <option value="sortBy=updated_at">Date Updated</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Sort Direction</span>
                                </div>
                                <select class="custom-select formFilter" id="sortDirectionFilter">
                                    <option value="sortDirection=desc" selected>Default</option>
                                    <option value="sortDirection=asc">Ascending</option>
                                    <option value="sortDirection=desc">Descending</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Show Deleted</span>
                                </div>
                                <select class="custom-select formFilter" id="sortDirectionFilter">
                                    <option value="showDeleted=false">No</option>
                                    <option value="showDeleted=true">Yes</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-primary" data-dismiss="modal"
                           aria-hidden="true">
                            Apply
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        window.addEventListener("hashchange", function(){
            var hash = location.hash.substr(6);
            pageNumber = hash;
            pages.updateData(hash);
        }, false);


        function getHashValue(key) {
            var matches = location.hash.match(new RegExp(key+'=([^&]*)'));
            return matches ? matches[1] : null;
        }

        // usage
        var pageNum = getHashValue('page');
        console.log(pageNum);



        var pageNumber = 1;
        var pages = new Vue({
            el: '#contentApp',
            data () {
                return {
                    currentPage: 1,
                    info: null,
                    status: 'init',
                    itemName: ''
                }
            },
            computed: {
                pageLink () {
                    return this.linkGen(this.currentPage)
                }
            },
            methods: {
                undelete(item){
                    console.log(item);

                    url = 'http://127.0.0.1:8000/api/content/item/edit/' + item.id + '/validate?undelete=true&save=true&json={}';
                    console.log(url);
                    axios
                        .get(url)
                        .then(response => (item.deleted_at = null));
                },
                linkGen (pageNum) {
                    return '#page/' + pageNum
                },
                updateData (pageNumber) {
                    this.status = 'loading';
                    $('.dataRow').hide();
                    $('.loadingRow').show();
                    if(this.filters !== null) {
                        var string = 'http://127.0.0.1:8000/api/content?page=' + pageNumber + '&' + this.filters;
                    }
                    else {
                        var string = 'http://127.0.0.1:8000/api/content?page=' + pageNumber;
                    }
                    var config = { headers: {'Content-Type': 'application/json','Cache-Control' : 'no-cache'}};
                    axios
                        .get(string, config)
                        .then((response) =>{
                        this.info = response.data;
                    this.status = 'loaded';
                    $('.loadingRow').hide();
                    $('.dataRow').fadeIn(200);
                    });
                },
                updateFilters(filters) {
                    this.filters = filters;
                },
                contentType(type) {
                    if(type != null) {
                        this.newContentType= type;
                    }
                    return this.newContentType;
                },
                save(){
                    url = 'http://127.0.0.1:8000/api/content/item/new?title=' + this.itemName + '&type=' + this.newContentType;
                    axios
                        .get(url)
                        .then(response => (window.location.href = "/admin/content/view/" + response.data.data.id));
                }
            },
            mounted () {
                var config = { headers: {'Content-Type': 'application/json','Cache-Control' : 'no-cache'}};
                axios
                    .get('http://127.0.0.1:8000/api/content?', config)
                    .then(response => (this.info = response.data));
            }
        });

        $('#formFilters').submit(false);

        $(document).on('change','#formFilters .formFilter',function(){
            pages.currentPage = 1;

            var filterString = '';

            var concat_string = '';
            var $inputs = $('#formFilters .formFilter:input');
            $inputs.each(function() {
                var value = $(this).val();
                concat_string = '&';
                filterString = filterString + value + concat_string;
            });
            if($('#s').val() !== null) {
                filterString = filterString + '&s=' + $("#s").val();
            }
            pages.updateFilters(filterString);
            pages.updateData(1);
        });

        $(document).on('change','#viewMode',function(){
            if($(this).val() == '#listView') {
                $("#cardView").hide();
                $("#listView").show();
            }
            else {
                $("#listView").hide();
                $("#cardView").show();
            }
            pages.currentPage = 1;
        });
    </script>
@endsection