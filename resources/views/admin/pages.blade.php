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
            min-width:80px;
        }

        .actionButton {
            min-width:120px;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Pages @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-12 pageNav" align="right">
        <a href="/admin/pages/new" class="btn btn-outline-primary pull-right ml-2 actionButton" style="padding-top:10px;height:36px;"><i class="fa fa-plus-circle"></i> &nbsp;New Page</a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4" id="pagesTable" style="opacity:0;" v-bind:style="{ 'opacity': '1' }">
                <div class="card-header border-bottom" align="right">
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Showing</span>
                            </div>
                            <select class="custom-select" id="formFilters">
                                <option selected value="">All Pages</option>
                                <option value="filters[status]=ACTIVE">Active</option>
                                <option value="filters[status]=INACTIVE">Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="card-body p-0 pb-0 text-center">
                    <table class="table mb-0" >
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0" style="width:150px !important;text-align:left;">Title</th>
                            <th scope="col" class="border-0 d-none d-md-block" style="text-align:left;">Description</th>
                            <th scope="col" class="border-0" style="text-align:center;">Status</th>
                            <th scope="col" class="border-0 d-none d-md-block" style="text-align:center;">Last Updated</th>
                            <th scope="col" class="border-0" style="width:150px;text-align:center;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="dataRow" v-for="item in info.data">
                            <td align="left" style="line-height:28px;vertical-align: middle;">@{{ item.title }}</td>
                            <td v-if="item.meta_description != null" align="left" class="d-none d-md-block" style="width:auto;line-height:28px;vertical-align: middle;">@{{ item.meta_description }} &nbsp;</td>
                            <td v-else align="left" class="d-none d-md-block" style="width:auto;line-height:28px;vertical-align: middle;"><span style="opacity:0.5;">No description.</span></td>
                            <td class="">
                                <span class="badge badge-pill badge-outline-success" style="text-transform:uppercase !important;" v-if="item.status == 'ACTIVE'">@{{ item.status }}</span>
                                <span class="badge badge-pill badge-outline-dark" style="opacity:0.5;text-transform:uppercase !important;" v-else>@{{ item.status }}</span>
                            </td>
                            <td class="d-none d-md-block"><span class="badge badge-pill badge-light">@{{ item.last_updated  }}</span></td>
                            <td align="center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                                    <a href="" class="btn btn-white" v-bind:href="'/' + item.slug" target="_blank">
                                        <i class="material-icons">search</i>
                                    </a>
                                    <a href="" class="btn btn-white" v-bind:href="'/admin/pages/' + item.id ">
                                        <i class="material-icons">edit</i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="" v-if="info.data.length == 0">
                            <td colspan="5" align="center">No results.</td>
                        </tr>
                        <tr class="loadingRow" v-if="status == 'loading'">
                            <td colspan="5" align="center"><span style="display:none;">Loading...</span><i class="fa fa-fw fa-spin fa-spinner"></i></td>
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
            el: '#app #pagesTable',
            data () {
                return {
                    currentPage: 1,
                    info: null,
                    status: 'init'
                }
            },
            computed: {
                pageLink () {
                    return this.linkGen(this.currentPage)
                }
            },
            methods: {
                linkGen (pageNum) {
                    return '#page/' + pageNum
                },
                updateData (pageNumber) {
                    this.status = 'loading';
                    $('.dataRow').hide();
                    $('.loadingRow').show();
                    if(this.filters !== null) {
                        var string = 'http://127.0.0.1:8000/api/pages?perPage=10&page=' + pageNumber + '&' + this.filters;
                    }
                    else {
                        var string = 'http://127.0.0.1:8000/api/pages?perPage=10&page=' + pageNumber;
                    }
                    axios
                        .get(string)
                        //.then(response => (this.info = response.data))
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
                    .get('http://127.0.0.1:8000/api/pages?perPage=10')
                    .then(response => (this.info = response.data));
            }
        })

        $(document).on('change','#formFilters',function(){
            pages.currentPage = 1;
            filters = $(this).val();
            pages.updateFilters(filters);
            pages.updateData(1);
        });
    </script>
@endsection