@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        .badge-price {
            min-width: 150px;
        }

        .multiselect__select {
            display: none;
        }

        .multiselect__tags {
            border: none;
        }

        .multiselect__tag-icon {
            display: none;
        }

        .multiselect__tag {
            padding: 6px 12px;
            background: #eee;
            border-radius: 15px;
            color: #333;
        }

        .multiselect__tags {
            padding: 8px;
            text-align: center;
        }

        #interests {
            pointer-events: none !important;
        }

        .list-group.raised {
            box-shadow: 0 2px 0 rgba(90, 97, 105, .11), 0 4px 8px rgba(90, 97, 105, .12), 0 10px 10px rgba(90, 97, 105, .06), 0 7px 70px rgba(90, 97, 105, .1) !important;
            border-radius: 5px !important;
        }

        .list-group-item:first-child, .list-group-item:last-child {
            border: none !important;
        }

        .list-group-item:last-child {
            border-top: 1px solid #ddd;
        }

        .list-group-item:focus {
            border-bottom: 1px solid #ddd !important;
        }

        .list-group:hover .list-group-item:last-child .btn {
            background: #007bff;
            color: #fff;
        }

        .card > .list-group:last-child .list-group-item:last-child {
            border-top: none !important;
        }

        .list-group-item .fa.fa-fw {
            opacity: 0.3;
        }

        #topPages .list-group-item {
            background:rgba(126, 186, 255, 0.1);
            border-left:2px solid rgba(0,0,0,0.5);
            border-radius:4px;
            padding:15px 15px;
            transition:all 0.5s;
        }
        #topPages .list-group-item:hover {
            background:rgba(95, 114, 255, 0.1);
            border-left:2px solid #333;
            cursor:pointer;
        }

        .list-group.flat {

            border-radius:6px;
        }
        .list-group.flat li {
            background:#fff;
        }

    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
    <style src="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css"></style>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
@endsection

@section('page-title') User Profile @endsection

@section('top-menu')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-small mb-4 pt-3">
                <div class="card-header border-bottom text-center pb-4">
                    <div class="mb-0 mx-auto" align="center">

                        <div class="rounded-circle"
                             style="background:url('{{ $user->avatar() }}'); background-size:cover;background-position:center;width:110px;height:110px;display:inline-block;"></div>
                    </div>
                    <h4 class="mb-0 mt-0">{{ $user->name }}</h4>
                    <span class="text-muted d-block mb-2">{{ $user->email }}</span>
                    @if($user->status == "ACTIVE")
                        <div class="badge badge-outline-success badge-pill d-inline-block mb-2" style="width:90px;">{{ $user->status }}</div>
                    @else
                        <div class="badge badge-outline-danger badge-pill d-inline-block mb-2" style="width:90px;">{{ $user->status }}</div>
                    @endif
                </div>
                <ul class="list-group list-group-flush">
                    <?php /*
                    <li class="list-group-item p-4">
                        <div class="progress-wrapper">
                            <strong class="text-muted d-block mb-2">Onboarding Progress</strong>
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="80"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                    <span class="progress-value">80%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    */ ?>
                    @if($user->bio !== null)
                        <li class="list-group-item py-4 border-0" style="background:none;">
                            <strong class="text-muted d-block mb-2">Bio</strong>
                            <span>{{ $user->bio }}</span>
                        </li>
                    @endif

                    <li class="list-group-item pt-4 pb-4" align="center" style="border-radius:0px 0px .625rem .625rem !important;">
                        <button type="button" class="mb-0 btn btn-sm btn-pill btn-outline-primary mr-2">
                            <i class="material-icons mr-1">edit</i>Edit
                        </button>
                    </li>

                    <li class="list-group-item pt-4 pb-0 border-0" style="display:none;"></li>

                </ul>
            </div>

            <div class="card mb-4">
                <div class="card-header border-bottom" align="center"><strong>Interests</strong></div>
                <div class="m-3">
                    <div id="interests" align="center">
                        @foreach($user->recentInterests() as $interest)
                            <span class="badge badge-dark">{{ $interest["name"] }}</span>
                        @endforeach
                        @if(empty($user->recentInterests()) OR $user->recentInterests() == null)
                            <p class="card-text mb-0">No results.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header border-bottom" align="center"><strong>Top Pages</strong></div>
                <div class="m-3">
                    <div class="list-group list-group-flush" id="topPages" align="center">
                        @foreach($topPages as $page)
                            <div class="list-group-item" onclick="location.href = '/{{ $page->slug }}';">{{ $page->title }}</div>
                        @endforeach
                        @if(count($topPages) == 0)
                                <p class="card-text mb-0">No results.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <div class="card card-small user-stats mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <h4 class="m-0"><span style="font-size:66%;opacity:0.5;">$</span>{{ round($user->recentCosts()) }}</h4>
                            <span class="text-light text-uppercase">Monthly Costs</span>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="m-0"><span style="font-size:66%;opacity:0.5;">$</span>{{ round($user->recentPayments()) }}</h4>
                            <span class="text-light text-uppercase">Monthly Value</span>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="m-0"><span style="font-size:66%;opacity:0.5;">$</span>{{ round($user->lifeTimeValue()) }}</h4>
                            <span class="text-light text-uppercase">Lifetime Value</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-eq-height">
                <div class="col-md-4">
                    <ul class="list-group mb-3 raised">
                        <li class="list-group-item p-4" style="min-height:245px !important;">
                            <p align="center">
                                <strong><i class="fa fa-fw fa-credit-card mr-2"></i>Payment Method</strong>
                            </p>
                            <p align="center">
                                @if($user->card_last_four !== null)
                                    {{ $user->card_brand }} Ending In {{ $user->card_last_four }}
                                @else
                                    No card on file.
                                @endif
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-group mb-3 raised">
                        <li class="list-group-item p-4" style="min-height:245px !important;">
                            <p align="center"><strong class="d-block mb-2"><i class="fa fa-fw fa-gift mr-2"></i>Subscriptions</strong>
                            </p>
                            <p align="center"><span>Basic Plan</span><br><span
                                        class="badge badge-outline-success text-dark mt-2">Total: $14.99/month</span>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-group mb-3 raised">
                        <li class="list-group-item p-4" style="min-height:245px !important;">
                            <p align="center"><strong class=" d-block mb-2"><i class="fa fa-fw fa-list mr-2"></i>Recent
                                    Transactions</strong></p>
                            <p align="center">
                                <span class="badge badge-price badge-outline-dark text-dark mt-2">$14.99 <span
                                            class="text-light">3 Days Ago</span></span><br>
                                <span class="badge badge-price badge-outline-dark text-dark mt-2">$14.99 <span
                                            class="text-light">1 Month Ago</span></span><br>
                                <span class="badge badge-price badge-outline-dark text-dark mt-2">$14.99 <span
                                            class="text-light">2 Months Ago</span></span><br>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 mb-3">


                    <ul class="list-group list-group-flush raised">
                        <li class="list-group-item" style="text-align:center;">
                            <strong>Recent Activity</strong>
                        </li>
                        @foreach($user->recentEvents() as $event)
                            <li class="list-group-item">
                                @if($event->event_type == "page viewed")
                                    <i class="fa fa-eye" style="color:#333;"></i>
                                @elseif($event->event_type == "content viewed")
                                    <i class="fa fa-eye" style="color:#333;"></i>
                                @elseif($event->event_type == "content liked")
                                    <i class="fa fa-heart" style="color:hotpink;"></i>
                                @elseif($event->event_type == "payment received")
                                    <i class="fa fa-credit-card" style="color:mediumseagreen;"></i>
                                @elseif($event->event_type == "payment declined")
                                    <i class="fa fa-credit-card" style="color:#ff4043;"></i>
                                @endif
                                &nbsp; <span class="badge badge-pill badge-outline-secondary mr-2" style="text-transform:capitalize;">{{ $event->event_type }}</span>
                                    <br class="hiddenOnDesktop" />
                                @if(isset(json_decode($event->event_data)->description))
                                    <span class="text-light my-2 mr-2 d-inline-block">
                                        @if($event->event_type =="payment received") {{ json_decode($event->event_data)->amount }} @endif {{ json_decode($event->event_data)->description }}
                                    </span>
                                    <br class="hiddenOnDesktop" />
                                    <span class="text-dark d-inline-block">{{ $event->created_at->diffForHumans() }}</span>
                                @endif
                            </li>
                        @endforeach
                        @if(count($user->recentEvents()) == 0)
                            <li class="list-group-item list-group-item-light" align="center" style="border-top:1px solid #ddd !important;">
                                <p class="card-text">No results.</p>
                            </li>
                        @else
                            <li class="list-group-item list-group-item-light" style="border-top:1px solid #ddd !important;">
                                <div class="col-md-12 pb-1" align="center"><strong>. . .</strong></div>
                            </li>
                        @endif
                    </ul>


                </div>


            </div>
        </div>
        <!-- End Default Light Table -->
    </div>
@endsection

@section('scripts')
    <script>
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
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/users')
                    .then(response = > (this.info = response.data)
            )
                ;
            }
        })
    </script>
    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <script>


        var tags = new Vue({
            components: {
                Multiselect: window.VueMultiselect.default
            },
            data: {
                value: ['Politics', 'Government', 'E-Commerce', 'Web Design', 'Programming', 'Startups'],
                options: ['Politics', 'Government', 'E-Commerce', 'Web Design', 'Programming', 'Startups'],
                optionsProxy: []
            }
        }).$mount("#interests");


    </script>
@endsection