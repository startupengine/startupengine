@extends('layouts.admin')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5>@if($role->id == null) Add @endif @if($role->id !== null) Edit @endif Role</h5>
                <form action="/app/edit/page" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postTitle">Display Name</label>
                                <input required value="@if($role->display_name !== null){{$role->display_name}}"
                                       @endif type="text" class="form-control"
                                       id="title"
                                       aria-describedby="postTitle" placeholder="Enter a title"
                                       name="title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postSlug">Name (slug)</label>
                                <input required value="{{$role->name}}" type="text" class="form-control"
                                       id="slug"
                                       aria-describedby="postSlug" placeholder="example-slug" name="slug">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postStatus">Status</label><br>
                                <select required class="custom-select" id="status" name="status"
                                        aria-describedby="postStatus" style="width:100%;">
                                    <option <?php if ($role->status == "ACTIVE") {
                                        echo "selected";
                                    } ?> value="ACTIVE">Active
                                    </option>
                                    <option <?php if ($role->status == "INACTIVE") {
                                        echo "selected";
                                    } ?> value="INACTIVE">Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postStatus">Publish Date</label><br>
                                <?php if ($role->published_at == null) {
                                    $date = \Carbon\Carbon::now()->format("m/d/Y");
                                } else {
                                    $date = $role->published_at->format("m/d/Y");
                                } ?>
                                <input autocomplete="off" type="text" class="form-control date-picker" value="{{$date}}"
                                       name="published_at">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label style="margin-bottom:10px;">Permissions</label>
                        @foreach($permissions as $key => $value)
                            @if($key !== null && $key !== '')
                                <div class="card">
                                    <div class="card-header" align="left"
                                         style="text-align:left;">{{ ucfirst($key) }}</div>

                                    <div class="meta-fields card-body" id="meta" role="tabpanel"
                                         align="left" style="min-height:50px !important;">
                                        @foreach($value as $item)
                                            <div class="checkbox">
                                                <?php $fieldname = $item->name; $input = null;?>
                                                <input
                                                        id="{{$fieldname}}"
                                                        type="checkbox"
                                                        aria-describedby="{{$key}}"
                                                        name="{{$fieldname}}"
                                                        @if($role->hasPermissionTo($item->name, $key)) checked="" @endif />
                                                <label for="{{$fieldname}}">
                                                    {{ ucwords(str_replace('_', ' ', $item->name )) }}<br>
                                                </label>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>

                            @endif
                        @endforeach
                    </div>
                    <input type="hidden" name="id" id="id" value="{{$role->id}}" ?>
                    <div align="right" style="margin-bottom:35px;">
                        <button type="submit" class="btn btn-secondary-outline ">Save</button>
                    </div>
            </div>
            </form>
        </div>
        </div>
    </main>


    <script>
        var currentCard;
        function duplicateVariation(object) {
            currentCard = object.parent().closest('.variation');
            currentCard.clone().insertAfter(currentCard);
            updateIndexes();
        }
        function selectVariation(object) {
            currentCard = object.parent().closest('.variation');
            currentCard.remove();
        }
        function deleteConfirmation(object) {
            $("#deleteVariation").modal("toggle");
            currentCard = object.parent().closest('.variation');
        }

        function deleteVariation(object) {
            currentCard.remove();
            $("#deleteVariation").modal("toggle");
            updateIndexes();
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
                    <a href="#" class="btn btn-danger" id="deleteButton" onclick="deleteVariation();">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection