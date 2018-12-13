@extends('layouts.shards_admin')

@section('title') <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        .card-header {
            border-bottom:1px solid #ddd;
        }

        a.mb-4:last-child {
            margin-bottom:0px !important;
        }
    </style>
@endsection

@section('page-title') Search Results @if(isset($request) && $request->input('s') != null) <br><h5 class="mt-4" style="opacity:0.5;">You searched for "{{ $request->input('s') }}"</h5> @endif @endsection

@section('content')
    @if(isset($content) && !$content->isEmpty() && $request->input('s') !== null)
    <div class="row mb-3" id="contentResults">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Content</h6>
                </div>
                <div class="card-body">
                    @if(!isset($content) OR $content->isEmpty())
                        <p class="card-text">
                            No results.
                        </p>
                    @else
                        @foreach($content as $item)
                            @if($item->title !== null)
                                <p>
                                    <a href="/admin/content/view/{{ $item->postType()->slug }}/{{ $item->id }}" class="btn btn-outline-secondary">{{ $item->title }}</a>
                                </p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($users) && !$users->isEmpty() && $request->input('s') !== null)
    <div class="row mb-3" id="userResults">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Users</h6>
                </div>
                <div class="card-body">
                    @if(!isset($users) OR $users->isEmpty())
                        <p class="card-text">
                            No results.
                        </p>
                    @else
                        @foreach($users as $user)
                                <a href="/admin/users/{{ $user->id }}" class="mb-4 p-0 d-block">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-secondary" style="background:url('{{ $user->avatar() }}');background-size:cover;background-position:center;">&nbsp;</button>
                                        <button type="button" class="btn btn-outline-secondary">{{ ucwords($user->name) }} <span class="hiddenOnMobile" style="opacity:0.5;">{{ $user->email }}</span></button>
                                    </div>
                                </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($products) && !$products->isEmpty() && $request->input('s') !== null)
    <div class="row mb-3" id="productResults">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Products</h6>
                </div>
                <div class="card-body">
                    @if(!isset($products) OR $products->isEmpty())
                        <p class="card-text">
                            No results.
                        </p>
                    @else
                        @foreach($products as $product)
                            <p class="card-text">
                                <a href="/admin/products/{{ $product->id }}" class="btn btn-outline-secondary">{{ ucwords($product->name) }}</a>
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($postTypes) && !$postTypes->isEmpty() && $request->input('s') !== null)
        <div class="row mb-3" id="productResults">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Content Models</h6>
                    </div>
                    <div class="card-body">
                        @foreach($postTypes as $postType)
                            <p class="card-text">
                                <a href="/admin/settings/content/model/{{ $postType->id }}/edit" class="btn btn-outline-secondary">{{ ucwords($postType->title) }}</a>
                            </p>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(isset($pages) && !$pages->isEmpty() && $request->input('s') !== null)
    <div class="row mb-3" id="pageResults">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Pages</h6>
                </div>
                <div class="card-body">
                    @if(!isset($pages) OR $pages->isEmpty())
                        <p class="card-text">
                            No results.
                        </p>
                    @else
                        @foreach($pages as $page)
                            <p>
                                <a href="/admin/pages/{{ $page->id }}" class="btn btn-outline-secondary">{{ $page->title}} @if($page->slug !== null) <span class="hiddenOnMobile" style="opacity:0.5;">/{{ $page->slug }}</span>@endif</a>
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($settings) && !$settings->isEmpty() && $request->input('s') !== null)
    <div class="row mb-3" id="settingResults">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Settings</h6>
                </div>
                <div class="card-body">
                    @if(!isset($settings) OR $settings->isEmpty())
                        <p class="card-text">
                            No results.
                        </p>
                    @else
                        @foreach($settings as $setting)
                            <p>
                                <a href="/admin/settings/{{ $setting->key }}" class="btn btn-outline-secondary" ><span style="text-transform:capitalize;">{{ $setting->key }}</span> @if($setting->display_name !== null)<span class="hiddenOnMobile" style="opacity:0.5;">{{ $setting->display_name }}</span>@endif</a>
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( isset($settings) && $settings->isEmpty() && isset($content) && $content->isEmpty() && isset($pages) && $pages->isEmpty() && isset($users) && $users->isEmpty() && isset($products) && $products->isEmpty() && isset($postTypes) && $postTypes->isEmpty() )
        <div class="row mb-3" id="settingResults">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-body">

                            <p class="card-text">
                                No results. Try searching for something else.
                            </p>

                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')
    <script>
        var socialFeed = new Vue({
            el: '#app #socialFeed',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/dashboard/social')
                    .then(response => (this.info = response.data));
            }
        })

        var socialFeed = new Vue({
            el: '#app #recentContent',
            data () {
                return {
                    info: null
                }
            },
            mounted () {
                axios
                    .get('http://127.0.0.1:8000/api/demo/dashboard/content')
                    .then(response => (this.info = response.data));
            }
        })
    </script>
@endsection