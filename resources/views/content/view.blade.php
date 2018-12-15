@extends('layouts.shards_frontend')

@section('title')
    {{ $post->title }}
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection


@section('splash-style')
    background-image:url('{{ $post->thumbnail() }}');
@endsection


@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row">
            <div class="col-md-12 mx-3 mb-3">
                <h1 class="welcome-heading display-4 text-white">{{ $post->title }}</h1>
                <p class="text-white pt-2" style="font-size:130%;">{{ $post->excerpt() }}
                @if(count($post->tags) > 0)
                    <div class="pb-1 pt-0 mt-0">
                        <?php $tagCount = 1; ?>
                        @if(count($post->tags) > 0)
                            <span class="px-3 py-2 badge badge-light text-dark badge-pill mb-1">Topics</span>
                        @endif
                        @foreach($post->tags as $tag)
                            @if($tagCount <= 3)
                                    <a class="tag-link" href="/content/tags/{{ $tag->slug }}" <?php /* data-toggle="popover" data-offset="0 0 0 10" data-placement="top" data-html="true" data-trigger="hover"  data-content="<div align='center'>Click to view more.</div>" */ ?>><span class="px-3 py-2 badge badge-dark badge-pill mb-1">{{ $tag->name }}</span></a>
                                <?php $tagCount = $tagCount + 1; ?>
                            @endif
                        @endforeach
                        <?php $remaining = count($post->tags) - 3; ?>
                        @if($remaining > 0)
                            <span class="px-3 py-2 badge badge-dark badge-pill mb-1">+ {{ $remaining }} more</span>
                        @endif
                    </div>
                    @endif
                    </p>
                    <a href="#content" class="mt-1 btn btn-md btn-outline-white btn-pill align-self-center"
                       onclick="$('html, body').animate({scrollTop: $('#content').offset().top -85}, 500);">Read More</a>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')
    <?php $sectionCount = 1; ?>
    <main id="content">
        @if(isset($post->schema()->sections))
            @foreach($post->schema()->sections as $section)

                @if($post->sectionHasContent($section->slug, [$post->thumbnailField()]))
                    <div class="blog section section-invert py-2  @if($sectionCount == 1) firstSection @endif">
                        <?php $sectionCount = $sectionCount + 1; ?>
                        <h3 class="section-title text-center m-5 d-none">{{ $section->title }}</h3>
                        <div class="container">
                            <div class="py-3 my-4" align="left">
                                <?php $count = 0; ?>
                                <?php $slug = $section->slug; ?>
                                @if(isset($post->content()->sections->$slug->fields))
                                    @foreach($post->content()->sections->$slug->fields as $field => $data)
                                        @if( isset(($section->fields->$field->type)) && ($section->fields->$field->type == 'text' OR $section->fields->$field->type == 'textarea') && $data != null)
                                            <?php $count = $count + 1; ?>
                                            <div class="row justify-content-center @if($count == 1) firstContentRow @endif">
                                                <div class="contentField {{  $section->fields->$field->type }}-field col-md-12 py-2 px-4 mb-3 text-left">
                                                    {{ $data }}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($section->fields->$field->type) && $section->fields->$field->type == 'image' && $data != null && $post->thumbnailField(true) !== "sections->".$section->slug."->fields->$field")
                                            <?php $count = $count + 1; ?>
                                            <div class="row justify-content-center  @if($count == 1) firstContentRow @endif"
                                                 align="center">
                                                <div class="contentField {{  $section->fields->$field->type }}-field  col-md-12 py-0 my-0 bg-image"
                                                     style="background-image:url('{{ $data }}');">
                                                    <img src="{{ $data }}" class="img-fluid rounded"
                                                         style="max-height:90vh;max-width:calc(100% - 30px);opacity:0;"/>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($section->fields->$field->type) && $section->fields->$field->type == 'richtext' && $data != null)
                                            <?php $count = $count + 1; ?>
                                            <div class="row justify-content-center @if($count == 1) firstContentRow @endif">
                                                <div class="contentField {{  $section->fields->$field->type }}-field  col-md-12 py-2 px-4 mb-3 text-left">
                                                    {!! $data !!}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($section->fields->$field->type) && $section->fields->$field->type == 'code' && $data != null)
                                            <?php $count = $count + 1; ?>
                                            <div class="row justify-content-center @if($count == 1) firstContentRow @endif">
                                                <div class="contentField {{  $section->fields->$field->type }}-field  col-md-12 py-2 px-4 mb-3 text-left">
                                                    <code>{{ $data }}</code>
                                                </div>
                                            </div>
                                        @endif


                                    @endforeach
                                @endif


                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </main>

    <!-- Related Content Section -->
    <div class="blog section section-invert py-4" id="relatedContent">
        <h3 class="section-title text-center m-5">Related Content</h3>

        <div class="container">
            <div class="py-4 mb-3">


                <div class="row justify-content-center" id="contentApp" v-if="info != null">
                    {!! renderResourceTableHtmlDynamically(['CARD_CLASS' => 'card', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_CONTAINER_CLASS' => 'col-md-5 mb-4', 'WRAPPER_CLASS' => null, 'SHOW_TIMESTAMP' => false,  'SHOW_TAGS' => false,'SHOW_PAGINATION' => false, 'CARD_ROW_CLASS'=> 'px-4 justify-content-center', 'PATH' => '/content']) !!}
                </div>


            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$post->id'}", "SORT_BY" => 'views']) !!}
@endsection