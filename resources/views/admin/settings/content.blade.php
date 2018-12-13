@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        .card {
            margin-bottom: 15px;
        }

        a p.card-text {
            color: #000 !important;
        }

        a .card-title {
            color: #444 !important;
        }

    </style>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
@endsection

@section('page-title') Content Settings @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4" id="modelsTable" style="opacity:0;" v-bind:style="{ 'opacity': '1' }">
                <div class="card-header border-bottom" align="left"><h6 class="mb-0">Content Models</h6></div>
                <div class="card-header border-bottom" align="right">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Showing</span>
                            </div>
                            <select class="custom-select">
                                <option selected disabled>All Models</option>
                                <option value="1">Enabled</option>
                                <option value="2">Disabled</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="card-body p-0 pb-0 text-center">
                    <table class="table mb-0" >
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0" style="width:150px !important;text-align:left;">Name</th>
                            <th scope="col" class="border-0 d-none d-md-block" style="text-align:left;">Description</th>
                            <th scope="col" class="border-0" style="width:150px;text-align:center;">Status</th>
                            <th scope="col" class="border-0 d-none d-md-block" style="text-align:center;">Last Updated</th>
                            <th scope="col" class="border-0" style="width:50px;text-align:center;">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in info.data" v-if="item.title != null">
                            <td align="left" style="line-height:28px;vertical-align: middle;">@{{ item.title }}</td>
                            <td align="left" class="d-none d-md-block" style="line-height:28px;vertical-align: middle;">@{{ JSON.parse(item.json).description }}</td>
                            <td class=""><span class="badge badge-pill badge-outline-success" v-if="item.enabled == true">Enabled</span><span class="badge badge-pill badge-outline-secondary" v-else>Disabled</span></td>
                            <td class="d-none d-md-block"><span class="badge badge-pill badge-light" style="text-transform:capitalize;">@{{  timestamp(item.updated_at) }}</span></td>
                            <td align="center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                                    <a href="#" v-bind:href="'/admin/settings/content/model/' + item.id + '/edit'" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:6px 5px 6px 7px;">
                                        <i class="fa fa-fw fa-angle-right"></i>
                                    </a>
                                </div>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener("hashchange", function(){
            var hash = location.hash.substr(6);
            models.updateData(hash);
        }, false);


        function getHashValue(key) {
            var matches = location.hash.match(new RegExp(key+'=([^&]*)'));
            return matches ? matches[1] : null;
        }

        // usage
        var pageNum = getHashValue('page');
        console.log(pageNum);

        var pageNumber = 1;
        var models = new Vue({
            el: '#app #modelsTable',
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
                timestamp: function(date) {
                    return moment(date).fromNow()
                },
                linkGen (pageNum) {
                    return '#page/' + pageNum
                },
                updateData (pageNumber) {
                    this.status = 'loading';
                    axios
                        .get('http://127.0.0.1:8000/api/content/models?perPage=5&page=' + pageNumber)
                        .then(response => (this.info = response.data));
                    this.status = 'loaded';
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/content/models?perPage=5')
                    .then(response => (this.info = response.data));
            }
        })
    </script>
@endsection