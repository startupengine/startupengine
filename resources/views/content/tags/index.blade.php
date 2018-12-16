@extends('layouts.shards_frontend')

@section('php-variables')
    <?php $viewOptions['splash-height'] = '300px'; ?>
@endsection

@section('title')
    {{ $tag->name}}
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection

@section('css')
    <style>
        .card {
            min-height: 500px !important;
        }

        .page-link {
            background: #fff !important;
        }

        .page-item.active .page-link {
            background: #000 !important;
            border-color: #000 !important;
        }
    </style>
@endsection

@section('navbar-classes')
    dark filled
@endsection

@section('splash-class')
    minimal
@endsection


@section('content')

    <!-- Related Content Section -->
    <div class="blog section section-invert py-4" style="min-height:100vh;">
        <h3 class="section-title text-center mb-5 mt-3">{{ $tag->name }}</h3>

        <div class="container">
            <div class="py-4 mb-3 col-md-12">


                <div class="row justify-content-center" id="contentApp" v-if="info != null">
                    {!! renderResourceTableHtmlDynamically(['CARD_CLASS' => 'card', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_CONTAINER_CLASS' => 'col-md-4 mb-4', 'WRAPPER_CLASS' => null, 'SHOW_TIMESTAMP' => true,  'SHOW_TAGS' => false,'SHOW_PAGINATION' => true, 'CARD_ROW_CLASS'=> 'justify-content-center', 'PATH' => '/content']) !!}
                </div>


            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "SORT_BY" => 'views', 'WITH_ANY_TAGS' => "{'$tag->slug':'$tag->slug'}"]) !!}
@endsection