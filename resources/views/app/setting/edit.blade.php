@extends('layouts.app')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media(max-width:991px) {
            .sidebar {
                display:none;
            }
        }
        @media(min-width:991px) {
            .mobile-nav {
                display:none;
            }
        }
    </style>
@endsection

@section('content')
    <body class="index-page sidebar-collapse bg-gradient">
    <div class="container-fluid" style="margin-top:15px;">
        <div class="card" style="min-height: calc(100vh - 30px);">
            <div class="card-header" style="padding-left:25px;" align="right">
                <div style="position:absolute;left:25px;top:25px;">Admin Panel</div>
                @include('app.admin-menu')
            </div>
            <div class="row">
                @include('app.admin-sidebar')
                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <div class="main col-md-12" style="background:none;margin-top:25px;">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="card" style="box-shadow:none;">
                                    <h5>Edit Setting</h5>
                                </div>
                            </div>
                            <form action="/app/edit/setting" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="settingDisplayName">Display Name</label>
                                        <input  value="{{$setting->display_name}}" type="text" class="form-control" id="display_name" aria-describedby="settingDisplayName" placeholder="What should this setting be called?" name="display_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="settingKey">Key</label>
                                        <input @if(isset($setting->key)) disabled @endif value="{{$setting->key}}" type="text" class="form-control" id="key" aria-describedby="settingKey" placeholder="site.main_color" name="key">
                                    </div>

                                    <div class="form-group">
                                        <label for="settingValue">Value</label>
                                        @if($setting->type == "text")
                                            <input  value="{{$setting->value}}" type="text" class="form-control" id="value" aria-describedby="settingValue" placeholder="Value goes here" name="value">
                                        @endif
                                        @if($setting->type == "textarea")
                                            <textarea class="form-control" id="value" aria-describedby="settingValue" placeholder="Value goes here" name="value">{{$setting->value}}</textarea>

                                            <script>
                                                var simplemde = new SimpleMDE({ element: document.getElementById("value"), status: false, toolbar: false });
                                            </script>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="settingStatus">Status</label><br>
                                        <select class="custom-select" id="status" name="status" aria-describedby="settingStatus" style="width:100%;">
                                            <option value="PRIVATE" <?php if($setting->status == "PRIVATE" ) { echo "selected"; } ?> >Private</option>
                                            <option value="PUBLISHED" <?php if($setting->status == "PUBLISHED" ) { echo "selected"; } ?> >Published</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id" value="{{$setting->id}}"?>
                                    <div align="right" style="margin-bottom:35px;">
                                        <button type="submit" class="btn btn-secondary-outline ">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>


    </body>
@endsection