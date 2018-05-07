@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .card-deck .card {
            text-align:center;
            margin-bottom:25px;
            cursor:pointer;
        }
        .card-deck .card:hover {
            border-color:royalblue !important;
        }
        .card-deck .card h3{
            font-size:150%;
        }
        .card-body {
            min-height:125px !important;
        }
        .card-body h3 {
            margin-bottom:10px;
        }
        .badge {
            background:rgba(151,255,169,0.5);color:green;
            border:none;
            font-size:100%;
            padding-right:13px;
            padding-left:13px;
            padding-top:6px;
            padding-bottom:6px;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12" style="padding-top:15px;">
                <div class="card-deck">
                    <div class="card" onclick="location.href = '/app/pages';">
                        <div class="card-body">
                            <h3><i class="fa fa-file" style="font-size:80%;color:#666;"></i><br>Pages</h3>
                            <span class="badge">{{ count(\App\Page::where('status','=','ACTIVE')->get()) }} Active</span><br>
                            <span class="badge">{{ count(\App\Page::where('status','=','INACTIVE')->get()) }} Inactive</span>
                        </div>
                    </div>
                    <div class="card" onclick="location.href = '/app/content';">
                        <div class="card-body">
                            <h3><i class="fa fa-list" style="font-size:80%;color:#666;"></i><br>Content</h3>
                            <span class="badge">{{ count(\App\PostType::all()) }} Types</span><br>
                            <span class="badge"><?php $contentCount = count(\App\Post::all()); echo $contentCount; ?> Item<?php if($contentCount > 1) { echo "s"; } ?></span>
                        </div>
                    </div>
                    <div class="card" onclick="location.href = '/app/tags';">
                        <div class="card-body">
                            <h3><i class="fa fa-hashtag" style="font-size:80%;color:#666;"></i><br>Tags</h3>
                            <span class="badge">{{ count(\App\Tag::all()) }} Used</span><br>
                            <span class="badge">{{ count(\App\Post::where('post_type','=','tag')->get()) }} Customized</span>
                        </div>
                    </div>
                </div>
                <div class="card-deck">
                    <div class="card" onclick="location.href = '/app/products';">
                        <div class="card-body">
                            <h3><i class="fa fa-shopping-cart" style="font-size:80%;color:#666;"></i><br>Products</h3>
                            <span class="badge">{{ count(\App\Product::where('status','=', 'ACTIVE')->get()) }} Products</span><br>
                            <span class="badge">{{ count(\App\Plan::where('status','=', 'ACTIVE')->get()) }} Plans</span>
                        </div>
                    </div>
                    <div class="card" onclick="location.href = '/app/users';">
                        <div class="card-body">
                            <h3><i class="fa fa-user" style="font-size:80%;color:#666;"></i><br>Users</h3>
                            <span class="badge">{{ count(\App\User::all()) }} Trialing</span><br>
                            <span class="badge">{{ count(\App\User::all()) }} Paying</span>
                        </div>
                    </div>
                    <div class="card" onclick="location.href = '/app/ads';">
                        <div class="card-body">
                            <h3><i class="fa fa-bullhorn" style="font-size:80%;color:#666;"></i><br>Ads</h3>
                            <span class="badge">0 Total</span><br>
                            <span class="badge">0 Running</span>
                        </div>
                    </div>
                </div>
                <div class="card-deck">
                    <div class="card" onclick="location.href = '/app/analytics';">
                        <div class="card-body">
                            <h3><i class="fa fa-bar-chart" style="font-size:80%;color:#666;"></i><br>Weekly Engagement</h3>
                            <?php $nowDate = \Carbon\Carbon::now(); ?>
                            <?php $agoDate = $nowDate->subDays($nowDate->dayOfWeek)->subWeek();// gives 2016-01-31 ?>
                            <?php $clicks = \App\AnalyticEvent::where('event_type','=','click')->where('created_at', '>', $agoDate->toDateTimeString())->get();  ?>
                            <?php $views = \App\AnalyticEvent::where('event_type','=','page viewed')->where('created_at', '>', $agoDate->toDateTimeString())->get();  ?>
                            <span class="badge">{{ count($clicks) }} Clicks</span><br>
                            <span class="badge">{{ count($views) }} Page Views</span>
                        </div>
                    </div>
                    <div class="card" onclick="location.href = '/app/plans';">
                        <div class="card-body">
                            <h3><i class="fa fa-users" style="font-size:80%;color:#666;"></i><br>Demo<span class="hiddenOnMobile">graphic</span>s</h3>
                            <span class="badge">{{ count(\App\Demographic::all()) }} Defined</span><br>
                            <span class="badge">{{ count(\App\Demographic::all()) }} Active</span>
                        </div>
                    </div>
                    <div class="card" onclick="location.href = '/app/subscriptions';">
                        <div class="card-body">
                            <h3><i class="fa fa-credit-card" style="font-size:80%;color:#666;"></i><br>Revenue</h3>
                            <?php  $customers = \App\Subscription::where('ends_at','=',null)->get()->groupBy('user_id'); ?>
                            <?php foreach($customers as $customer) {
                                $values  = collect($customer->sum('price'));
                            }
                            $average = $values->avg()/100;
                            ?>
                            <span class="badge">${{ $average }} / User </span><br>
                            <span class="badge">${{ \App\Subscription::where('ends_at','=',null)->get()->sum('price')/100 }} / Monthly</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
