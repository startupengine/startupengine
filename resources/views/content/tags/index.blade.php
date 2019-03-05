@extends('layouts.shards_frontend')

@section('php-variables')
    <?php
    $viewOptions['navbar-classes'] = ['dark'];
    $viewOptions['navbar-scroll-add-classes'] = ['dark'];
    $viewOptions['navbar-unscroll-remove-classes'] = [];
    ?>
    <?php $viewOptions['splash-height'] = '300px'; ?>
@endsection

@section('title')
    {{ $tag->name}}
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
@endsection

@section('css')
    <style>
        #contentApp {
            display: inline-table !important;
            width: 100% !important;
        }
    </style>
@endsection

@section('navbar-classes')
    filled
@endsection

@section('splash-class')
    minimal
@endsection


@section('content')

    <!-- Related Content Section -->
    <div class="blog section section-invert pt-4 pb-0" style="min-height:100vh;">
        <h3 class="section-title text-center mb-5 mt-3">{{ $tag->name }}</h3>

        <div class="container-fluid">
            <div class="pt-0 mb-0 col-md-12">
                <div class="justify-content-center" id="contentApp" v-if="info != null && info.meta.total != null">
                    <div class="pb-3 mb-3 toggleVisibility text-center " v-bind:class="{ visible: info.meta.total != null,  'd-block': info.meta.total != null }">@{{ info.meta.total }} Item<span v-if="info.meta.total >1 ">s</span></div>
                    {!! renderResourceTableHtmlDynamically(['CARD_CLASS' => 'card', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_CONTAINER_CLASS' => 'col-md-4 mb-4', 'WRAPPER_CLASS' => null, 'SHOW_TIMESTAMP' => true,  'SHOW_TAGS' => false,'SHOW_PAGINATION' => true, 'CARD_ROW_CLASS'=> 'justify-content-center', 'PATH' => '/content']) !!}
                </div>


            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "SORT_BY" => 'views', 'WITH_ANY_TAGS' => "{'$tag->slug':'$tag->slug'}", "PER_PAGE" => 10, "LIMIT" => 100]) !!}
@endsection