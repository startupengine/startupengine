@extends('layouts.shards_admin')

@section('title') <?php echo setting('site.title'); ?> @endsection

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
            display: none;
        }

        .card .postTag:first-of-type {
            display: inline-flex;
        }

        .modal .input-group-text {
            min-width: 130px;
        }

        .badge-light {
            max-width: 300px !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline;
            border: 1px solid #efefef;
        }

        .badge-outline-light {
            border-color: #ddd;
        }

        .truncate {
            width: 300px;
            white-space: nowrap;
            display: inline-flex;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: left;
        }

        @media (max-width: 768px) {
            .truncate {
                width: 150px;
            }
        }

        .badge-occurrence {
            min-width: 100px;
        }

        .badge-type {
            min-width: 60px !important;
            background: #eee;
            border: 1px solid #eee;
        }

        .badge-danger-level-1 {
            background: #ffd2ca;
            color: white !important;
        }

        .badge-danger-level-2 {
            background: #ff9463;
            color: white !important;
        }

        .badge-danger-level-3 {
            background: red;
            color: white !important;
        }

        .thumbnail {
            width: 50px;
            height: 25px;
            border-radius: 4px;
            background-color: #eee;
            display: inline-block;
            background-size: cover;
            background-position: center;
            float: left;
            margin-top: 3px;
        }

        .truncate {
            width: 150px;
            white-space: nowrap !important;
            display: inline-block;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            text-align: left;
        }

        @media (max-width: 768px) {
            .truncate {
                width: 150px;
            }
        }
    </style>
@endsection

@section('head')

    <?php /*
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
    */ ?>

@endsection

@section('page-title') Analytics @endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 justify-content-sm-center justify-content-md-right mt-0">
            <?php /*
            <div class="dropdown ml-2 mt-0 d-none" style="float:right;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="dimmed">Viewing:</span> Customer Journey
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="text-align:center;width:100%;">
                    <a class="dropdown-item text-primary" href="#">Customer Journey</a>
                    <a class="dropdown-item" href="#">Content Trends</a>
                    <a class="dropdown-item" href="#">Engagement</a>
                    <a class="dropdown-item" href="#">Revenue</a>
                </div>
            </div>
            */ ?>

        <div class="input-daterange input-group mt-0" id="datepicker" style="float:right;right:0px;max-width:350px;">
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-white" id="basic-addon1"><i class="material-icons mr-1">date_range</i> Date Range</span>
            </div>
            <input type="text" class="input-sm form-control" id="startDateInput" name="start" placeholder="Start Date" value="{{ \Carbon\Carbon::now()->subDays(30)->toDateString() }}" />
            <input type="text" class="input-sm form-control" id="endDateInput" name="end" placeholder="End Date" value="{{ \Carbon\Carbon::now()->subDays(1)->toDateString() }}" />
        </div>
    </div>
@endsection

@section('alt_content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card card-small">
                <div class="card-body" id="chartJs">
                    <line-chart ref="lineChart" :chartdata="chartData" :options="chartOptions" style="max-height:90vh;">Loading chart...</line-chart>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-eq-height">
        <div class="col-sm-12 col-md-12 col-lg-4 mb-4" id="contentApp" v-if="info !== null">
            <!-- End Small Stats Blocks -->
            <?php $header = '<h6 class="mb-0">Top Content</h6>'; ?>
            <?php $tableHeader = '';
            //'<th scope="col" class="border-0" style="width:50px !important;text-align:left;">Image</th><th scope="col" class="border-0 hiddenOnMobile d-sm-none d-md-none" style="width:100px !important;text-align:left;">Status</th><th scope="col" class="border-0 " style="text-align:left;">Title</th><th scope="col" class="border-0">&nbsp;</th>';
            ?>
            <?php $tableRowConditions = "item.views > 0"; ?>
            <?php $tableRow =
                '<td align="left" class="hiddenOnMobile d-sm-none d-md-none d-lg-block" style="width:auto;"><span class="thumbnail" v-if="item.thumbnail != null" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span><span class="thumbnail" v-else></span></td><td align="left" style="width:100px;" class="hiddenOnMobile d-sm-none d-md-none"><span class="badge badge-type text-dark" style="width:100%;" >{{ item.status }}</span></td><td style="width:auto;" class="pl-0 ml-0" align="left"><span class="badge text-primary dimmed mr-2" >{{ item.views }} View<span v-if="item.views > 1 || item.views == 0">s</span></span><span class="badge text-dark mr-2 px-0"><span class="truncate" style="white-space:pre;">{{ item.title }}</span></span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/content/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
            <?php $tableFooter = ' '; ?>
            <?php $tableRowNoResultsConditions = 'item.views == 0'; ?>
            <?php $noResults =
                '<div align="center" class="pt-4 "  v-if="info.data.every(function(item){return (item.views > 0 )})" ><img src="/images/illustrations/undraw_typewriter_i8xd.svg" style="max-width:180px;" class="mb-3 pb-3"><p class="card-text mt-4 empty-message pt-3">Nothing here. Try adding some content.<br><a href="/admin/content" class="btn btn-primary btn-pill mt-3">Content</a></p></div>'; ?>
            {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/content/',  'TABLE_FOOTER' => $tableFooter, 'TABLE_ROW_CONDITIONS' => $tableRowConditions, 'TABLE_ROW_NO_RESULTS_CONDITIONS' => $tableRowNoResultsConditions, 'TABLE_ROW_NO_RESULTS_MESSAGE' => $noResults, 'WRAPPER_CLASS' => '']) !!}

        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 mb-4" id="pagesApp" v-if="info !== null">
            <?php $header = '<h6 class="mb-0">Top Pages</h6>'; ?>
            <?php $tableHeader = '';
            //'<th scope="col" class="border-0" style="width:50px !important;text-align:left;">Image</th><th scope="col" class="border-0 hiddenOnMobile d-sm-none d-md-none" style="width:100px !important;text-align:left;">Status</th><th scope="col" class="border-0 " style="text-align:left;">Title</th><th scope="col" class="border-0 ">&nbsp;</th>';
            ?>
            <?php $tableRow =
                '<td align="left" style="width:30px;"><span class="thumbnail pull-right" v-if="item.thumbnail != null" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span><span class="thumbnail" v-else></span></td><td align="left" style="width:100px;" class=" hiddenOnMobile d-sm-none d-md-none"><span class="badge badge-type text-dark mr-2" style="width:100%;" >{{ item.status }}</span></td><td style="width:auto;" class="pl-0 ml-0" align="left"><span class="badge text-primary pull-left dimmed mr-2" >{{ item.views }} View<span v-if="item.views > 1">s</span></span><span class="badge text-dark mr-2 px-0 truncate">{{ item.title }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/pages/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
            <?php $tableFooter = ' '; ?>
            <?php $tableRowConditions = "item.views > 1"; ?>
            <?php $tableRowNoResultsConditions = 'item.views > 1'; ?>
            <?php $noResults =
                '<div align="center" class="pt-4" v-if="info.data.every(function(item){return (item.views > 1 )})" ><img src="/images/illustrations/undraw_content_vbqo.svg" style="max-width:180px;" class="mb-3 pb-3"><p class="card-text mt-4 empty-message pt-3">Nothing here. Try adding some pages.<br><a href="/admin/pages" class="btn btn-primary btn-pill mt-3">Pages</a></p></div>'; ?>
            {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/pages/', 'TABLE_FOOTER' => $tableFooter, 'TABLE_ROW_CONDITIONS' => $tableRowConditions, 'TABLE_ROW_NO_RESULTS_CONDITIONS' => $tableRowNoResultsConditions, 'TABLE_ROW_NO_RESULTS_MESSAGE' => $noResults, 'WRAPPER_CLASS' => '']) !!}
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 mb-4" id="productsApp" v-if="info !== null">
            <?php $header = '<h6 class="mb-0">Top Products</h6>'; ?>
            <?php $tableHeader = '';
            //'<th scope="col" class="border-0 d-sm-none d-md-none hiddenOnMobile" style="min-width:50px;text-align:left;">Image</th><th scope="col" class="border-0 d-md-none d-sm-none" style="width:100px !important;text-align:left;">Type</th><th scope="col" class="border-0 h" style="text-align:left;">Name</th><th scope="col" class="border-0" style="width:25px;text-align:center;">&nbsp;</th>';
            ?>
            <?php $tableRow =
                '<td align="left" class="hiddenOnMobile  d-sm-none" style="width:50px;"><span class="thumbnail  mr-2" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span></td><td align="left" style="width:100px;" class="d-md-none"><span class="badge badge-type text-dark mr-2" style="width:100%;" v-if="(((((item || {}).content || {}).sections || {}).about || {}).fields|| {}).type != null">{{ item.content.sections.about.fields.type }}</span><span class="badge badge-type text-dark mr-2" style="width:100%;" v-else><span class="dimmed">N/A</span></span></td><td align="left"><span class="badge text-primary dimmed mr-2">{{ item.purchases }} Purchase<span v-if="item.purchases > 1">s</span></span><span class="badge text-dark mr-2 px-0 truncate">{{ item.name }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/products/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
            <?php $tableFooter = ' '; ?>
            <?php $tableRowConditions =
                "item != null && item.purchases != null && item.purchases > 0"; ?>
            <?php $noResults =
                '<div align="center" class="pt-4"  v-if="info.data.every(function(item){return (item.purchases > 0 )})" ><img src="/images/illustrations/undraw_revenue_3osh.svg" style="max-width:180px;" class="mb-3 pb-3"><p class="card-text mt-4 empty-message pt-3">Nothing here. Try adding some products.<br><a href="/admin/products" class="btn btn-primary btn-pill mt-3">Products</a></p></div>'; ?>
            <?php $tableRowNoResultsConditions = 'item.purchases == 0'; ?>
            {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/products/', 'TABLE_FOOTER' => $tableFooter, 'TABLE_ROW_CONDITIONS' => $tableRowConditions, 'TABLE_ROW_NO_RESULTS_CONDITIONS' => $tableRowNoResultsConditions, 'TABLE_ROW_NO_RESULTS_MESSAGE' => $noResults, 'WRAPPER_CLASS' => '']) !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            endDate: '+1d'
        });

        $('#startDateInput').datepicker()
            .on('changeDate', function(e) {
                // `e` here contains the extra attributes
                console.log('Start Date:');
                console.log(e.date);
                chartApp.startDate = chartApp.formatDate(e.date);
                chartApp.fetchDataFromApi();
                pagesApp.startDate = chartApp.formatDate(e.date);
                pagesApp.updateData();
                contentApp.startDate = chartApp.formatDate(e.date);
                contentApp.updateData();
                productsApp.startDate = chartApp.formatDate(e.date);
                productsApp.updateData();
            });
        $('#endDateInput').datepicker()
            .on('changeDate', function(e) {
                // `e` here contains the extra attributes
                console.log('End Date:');
                console.log(e.date);
                chartApp.endDate = chartApp.formatDate(e.date);
                chartApp.fetchDataFromApi();
            });
    </script>
    <script>

        Vue.component('line-chart', {
            extends: VueChartJs.Line,
            methods: {
                reRenderChart(){
                    this.renderChart({
                        labels: chartApp.dates,
                        datasets: [
                            {
                                label: 'Content Views',
                                borderColor:               '#ff0107',
                                backgroundColor: '#ff0107ad',
                                data: chartApp.timeSeries['Content Views'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            },
                            {
                                label: 'Page Views',
                                borderColor:               '#ff8517',
                                backgroundColor: '#ff8517ad',
                                data: chartApp.timeSeries['Page Views'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            },
                            {
                                label: 'Clicks',
                                borderColor:               '#ffc107',
                                backgroundColor: '#ffc107ad',
                                data: chartApp.timeSeries['Clicks'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            },
                            {
                                label: 'New Users',
                                borderColor:               'rgba(0,150,50,0.3)',
                                backgroundColor: 'rgba(0,210,50,0.15)',
                                data: chartApp.timeSeries['New Users'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            },
                            {
                                label: 'Purchases',
                                borderColor:               '#007bff',
                                backgroundColor: '#007bffad',
                                data: chartApp.timeSeries['Purchases'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            },
                            {
                                label: 'New Subscriptions',
                                borderColor:               '#7f1aff',
                                backgroundColor: '#7f1affad',
                                data: chartApp.timeSeries['New Subscriptions'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            },
                            {
                                label: 'Cancelled Subscriptions',
                                borderColor:               '#000',
                                backgroundColor: '#000000ad',
                                data: chartApp.timeSeries['Cancelled Subscriptions'],
                                pointRadius: 2,
                                pointHoverBorderColor: "#007bff",
                                pointHoverBackgroundColor: "#fff",
                                borderWidth: 2
                            }
                        ]
                    }, {responsive: true, maintainAspectRatio: false})
                }
            },
            mounted () {
                if(chartApp != null) {
                    chartApp.fetchDataFromApi();
                }
            }
        })

        var chartApp = new Vue({
            el: '#chartJs',
            data: {
                message: 'Hello World',
                chartOptions: {},
                chartData: {},
                dates: {},
                timeSeries: [],
                startDate: '',
                endDate: '',
                info: {},
                token   : $('meta[name="csrf-token"]').attr('content')
            },
            mounted () {
                this.fetchDataFromApi();
            },
            methods:{
                updateChartData(input){
                    //console.log('From api...');
                    //console.log(input);
                    this.dates = {};
                    var newDates = input.data.map(item => item.date);
                    //console.log('New dates...');
                    //console.log(newDates);
                    chartApp.info[input.label] = input;
                    chartApp.dates = null;
                    chartApp.dates = input.data.map(item => item.date);
                    chartApp.timeSeries[input.label] = input.data.map(item => item.total);
                    if(input.render == true) {
                        chartApp.$refs.lineChart.reRenderChart();
                    }
                },
                fetchDataFromApi(){
                    var url = '/api/analytics/count?';
                    if(this.startDate != ''){
                        url = url + 'startDate=' + chartApp.startDate;
                    }
                    if(this.endDate != ''){
                        url = url + '&endDate=' + chartApp.endDate;
                    }
                    else {
                        url = url + '&endDate=' + '{{ \Carbon\Carbon::now()->subDays(1)->toDateString() }}';
                    }
                    console.log(url);
                    var config = {headers: {'Content-Type': 'application/json', 'Cache-Control': 'no-cache'}};
                    axios
                        .get(url, config)
                        .then(response => (this.updateChartData({label: 'Page Views',data: response.data})));
                    var newUrl = url + '&event_type=click';
                    axios
                        .get(newUrl, config)
                        .then(response => (this.updateChartData({label: 'Clicks',data: response.data})));
                    newUrl = url + '&event_type=content%20viewed';
                    axios
                        .get(newUrl, config)
                        .then(response => (this.updateChartData({label: 'Content Views',data: response.data})));
                    newUrl = url + '&event_type=user%20registered';
                    axios
                        .get(newUrl, config)
                        .then(response => (this.updateChartData({label: 'New Users',data: response.data})));
                    newUrl = url + '&event_type=product%20purchased';
                    axios
                        .get(newUrl, config)
                        .then(response => (this.updateChartData({label: 'Purchases',data: response.data})));
                    newUrl = url + '&event_type=subscription%20created';
                    axios
                        .get(newUrl, config)
                        .then(response => (this.updateChartData({label: 'New Subscriptions',data: response.data})));
                    newUrl = url + '&event_type=subscription%20created';
                    axios
                        .get(newUrl, config)
                        .then(response => (this.updateChartData({label: 'Cancelled Subscriptions',data: response.data, render: true})));
                },
                formatDate(date) {
                    var d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    return [year, month, day].join('-');
                },
                updateStartDate(input){
                    console.log(input);
                    this.startDate = input;
                },
                updateEndDate(input){
                    console.log(input);
                    this.startDate = input;
                }
            }
        })
    </script>
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME' => 'contentApp', 'url' =>  URL::to('/').'/api/resources/content', 'div_id' => 'contentApp', 'LIMIT' => 5, 'SORT_STRING' => '&sort=-views&sortMethod=COUNT']) !!}
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME' => 'pagesApp', 'url' =>  URL::to('/').'/api/resources/page', 'div_id' => 'pagesApp', 'LIMIT' => 5, 'SORT_STRING' => '&sort=-views&sortMethod=COUNT']) !!}
    {!! renderResourceTableScriptsDynamically(['VUE_APP_NAME' => 'productsApp', 'url' =>  URL::to('/').'/api/resources/product', 'div_id' => 'productsApp', 'LIMIT' => 5, 'SORT_STRING' => '&sort=-purchases&sortMethod=COUNT']) !!}
@endsection