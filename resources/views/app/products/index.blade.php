@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media (max-width: 991px) {
            .sidebar {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .mobile-nav {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .hiddenOnMobile {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .hiddenOnDesktop {
                display: none !important;
            }
        }

        .badge-status {
            background: #555;
            border: 1px solid #555;
            color: #fff;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .badge-status-disabled {
            background: #999;
            border: 1px solid #999;
            color: #fff;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }

        .badge-date, .badge-category {
            background: #fff;
            border: 1px solid #999;
            color: #999;
            min-width: 100px;
            padding: 3px 8px;
            font-weight: 400;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">
                    Products
                    {!! button(null, "New Product", "new", "pull-right", null, 'data-toggle="modal" data-target="#newSubscription"') !!}
                </h5>
                <div class="form-group">
                    <form>
                        <input type="text" value="" placeholder="Search Subscriptions..." class="form-control"
                               name="s" id="s">
                    </form>
                </div>
                <table class="table ">
                    <thead class="hiddenOnMobile">
                    <tr>
                        <th scope="col" class="hiddenOnMobile updated_at_column">Status</th>
                        <th scope="col">Info</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td class="hiddenOnMobile updated_at_column clickable"><span
                                        class="badge badge-date">{{ $subscription->status }}</span>
                            </td>
                            <td class="clickable">{{$subscription->json()->name}}<br><span style="opacity:0.5;">{{ucfirst($subscription->json()->type)}}</span></td>
                            <td align="right">
                                <a href="/app/view/subscription/{{ $subscription->id }}"
                                   class="btn btn-sm btn-secondary-outline hiddenOnDesktop">View</a>
                                <div class="btn-group hiddenOnMobile" role="group"
                                     aria-label="Basic example">
                                    <a href="/app/view/subscription/{{ $subscription->id }}"
                                       class="btn btn-sm btn-secondary-outline"
                                    >Edit</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>


@endsection

@section('modals')

    <!-- Modal Core -->
    <div class="modal fade" id="newSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form action="/app/new/Subscription" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">New Subscription</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <p>Give your new product a name.</p>
                        </div>
                        <div class="form-group">
                            <label for="productName">Name</label><br>
                            <input name="url" class="form-control" placeholder="i.e. Basic Subscription" autocomplete="off"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-secondary" id="installButton">Continue &nbsp;<i class="fa fa-caret-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="deleteSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Once you delete this post, it will be unavailable unless an administrator un-deletes it.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="deleteButton">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="syncSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Resetting the Subscription will change any settings you've tweaked to their default states.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-secondary" id="resetButton">Reset Subscription</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="updateSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p>Editing the Subscription will result in changes on your site. Be sure you know what you're installing. @if(env('APP_PLATFORM') == 'heroku') Changes will appear the next time the site is deployed.@endif</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-secondary" id="syncButton">Update Subscription</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="SubscriptionInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 style="margin-top:0px;" class="modal-title" id="SubscriptionName"></h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <p id="SubscriptionVersion" class="badge badge-category"></p>
                        <p id="SubscriptionDescription" style="margin-top:10px;"></p>
                        <p><a href="#" id="SubscriptionUrl" target="_blank" style="text-decoration: none;">View the git
                                repository for this Subscription</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection