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

        .colorpicker-field {
            margin-top:15px;
        }

        .colorpicker-field .input-group-prepend .input-group-text{
            min-width:130px;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
    <link rel="stylesheet" href="/admin/scripts/colorpicker/dist/css/bootstrap-colorpicker.css">
@endsection

@section('page-title') Design Settings @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- Input & Button Groups -->
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Branding</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <!-- Input Groups -->
                            <strong class="text-muted d-block mb-2">Logos</strong>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-fw fa-laptop"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Browser Icon"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text p-2" align="center" style="width:41px;text-align:center;">
                                                        <div style="margin-left:3px;display:inline;border-radius:4px;width:20px;height:20px;background:url('/images/startup-engine-logo.png'); background-repeat:no-repeat;background-position: center; background-size: contain !important;">&nbsp;</div>
                                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Company Logo"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <button type="submit" class="btn btn-accent ">Update Branding</button>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- / Input & Button Groups -->
        </div>

        <div class="col-md-6">
            <!-- Input & Button Groups -->
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Colors</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <strong class="text-muted d-block mb-2">Color Scheme</strong>

                            <div class="input-group colorpicker-field" title="Using input value">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Brand Color
                                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" value="royalblue"/>
                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                            </div>

                            <div class="input-group colorpicker-field" title="Using input value">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Primary Color
                                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" value="#333"/>
                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                            </div>

                            <div class="input-group colorpicker-field" title="Using input value">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Secondary Color
                                                    </span>
                                </div>
                                <input type="text" class="form-control input-lg" value="#ffc107"/>
                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                </span>
                            </div>
                            <button type="submit" class="btn btn-accent mt-3">Update Colors</button>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- / Input & Button Groups -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var pageNumber = 1;
        var pages = new Vue({
            el: '#app #pagesTable',
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
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/pages')
                    .then(response => (this.info = response.data));
            }
        })
    </script>
    <script src="/admin/scripts/colorpicker/dist/js/bootstrap-colorpicker.js"></script>
    <script>
        $(function () {
            $('.colorpicker-field').colorpicker({
                format: "hex"
            });
        });
    </script>
@endsection