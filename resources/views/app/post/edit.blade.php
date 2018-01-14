@extends('layouts.admin')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <script src="https://unpkg.com/vue-multiselect@2.0.6"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
    <style>
        #tags {
            overflow:visible !important;
        }

        #tags input {
            height:20px !important;
        }
        #tags input:hover,#tags input:focus {
            border:none !important;
        }
    </style>
@endsection

@section('content')

    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <form action="/app/new/post" method="post" style="width:100%;">
        <div class="col-md-12 main">
            <div class="col-md-12">
                <h5>Edit {{ $postType->title }}
                    {!! button(null, "Save Changes", "save", "pull-right", null, null, "button") !!}
                </h5>

                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postTitle">Title</label>
                                <input autocomplete="off" value="{{$post->title}}" type="text" class="form-control"
                                       id="title"
                                       required
                                       aria-describedby="postTitle" placeholder="Enter a title"
                                       name="title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postSlug">Slug</label>
                                <input autocomplete="off" value="{{$post->slug}}" type="text" class="form-control"
                                       id="slug"
                                       required
                                       aria-describedby="postSlug" placeholder="example-slug" name="slug">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postStatus">Status</label><br>
                                <select class="custom-select" id="status" name="status"
                                        aria-describedby="postStatus" style="width:100%;">
                                    <option <?php if ($post->status == "PUBLISHED") {
                                        echo "SELECTED";
                                    } ?> value="PUBLISHED">Published
                                    </option>
                                    <option <?php if ($post->status == "DRAFT") {
                                        echo "SELECTED";
                                    } ?> value="DRAFT">Draft
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postStatus">Publish Date</label><br>
                                <?php if ($post->published_at == null) {
                                    $date = \Carbon\Carbon::now()->format("m/d/Y");
                                } else {
                                    $date = $post->published_at->format("m/d/Y");
                                } ?>
                                <input autocomplete="off" type="text" class="form-control date-picker" value="{{$date}}"
                                       name="published_at">
                            </div>
                        </div>


                    </div>

                    @include('app.partials.post-fields')


                    <div class="card" id="tags">
                        <div class="card-header">Tags</div>
                        <div class="card-footer" align="left">
                            <!-- Vue component -->
                            <multiselect v-model="value" tag-placeholder="Add this as new tag"
                                         placeholder="Search or add a tag" label="name" track-by="code"
                                         :options="options" :multiple="true" :taggable="true" @tag="addTag"
                            ></multiselect>
                            <textarea name="tags" style="display:none;"/>@{{ value  }}</textarea>
                            <?php /* <pre class="language-json"><code>@{{ value  }}</code></pre> */ ?>


                        </div>
                    </div>



                <div align="right" style="margin-bottom:35px;">
                        <input type="hidden" name="id" value="{{$post->id}}"/>
                        <input type="hidden" name="post_type" value="{{$post->post_type}}"/>
                    </div>

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
                        @if($post->tagNames() !== null)
                        <?php $total = count($post->tagNames()); ?>
                        <?php $tagcount = 1;?>

                        @foreach($post->tagNames() as $tag)
                    { name: '{{$tag}}' }@if($tagcount >= $total = 1) , @endif
                    <?php $tagcount = $tagcount + 1;?>
                    @endforeach

                    @endif
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

        $(document).ready(function () {
            $(".nav-link").click(function () {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });
            $('.date-picker').each(function () {
                $(this).datepicker({
                    templates: {
                        leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
                        rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
                    }
                }).on('show', function () {
                    $('.datepicker').addClass('open');

                    datepicker_color = $(this).data('datepicker-color');
                    if (datepicker_color.length != 0) {
                        $('.datepicker').addClass('datepicker-' + datepicker_color + '');
                    }
                }).on('hide', function () {
                    $('.datepicker').removeClass('open');
                });
            });
        });
    </script>

@endsection