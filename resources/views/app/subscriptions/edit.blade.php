@extends('layouts.admin')

@section('title')
    Edit Content Item
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <script src="https://unpkg.com/vue-multiselect@2.0.6"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
    <style>
        .nav-tabs {
            padding-left: 15px;
            padding-right: 15px;
        }

        .variation:first-of-type .delete-button {
            display: none !important;
        }

        .nav-link.active {
            border-color: #ddd !important;
            color: #444 !important;
        }

        .tag-select {
            overflow:visible !important;
        }

        .tag-select input {
            height:20px !important;
        }
        .tag-select input:hover,.tag-select input:focus {
            border:none !important;
        }

        .input-group-focus > .input-group-addon, input:focus {
            border-color:orangered !important;
        }
        .input-group-addon{
            background:#eee;
            padding-right:12px !important;
        }
        .input-group input:hover, .input-group input:focus {
            background:#fff;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <form action="/app/edit/product" method="post">
                <div class="col-md-12">
                    <h5>@if($product->id == null) Add @endif @if($product->id !== null)  <span style="opacity:0.5;">Editing </span> @endif Product
                        {!! button(null, "Save Changes", "save", "pull-right", null, null, "button") !!}
                    </h5>

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postTitle">Title</label>
                                <input required
                                       value="{{$product->name}}"
                                       class="form-control"
                                       id="name"
                                       aria-describedby="postTitle" placeholder="Enter a title"
                                       name="name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postSlug">Stripe ID</label>
                                <input required value="{{$product->stripe_id}}" type="text" class="form-control"
                                       id="stripe_id"
                                       name="stripe_id" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postStatus">Status</label><br>
                                <select required class="custom-select" id="status" name="status"
                                        aria-describedby="postStatus" style="width:100%;">
                                    <option <?php if ($product->status == "ACTIVE") {
                                        echo "selected";
                                    } ?> value="ACTIVE">Active
                                    </option>
                                    <option <?php if ($product->status == "INACTIVE") {
                                        echo "selected";
                                    } ?> value="INACTIVE">Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="postStatus">Product Details</label>
                            <div class="form-group">




                                <a class="list-group-item list-group-item-action">


                                    <label>Image</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-camera"></i>
                                                </span>
                                        <input id="image" name="image" placeholder="https://..." style="border-radius:0px 25px 25px 0px !important;" class="form-control" value="{{ $product->image }}"/>
                                    </div>



                                </a>
                                <a class="list-group-item list-group-item-action">


                                    <label>Description</label>{{ ucfirst($product->discription) }}
                                    <textarea class="form-control" id="description" name="description">{{ ucfirst($product->description) }}</textarea>

                                </a>
                                <a class="list-group-item list-group-item-action">


                                    <label>Priority</label>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-star"></i>
                                                </span>
                                        <input id="priority" name="priority" placeholder="i.e. 1, 2, 3..." style="border-radius:0px 25px 25px 0px !important;" class="form-control" value="{{ $product->priority }}"/>
                                    </div>



                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postStatus">Pricing Plans</label><br>
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action" style="border-bottom:2px solid green;background:rgba(151,255,169,0.06);color:green;" data-toggle="modal" data-target="#newSubscription">New Plan <i class="fa fa-plus pull-right" style="color:green;margin-left:10px;margin-top:3px;"></i></a>
                                    @foreach(getStripePlans($product->stripe_id)->data as $plan)


                                        <a href="/app/view/subscription/{{$product->id}}/plan/{{$plan->id}}" class="list-group-item list-group-item-action">{{ $plan->nickname }} {{ ucfirst($plan->interval)}}ly - ${{ $plan->amount/100 }} <i class="fa fa-caret-right pull-right" style="margin-top:3px;"></i></a>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id" value="{{$product->id}}" ?>

                </div>
        </div>
        </form>
    </main>
    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default
            },
            data: {
                value: [

                ],
                options: [
                ]
            },
            methods: {
                addTag (newTag) {
                    const tag = {
                        name: newTag,
                        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                    }
                    this.options.push(tag)
                    this.value.push(tag)
                }
            }
        }).$mount('#tags')
    </script>
    <script>

        var currentCard;

        function duplicateVariation(object) {
            currentCard = object.parents('.variation');
            currentCard.clone().insertAfter(currentCard);
            updateIndexes();
            console.log('duplicateVariation');
        }

        function selectVariation(object) {
            currentCard = object.parents('.variation');
            //currentCard.remove();
            console.log('selectVariation');
        }

        function deleteConfirmation(object) {
            console.log(object);
            $("#deleteVariation").modal("toggle");
            currentCard = object.parents().closest('.variation');
            console.log('deleteConfirmation');
        }

        function deleteVariation(object) {
            currentCard.remove();
            //object.parents('.variation').remove();
            $("#deleteVariation").modal("toggle");
            updateIndexes();
            console.log('deleteVariation');
        }

        function updateIndexes() {
            count = $('.variation').length;
            console.log(count);
            var variation = 0;
            $(".variation").each(function () {
                variation = variation + 1;
                $(this).attr('data-variation', variation);
                $(this).children().closest('.card-header').html('Variation ' + variation);
            });
            updateInputs();
            updateButtons();
            updateTabPanes();
            console.log('updateIndexes');
        }

        function updateInputs() {
            $(".variation :input").each(function () {
                var variation = $(this).parents().closest('.variation').attr('data-variation');
                var section = $(this).attr('data-section');
                var field = $(this).attr('data-field');
                var string = ('json[versions][' + variation + '][' + section + '][' + field + ']');
                $(this).attr('name', string);
            });
        }

        function updateButtons() {
            $(".variation .nav-link").each(function () {
                var variation = $(this).parents().closest('.variation').attr('data-variation');
                var section = $(this).attr('data-section');
                var string = ('#' + variation + section);
                $(this).attr('href', string);
            });
        }

        function updateTabPanes() {
            $(".variation .tab-pane").each(function () {
                var variation = $(this).parents().closest('.variation').attr('data-variation');
                var section = $(this).attr('data-section');
                var string = (variation + section);
                $(this).attr('id', string);
            });
        }

        function enableTabs() {
            $('.variation a.nav-link').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        }

        $(document).ready(function () {

            $(".nav-link").click(function () {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });

            $(".duplicate-button").click(function () {
                //$(this).addClass("active");
                //duplicateVariation($(this));
                console.log($(this));
            });

            $(".delete-button").click(function () {
                //$(this).addClass("active");
                //deleteVariation($(this));
                console.log($(this));
            });
        });
    </script>
@endsection

@section('modals')

    <!-- Modal Core -->
    <div class="modal fade" id="newSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form action="/app/new/subscription/plan" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 style="margin-top:0px;" class="modal-title" id="myModalLabel">New Plan for {{ $product->name }}</h4>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <p>Keep in mind that you will not be able to edit this plan's billing details after you create it.</p>
                        </div>
                        <div class="form-group">
                            <label for="productName">Plan Nickname</label><br>
                            <input name="nickname" class="form-control" placeholder="i.e. Basic" autocomplete="off"/>
                        </div>

                        <div class="form-group">
                            <label>Bill the customer every...</label>
                            <select class="form-control" name="interval">
                                <option value="year">Year</option>
                                <option value="month" selected>Month</option>
                                <option value="week">Week</option>
                                <option value="day">Day</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productName">Amount</label><br>
                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                            </span>
                                <input name="amount" id="amount" placeholder="99..." style="border-radius:0px !important;" class="form-control" />
                                <span class="input-group-addon" style="padding-left:15px;padding-right:15px !important;font-size:80%;">
                                    .00
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="product_id" value="{{$product->id}}" ?>
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-secondary" id="installButton">Continue &nbsp;<i class="fa fa-caret-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection