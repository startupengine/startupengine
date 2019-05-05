@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        td {
            line-height:28px;vertical-align: middle;
        }

        nav li.page-item {
            box-shadow:none !important;
            border:1px solid #ddd;
            border-right:0px;
        }
        nav li.page-item:last-of-type {
            border-right:1px solid #ddd;
        }

        nav li.page-item.active a {
            background:#555 !important;
        }

        nav li.page-item.active {
            border-color:#555;
        }

        nav li.page-item:hover a {
            color:#000 !important;
        }

        nav li.page-item.active:hover a {
            color:#fff !important;
        }

        .page-item a {
            color:#888;
        }

        table .badge-pill {
            min-width:80px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css">
@endsection

@section('head')

@endsection

@section('page-title') New {{ $postType->title }} @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <!-- Add New Post Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form class="add-new-post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend" >
                                <span class="input-group-text" style="width:70px;"><i class="material-icons">short_text</i>&nbsp;Title</span>
                            </div>
                            <input type="text" class="form-control form-control-lg" placeholder="Your Post Title"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width:70px;"><i class="material-icons">link</i>&nbsp;Link</span>
                            </div>
                            <input type="text" class="form-control form-control-lg" placeholder="https://..."
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div id="editor-container" class="add-new-post__editor mb-1"></div>
                    </form>
                </div>
            </div>
            <!-- / Add New Post Form -->
        </div>
        <div class="col-lg-3 col-md-12">
            <!-- Post Overview -->
            <div class='card card-small mb-3'>
                <div class="card-header border-bottom">
                    <h6 class="m-0"><i class="fa fa-list"></i>&nbsp; Details</h6>
                </div>
                <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">flag</i>
                          <strong class="mr-1">Status:</strong> Draft
                          <a class="ml-auto" href="#">Edit</a>
                        </span>
                            <span class="d-flex mb-2">
                          <i class="material-icons mr-1">visibility</i>
                          <strong class="mr-1">Visibility:</strong>
                          <strong class="text-success">Public</strong>
                          <a class="ml-auto" href="#">Edit</a>
                        </span>
                            <span class="d-flex mb-2">
                          <i class="material-icons mr-1">calendar_today</i>
                          <strong class="mr-1">Publish:</strong> Immediately
                          <a class="ml-auto" href="#">Edit</a>
                        </span>
                        </li>
                        <li class="list-group-item d-inline-block px-3" align="center">
                            <button class="btn btn-sm btn-accent" style="display:block;width:100%;">
                                <i class="material-icons">save</i> Save</button>
                            <button class="btn btn-sm btn-accent ml-auto d-none">
                                <i class="material-icons">file_copy</i> Publish</button>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Post Overview -->
            <!-- Post Overview -->
            <div class='card card-small mb-3'>
                <div class="card-header border-bottom">
                    <h6 class="m-0"><i class="fa fa-tag"></i> &nbsp;Tags</h6>
                </div>
                <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-3 pb-2">
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" id="category1" checked>
                                <label class="custom-control-label" for="category1">Uncategorized</label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="New tag" aria-label="Add new tag" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-white px-2" type="button">
                                        <i class="material-icons">add</i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- / Post Overview -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.min.js"></script>
    <script src="/admin/scripts/app/app-blog-new-post.1.0.0.js"></script>
@endsection