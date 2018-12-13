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
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Users @endsection

@section('top-menu')

@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4" id="usersTable"  style="opacity:0;" v-bind:style="{ 'opacity': '1' }">
                <div class="card-header border-bottom" align="right">
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Showing</span>
                            </div>
                            <select id="formFilters" class="custom-select">
                                <option selected value="">All Users</option>
                                <option value="filters[status]=ACTIVE">Active</option>
                                <option value="filters[status]=INACTIVE">Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="card-body p-0 pb-0 text-center">
                    <table class="table mb-0" style="text-align:center;">
                        <thead class="bg-light">
                        <tr>
                            <th class="hiddenOnMobile border-0"  scope="col" style="text-align:left;padding-left:50px;">
                                Name
                            </th>
                            <th scope="col" class="border-0" style="text-align:left;">E-mail</th>
                            <th class="hiddenOnMobile border-0" scope="col">Member Since</th>
                            <th class="hiddenOnMobile border-0" scope="col">Last Active</th>
                            <th scope="col" class="border-0" style="text-align:center;width:140px;">
                                &nbsp;
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="dataRow" v-for="item in info.data" v-if="item.id != null">
                            <td class="hiddenOnMobile" align="left" style="min-width:150px;line-height:28px;vertical-align: middle;">
                                <div v-bind:style="{ backgroundImage: 'url(' + item.avatar + ')' }" style="background:url('/images/avatar.png');background-size:cover;background-position:center;border-radius:20px;height:30px;width:30px;display:inline-block;float:left;margin-right:10px;"></div>
                                @{{ item.name }}
                            </td>
                            <td align="left" style="line-height:28px;vertical-align: middle;"><span
                                        style="opacity:0.5;">@{{ item.email }}</span></td>
                            <td class="hiddenOnMobile"><span class="badge badge-pill badge-light">@{{ item.member_since }}</span></td>
                            <td class="hiddenOnMobile"><span class="badge badge-pill badge-light">@{{ item.last_active }}</span></td>
                            <td  align="center" style="display:inline-block;width:100%;text-align:right;" align="right">
                                <div class="btn-group btn-group-sm" role="group" align="right"
                                     aria-label="Table row actions">
                                    <a href="#" v-bind:href=" '/admin/users/' + item.id " class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:6px 5px 6px 7px;">
                                        <i class="fa fa-fw fa-angle-right"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="" v-if="info.data.length == 0">
                            <td colspan="5" align="center">No results.</td>
                        </tr>
                        <tr class="loadingRow" style="display:none;">
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
            el: '#app #usersTable',
            data () {
                return {
                    currentPage: 1,
                    info: null,
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
                        var string = 'http://127.0.0.1:8000/api/users?perPage=10&page=' + pageNumber + '&' + this.filters;
                    }
                    else {
                        var string = 'http://127.0.0.1:8000/api/users?perPage=10&page=' + pageNumber;
                    }
                    axios
                        .get(string)
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
                    .get('http://127.0.0.1:8000/api/users')
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