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

        .input-group input:hover, .input-group input:focus {
            border-left:none !important;
            background:#fff;
        }
        .input-group-focus > .input-group-addon, input:focus {
            border-color:orangered !important;
        }
        .input-group-addon{
            background:#eee;
            padding-right:12px !important;
        }
    </style>
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <form action="/app/edit/product/plan" method="post">
                <div class="col-md-12">
                    <h5>@if($product->id == null) Add @endif @if($product->id !== null) <span style="opacity:0.5;">Editing </span>@endif Plan
                        {!! button(null, "Save Changes", "save", "pull-right", null, null, "button") !!}
                    </h5>

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postTitle">Plan Nickname</label>
                                <input required
                                       value="{!!$plan->json()->nickname!!}"
                                       class="form-control"
                                       id="title"
                                       aria-describedby="postTitle" placeholder="Enter a nickname"
                                       name="nickname">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postSlug">Plan ID</label>
                                <input required value="{{$plan->stripe_id}}" type="text" class="form-control"

                                       aria-describedby="postSlug" placeholder="example-slug"  disabled>
                                <input required value="{{$plan->stripe_id}}" type="hidden" class="form-control"
                                       id="plan_id"
                                       name="plan_id"
                                       aria-describedby="postSlug" placeholder="example-slug"  >
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
                            <label for="postStatus">Plan Details</label>
                            <div class="form-group">

                                    <a class="list-group-item list-group-item-action">


                                        <label>Image</label>
                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-camera"></i>
                                                </span>
                                            <input name="image" id="image" style="border-radius:0px 25px 25px 0px !important;" class="form-control" placeholder="https://..." value="{{ $plan->image }}"/>
                                        </div>



                                    </a>
                                    <a class="list-group-item list-group-item-action">


                                        <label>Description</label>
                                        <textarea name="description" class="form-control">{{ ucfirst($plan->discription) }}</textarea>

                                    </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="postStatus">Billing</label>
                            <div class="form-group">


                                <a class="list-group-item list-group-item-action">
                                    <label>Bill the customer every...</label>
                                    <select class="form-control">
                                        <option value="year" @if($plan->json()->interval == "year") selected @endif>Year</option>
                                        <option value="month" @if($plan->json()->interval == "month") selected @endif>Month</option>
                                        <option value="week" @if($plan->json()->interval == "week") selected @endif>Week</option>
                                        <option value="day"@if($plan->json()->interval == "day") selected @endif>Day</option>
                                    </select>
                                </a>
                                <a class="list-group-item list-group-item-action">


                                    <label>Cost</label>
                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-dollar"></i>
                                            </span>
                                        <input id="amount" placeholder="$99.00" style="border-radius:0px 25px 25px 0px !important;" class="form-control" value="{{ ucfirst($plan->json()->amount/100) }}.00"/>
                                    </div>



                                </a>

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
    <div class="modal fade" id="deleteVariation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        <p>Deleting a variation cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="deleteButton" onclick="deleteVariation();"
                       data-toggle="modal" data-target="#deleteVariation">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection