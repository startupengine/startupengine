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

        .row-eq-height .card {
            height:100% !important;
            min-height:300px;
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

        .empty-message {
            position: absolute;
            bottom:0px;
            left: 0px;
            text-align: center;
            width: 100%;
        }
    </style>
@endsection

@section('page-title') Overview <span class="ml-1 dimmed">Last 30 Days</span>@endsection

@section('top-menu')
    <div class="col-md-6 col-sm-6 pull-right pageNav" align="right">
        <a href="/admin/analytics" class="btn btn-white btn-pill">Explore Analytics<i class="fa fa-arrow-right text-primary ml-2"></i></a>
    </div>
@endsection

@section('alt_content')
    <!-- Small Stats Blocks -->
    <div class="row bg-black" id="analyticCounts">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            {!! renderStatisticCard($stats, $oldStats, 'Content Views', 'contentViews') !!}
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            {!! renderStatisticCard($stats, $oldStats, 'Page Views', 'pageViews') !!}
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            {!! renderStatisticCard($stats, $oldStats, 'Clicks', 'clicks') !!}
        </div>
        <div class="col-lg col-md-4 col-sm-6 mb-4">
            {!! renderStatisticCard($stats, $oldStats, 'New Users', 'users') !!}
        </div>
        <div class="col-lg col-md-4 col-sm-12 mb-4">
            {!! renderStatisticCard($stats, $oldStats, 'Transactions', 'transactions') !!}
        </div>
    </div>
    <div class="row row-eq-height">
        <div class="col-sm-12 col-md-12 col-lg-4 mb-4" id="contentApp" v-if="info !== null">
            <!-- End Small Stats Blocks -->
            <?php $header = '<h6 class="mb-0">Top Content</h6>'; ?>
            <?php $tableHeader = ''; //'<th scope="col" class="border-0" style="width:50px !important;text-align:left;">Image</th><th scope="col" class="border-0 hiddenOnMobile d-sm-none d-md-none" style="width:100px !important;text-align:left;">Status</th><th scope="col" class="border-0 " style="text-align:left;">Title</th><th scope="col" class="border-0">&nbsp;</th>'; ?>
            <?php $tableRowConditions = "item.views > 0"; ?>
            <?php $tableRow = '<td align="left" style="width:30px;"><span class="thumbnail" v-if="item.thumbnail != null" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span><span class="thumbnail" v-else></span></td><td align="left" style="width:100px;" class="hiddenOnMobile d-sm-none d-md-none"><span class="badge badge-type text-dark mr-2" style="width:100%;" >{{ item.status }}</span></td><td style="width:auto;" class="pl-0 ml-0" align="left"><span class="badge text-primary pull-left dimmed mr-2" >{{ item.views }} View<span v-if="item.views > 1">s</span></span><span class="badge text-dark mr-2 px-0">{{ item.title }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/content/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
            <?php $tableFooter = ' '; ?>
            <?php $tableRowNoResultsConditions = 'item.views == 0'; ?>
            <?php $noResults = '<div align="center" class="pt-4"><img src="/images/illustrations/undraw_typewriter_i8xd.svg" style="max-width:180px;" class="mb-3 pb-3"><p class="card-text mt-4 empty-message pt-3">Nothing here. Try adding some content.<br><a href="/admin/content" class="btn btn-primary btn-pill mt-3">Content</a></p></div>'; ?>
            {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/content/',  'TABLE_FOOTER' => $tableFooter, 'TABLE_ROW_CONDITIONS' => $tableRowConditions, 'TABLE_ROW_NO_RESULTS_CONDITIONS' => $tableRowNoResultsConditions, 'TABLE_ROW_NO_RESULTS_MESSAGE' => $noResults, 'WRAPPER_CLASS' => 'h-100']) !!}

        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 mb-4" id="pagesApp" v-if="info !== null">
            <?php $header = '<h6 class="mb-0">Top Pages</h6>'; ?>
            <?php $tableHeader =  ''; //'<th scope="col" class="border-0" style="width:50px !important;text-align:left;">Image</th><th scope="col" class="border-0 hiddenOnMobile d-sm-none d-md-none" style="width:100px !important;text-align:left;">Status</th><th scope="col" class="border-0 " style="text-align:left;">Title</th><th scope="col" class="border-0 ">&nbsp;</th>'; ?>
            <?php $tableRow = '<td align="left" style="width:30px;"><span class="thumbnail pull-right" v-if="item.thumbnail != null" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span><span class="thumbnail" v-else></span></td><td align="left" style="width:100px;" class=" hiddenOnMobile d-sm-none d-md-none"><span class="badge badge-type text-dark mr-2" style="width:100%;" >{{ item.status }}</span></td><td style="width:auto;" class="pl-0 ml-0" align="left"><span class="badge text-primary pull-left dimmed mr-2" >{{ item.views }} View<span v-if="item.views > 1">s</span></span><span class="badge text-dark mr-2 px-0">{{ item.title }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/pages/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
            <?php $tableFooter = ' '; ?>
            <?php $tableRowConditions = "item.views > 0"; ?>
            <?php $tableRowNoResultsConditions = 'item.views == 0'; ?>
            <?php $noResults = '<div align="center" class="pt-4"><img src="/images/illustrations/undraw_content_vbqo.svg" style="max-width:180px;" class="mb-3 pb-3"><p class="card-text mt-4 empty-message pt-3">Nothing here. Try adding some pages.<br><a href="/admin/pages" class="btn btn-primary btn-pill mt-3">Pages</a></p></div>'; ?>
            {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/pages/', 'TABLE_FOOTER' => $tableFooter, 'TABLE_ROW_CONDITIONS' => $tableRowConditions, 'TABLE_ROW_NO_RESULTS_CONDITIONS' => $tableRowNoResultsConditions, 'TABLE_ROW_NO_RESULTS_MESSAGE' => $noResults, 'WRAPPER_CLASS' => 'h-100']) !!}
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 mb-4" id="productsApp" v-if="info !== null">
            <?php $header = '<h6 class="mb-0">Top Products</h6>'; ?>
            <?php $tableHeader = ''; //'<th scope="col" class="border-0 d-sm-none d-md-none hiddenOnMobile" style="min-width:50px;text-align:left;">Image</th><th scope="col" class="border-0 d-md-none d-sm-none" style="width:100px !important;text-align:left;">Type</th><th scope="col" class="border-0 h" style="text-align:left;">Name</th><th scope="col" class="border-0" style="width:25px;text-align:center;">&nbsp;</th>'; ?>
            <?php $tableRow = '<td align="left" class="hiddenOnMobile  d-sm-none" style="width:50px;"><span class="thumbnail  mr-2" v-bind:style="{ backgroundImage: \'url(\' + item.thumbnail + \')\' }"> </span></td><td align="left" style="width:100px;" class="d-md-none"><span class="badge badge-type text-dark mr-2" style="width:100%;" v-if="(((((item || {}).content || {}).sections || {}).about || {}).fields|| {}).type != null">{{ item.content.sections.about.fields.type }}</span><span class="badge badge-type text-dark mr-2" style="width:100%;" v-else><span class="dimmed">N/A</span></span></td><td align="left"><span class="badge text-primary dimmed mr-2">{{ item.purchases }} Purchase<span v-if="item.purchases > 1">s</span></span><span class="badge text-dark mr-2 px-0">{{ item.name }}</span></td><td align="center"  style="width:50px;vertical-align:middle;"><a href="#" class="btn btn-white" v-bind:href="\'/admin/products/\' + item.id" class="btn btn-white" style="border-radius:15px;margin-right:5px;width:30px;height:30px;padding:7px 5px 6px 7px;"><i class="fa fa-fw fa-angle-right"></i></a></td>'; ?>
            <?php $tableFooter = ' '; ?>
            <?php $tableRowConditions = "item != null && item.purchases != null && item.purchases > 0"; ?>
            <?php $noResults = '<div align="center" class="pt-4"><img src="/images/illustrations/undraw_revenue_3osh.svg" style="max-width:180px;" class="mb-3 pb-3"><p class="card-text mt-4 empty-message pt-3">Nothing here. Try adding some products.<br><a href="/admin/products" class="btn btn-primary btn-pill mt-3">Products</a></p></div>'; ?>
            <?php $tableRowNoResultsConditions = 'item.purchases == 0'; ?>
            {!! renderResourceTableHtmlDynamically(['HEADER' => $header, 'TABLE_HEADER' => $tableHeader, 'TABLE_ROW' => $tableRow, 'PATH' => '/admin/products/', 'TABLE_FOOTER' => $tableFooter, 'TABLE_ROW_CONDITIONS' => $tableRowConditions, 'TABLE_ROW_NO_RESULTS_CONDITIONS' => $tableRowNoResultsConditions, 'TABLE_ROW_NO_RESULTS_MESSAGE' => $noResults, 'WRAPPER_CLASS' => 'h-100']) !!}
        </div>
    </div>
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => URL::to('/').'/api/resources/content', 'div_id' => 'contentApp', 'LIMIT' => 5, 'SORT_STRING' => '&sort=-views&sortMethod=COUNT']) !!}
    {!! renderResourceTableScriptsDynamically(['url' => URL::to('/').'/api/resources/page', 'div_id' => 'pagesApp', 'LIMIT' => 5, 'SORT_STRING' => '&sort=-views&sortMethod=COUNT']) !!}
    {!! renderResourceTableScriptsDynamically(['url' => URL::to('/').'/api/resources/product', 'div_id' => 'productsApp', 'LIMIT' => 5, 'SORT_STRING' => '&sort=-purchases&sortMethod=COUNT']) !!}
@endsection