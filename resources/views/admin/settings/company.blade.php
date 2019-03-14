@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') Company Settings @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- Input & Button Groups -->
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Accounts</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <!-- Input Groups -->
                            <strong class="text-muted d-block mb-2">Administrator / Support Contact</strong>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-fw fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="E-mail Address"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fa fa-fw fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Name"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!-- Input Groups -->
                            <strong class="text-muted d-block mb-2">Social Media</strong>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-fw fa-twitter"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Twitter Username"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fab fa-fw fa-facebook"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Facebook Username"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-fw fa-github"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Github Username"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <button type="submit" class="btn btn-accent">Update Accounts</button>
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
                    <h6 class="m-0">Address</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-3">
                        <form>
                            <!-- Input Groups -->
                            <strong class="text-muted d-block mb-2">Address</strong>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-fw fa-address-card"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Company Name"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-fw fa-building"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Street Address"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fa fa-fw fa-map-pin"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="City"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="far fa-fw fa-map"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="State"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="fa fa-fw fa-flag"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Country"
                                       aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <button type="submit" class="btn btn-accent">Update Address</button>
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
@endsection