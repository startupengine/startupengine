@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        td {
            line-height:28px;vertical-align: middle;
        }

        nav li.page-item {
            box-shadow:none !important;
            border:1px solid #ddd;
            border-right:0px;
        }
        nav li.page-item:last-of-type {
            border-right:1px solid #ddd;
        }

        nav li.page-item.active a {
            background:#555 !important;
        }

        nav li.page-item.active {
            border-color:#555;
        }

        nav li.page-item:hover a {
            color:#000 !important;
        }

        nav li.page-item.active:hover a {
            color:#fff !important;
        }

        .page-item a {
            color:#888;
        }

        table .badge-pill {
            min-width:130px;
        }

        .actionButton {
            width: 120px !important;
        }

        .postTypeSelector {
            background:rgba(126, 186, 255, 0.1);
            border-left:2px solid rgba(0,0,0,0.5);
            border-radius:4px;
            padding:15px 0px;
            transition:all 0.5s;
        }
        .postTypeSelector:hover {
            background:rgba(95, 114, 255, 0.1);
            border-left:2px solid #333;
            cursor:pointer;
        }

        .postTypeSelector:last-of-type {
            margin-bottom:0px !important;
        }
        .modal-header .close {
            padding: 1.25rem 5px !important;
            margin: -1rem -1rem -1rem auto !important;
        }

        .modal-footer {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
            padding-right: 25px !important;
            padding-left: 25px !important;
        }


        .modal .input-group-text {
            min-width:130px;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Products @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-12 pageNav" align="right">
        <div class="btn btn-outline-primary pull-right" data-toggle="modal"
             data-target="#modal-product-type" style="float:right;"><i class="fa fa-plus-circle"></i> &nbsp;New Product</div>
        <a href="#" class="btn btn-secondary pull-left mr-2 actionButton" data-toggle="modal"
           data-target="#modal-filter-content" style="width:auto !important;padding-top:10px;float:right;"><i class="fa fa-filter"></i> &nbsp;Filter Results</a>

    </div>
@endsection

@section('content')
    <div class="row" id="productsApp" v-if="info != null">
        <div class="col">
            <div class="card card-small mb-4" id="productsTable" v-bind:style="{ 'opacity': '1' }" style="opacity:0;">
                <div class="card-header border-bottom" align="left">
                    <strong>List View</strong>
                </div>
                <div class="card-body p-0 pb-0 text-center">
                    <table class="table mb-0" style="text-align:left;">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0" style="width:250px !important;">Name</th>
                            <th class="hiddenOnMobile border-0" scope="col">Price</th>
                            <th class="hiddenOnMobile border-0" scope="col">Description</th>
                            <th class="hiddenOnMobile border-0" scope="col" style="text-align:center;">Type</th>
                            <th scope="col" class="border-0" style="text-align:center;"> &nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr><td colspan="5" align="center" v-if="info && info.data != null && info.data.length == 0">No results.</td></tr>
                        <tr v-if="info != null && info.data != null" v-for="(item, key) in info.data" >
                            <template v-if="item.remote_data != null">
                            <td style="text-transform: capitalize;">
                                <span class="hiddenOnMobile" v-if="item.json != null && JSON.parse(item.json).sections.about.fields.image !== undefined && JSON.parse(item.json).sections.about.fields.image !== null" style="height: 28px;border-radius: 5px;display: inline-block;width: 44px;float: left;background:#fff;background-size:contain;background-position:center;margin-right: 5px;background-repeat:no-repeat;" v-bind:style="{ backgroundImage: 'url(' + JSON.parse(item.json).sections.about.fields.image + ')' }"></span>
                                <span class="hiddenOnMobile" v-else style="height: 28px;border-radius: 5px;display: inline-block;width: 44px;float: left;background-color:#eee;background-image:url('/images/product.png');background-size:cover;background-position:center;margin-right: 5px;"></span>
                                @{{ item.name }}
                            </td>
                            <td class="hiddenOnMobile" style="text-transform:capitalize;"><span v-if="JSON.parse(item.json) != null && JSON.parse(item.json).sections.about.fields.price != null">$@{{ JSON.parse(item.json).sections.about.fields.price }}</span><span v-else style="opacity:0.5;">No data.</span></td>
                            <td class="hiddenOnMobile" style="text-transform:capitalize;"><span v-if="JSON.parse(item.json) != null && JSON.parse(item.json).sections.about.fields.description != null">@{{ JSON.parse(item.json).sections.about.fields.description }}</span><span v-else style="opacity:0.5;">No data.</span></td>
                            <td class="hiddenOnMobile" style="width:150px;text-align:center;"><span class="badge badge-pill badge-outline-dark" style="text-transform:capitalize;" v-if="JSON.parse(item.json) != null && JSON.parse(item.json).sections.about.fields.type != null" >@{{ JSON.parse(item.json).sections.about.fields.type }}</span><span class="badge badge-pill badge-outline-dark" style="text-transform:capitalize;" v-else-if="JSON.parse(item.remote_data) != null && JSON.parse(item.remote_data).type != null" >@{{ JSON.parse(item.remote_data).type }}</span><span v-else style="opacity:0.5;">No data.</span></span></td>
                            <td align="right">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions" v-if="item.deleted_at == null">
                                    <a href="#" class="btn btn-white" v-bind:href="'/admin/products/' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:6px 5px 6px 7px;">
                                        <i class="fa fa-fw fa-angle-right"></i>
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions" v-else>
                                    <div class="btn btn-outline-danger" style="border-radius:15px;margin-right:5px;min-width:30px;height:30px;padding:6px 10px 6px 10px;" v-on:click="undelete(item)" >
                                        <i class="fa fa-fw material-icons" style="">unarchive</i> Unarchive
                                    </div>
                                </div>
                            </td>
                            </template>
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
        </div>
    </div>

    <!-- New Product Type Modal -->
    <div class="modal fade" id="modal-product-type" tabindex="-1" role="dialog" v-if="info != null">
        <div class="modal-dialog">
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
                        <label style="margin-bottom:2rem!important;">Select a product type...</label>
                        <?php $productTypes = [ "Service / Subscription" => "service", "Physical Product" => "good"]; ?>
                        @foreach($productTypes as $productType => $productTypeSlug)
                            <div class="form-group postTypeSelector" data-toggle="modal"  data-dismiss="modal"
                                 aria-hidden="true"
                                 data-target="#modal-new-product" v-on:click="productType('<?php echo $productTypeSlug; ?>')">
                                <div class="col-md-12">
                                    <h5 class="m-0 p-0">{{ $productType }}</h5>
                                </div>
                            </div>
                            <br class="mb-2 pb-2"/>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- New Product Form Modal -->
    <div class="modal fade" id="modal-new-product" tabindex="-1" role="dialog" >
        <div class="modal-dialog" >
            <div class="modal-content" v-if="productType != null">
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
                                <label style="margin-bottom:2rem!important;">Let's name your product.</label>
                                <div class="input-group">
                                    <input name="name" v-model="productName" class="form-control" autocomplete="off" placeholder="i.e., Model 51" />
                                </div>
                            </div>
                            <br class="mb-2 pb-2"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-danger" data-toggle="modal"
                         data-target="#modal-new-product">Cancel</div>
                    <div class="btn btn-success" v-on:click="save()" data-dismiss="modal">Save New Product</div>
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
                                <option value="filters[status]=ACTIVE">Active</option>
                                <option value="filters[status]=INACTIVE">Inactive</option>
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
@endsection

@section('scripts')
    <script>
        window.addEventListener("hashchange", function(){
            var hash = location.hash.substr(6);
            pages.updateData(hash);
        }, false);


        function getHashValue(key) {
            var matches = location.hash.match(new RegExp(key+'=([^&]*)'));
            return matches ? matches[1] : null;
        }

        // usage
        var pageNum = getHashValue('page');

        var pageNumber = 1;
        var pages = new Vue({
            el: '.main-content',
            data () {
                return {
                    currentPage: 1,
                    info: '',
                    productName: '',
                    record: ''
                }
            },
            computed: {
                pageLink () {
                    return this.linkGen(this.currentPage)
                }
            },
            methods: {
                productType(type) {
                if(type != null) {
                      this.newProductType = type;
                  }
                  return this.newProductType;
                },
                save(){

                    url = 'http://127.0.0.1:8000/api/products/new?name=' + this.productName + '&type=' + this.newProductType;

                    axios
                        .get(url)
                        .then(response => (this.record = response.data));

                    var config = {headers: {'Content-Type': 'application/json', 'Cache-Control': 'no-cache'}};
                    var url2 = 'http://127.0.0.1:8000/api/products?sortBy=updated_at&sortDirection=desc';
                    axios
                        .get(url2, config)
                        .then(response => (this.info = response.data));
                },
                undelete(item){
                    console.log(item);
                    item.deleted_at = null;
                    url = 'http://127.0.0.1:8000/api/products/edit/' + item.id + '?undelete=true&save=true&json={}';
                    console.log(url);
                    axios
                        .get(url)
                        .then(response => (item = response.data.data));
                },
                linkGen (pageNum) {
                    return '#page/' + pageNum
                },
                updateData (pageNumber) {
                    this.status = 'loading';
                    $('.dataRow').hide();
                    $('.loadingRow').show();
                    if(this.filters !== null) {
                        var string = 'http://127.0.0.1:8000/api/products?page=' + pageNumber + '&' + this.filters;
                    }
                    else {
                        var string = 'http://127.0.0.1:8000/api/products?page=' + pageNumber;
                    }
                    this.currentUrl = string;
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
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/products?sortBy=updated_at&sortDirection=desc')
                    .then(response => (this.info = response.data));
            }
        })

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

    </script>
@endsection