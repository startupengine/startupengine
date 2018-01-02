@extends('layouts.admin')

@section('title')
    Settings
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
@endsection

@section('content')
    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-6">
                <h5>Edit Setting</h5>
            </div>
            <form action="/app/edit/setting" method="post">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="settingDisplayName">Display Name</label>
                        <input value="{{$setting->display_name}}" type="text" class="form-control"
                               id="display_name" aria-describedby="settingDisplayName"
                               placeholder="What should this setting be called?" name="display_name">
                    </div>
                    <div class="form-group">
                        <label for="settingKey">Key</label>
                        <input @if(isset($setting->key)) disabled @endif value="{{$setting->key}}"
                               type="text" class="form-control" id="key" aria-describedby="settingKey"
                               placeholder="site.main_color" name="key">
                    </div>

                    <div class="form-group">
                        <label for="settingValue">Value</label>
                        @if($setting->type == "text")
                            <input value="{{$setting->value}}" type="text" class="form-control" id="value"
                                   aria-describedby="settingValue" placeholder="Value goes here"
                                   name="value">
                        @endif
                        @if($setting->type == "textarea")
                            <textarea class="form-control" id="value" aria-describedby="settingValue"
                                      placeholder="Value goes here"
                                      name="value">{{$setting->value}}</textarea>

                            <script>
                                var simplemde = new SimpleMDE({
                                    element: document.getElementById("value"),
                                    status: false,
                                    toolbar: false
                                });
                            </script>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="settingStatus">Status</label><br>
                        <select class="custom-select" id="status" name="status"
                                aria-describedby="settingStatus" style="width:100%;">
                            <option value="PRIVATE" <?php if ($setting->status == "PRIVATE") {
                                echo "selected";
                            } ?> >Private
                            </option>
                            <option value="PUBLISHED" <?php if ($setting->status == "PUBLISHED") {
                                echo "selected";
                            } ?> >Published
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="id" id="id" value="{{$setting->id}}" ?>
                    <div align="right" style="margin-bottom:35px;">
                        <button type="submit" class="btn btn-secondary-outline ">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection