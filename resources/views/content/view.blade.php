@extends('layouts.shards_frontend')

@section('title')
    {{ $post->title }}
@endsection

@section('meta-description')
    <?php echo setting('admin.description'); ?>
@endsection


@section('splash-style')
     @if($post->thumbnail() != null) background-image:url('{{ $post->thumbnail() }}'); @endif
@endsection

@section('css')
    <style>
        #contentApp {
            display: inline-table !important;
            width: 100% !important;
        }

        h2.welcome-heading {
            font-size:220% !important;
            font-weight: 200;
        }
    </style>
@endsection


@section('header')
    <!-- Inner Wrapper -->
    <div class="inner-wrapper mt-auto mb-auto container">
        <div class="row">
            <div class="col-md-12 px-4 mb-3">
                <h2 class="welcome-heading display-4 text-white text-center ">{{ $post->title }}</h2>
                <h5 class="text-white pt-2 text-center  mb-4" style="font-size:130%;font-weight:200;">{{ $post->excerpt() }}</h5>
                @if(count($post->tags) > 0)
                    <p align="center" class="text-center">
                    <div class="pb-1 pt-0 mt-0 text-center">
                        <?php $tagCount = 1; ?>
                        @if(count($post->tags) > 0)
                                <a class="tag-link" href="#"  data-toggle="modal"
                                   data-target="#tagsModal" aria-label="Toggle related topics"><span class="px-3 py-2 badge badge-light text-dark badge-pill mb-1">Topics</span></a>
                        @endif
                        @foreach($post->tags as $tag)
                            @if($tagCount <= 3)
                                <a class="tag-link" href="/content/tags/{{ $tag->slug }}"><span class="px-3 py-2 badge badge-dark badge-pill mb-1">{{ $tag->name }}</span></a>
                                <?php $tagCount = $tagCount + 1; ?>
                            @endif
                        @endforeach
                        <?php $remaining = count($post->tags) - 3; ?>
                        @if($remaining > 0)
                                <a class="tag-link" href="#"  data-toggle="modal"
                                   data-target="#tagsModal" aria-label="Toggle related topics"><span class="px-3 py-2 badge badge-dark badge-pill mb-1">+ {{ $remaining }} more</span></a>
                        @endif
                    </div>
                    </p>
                @endif
                <p align="center">
                    <a href="#content" class="mt-1 btn btn-md btn-outline-white btn-translucent btn-pill align-self-center"
                       onclick="$('html, body').animate({scrollTop: $('#content').offset().top @if(isset($message)) -205 @else -155 @endif }, 500);">Read More</a>
                </p>
            </div>
        </div>
    </div>
    <!-- / Inner Wrapper -->
@endsection

@section('content')
    <?php $sectionCount = 1; ?>
    <main id="content">

    @if($post->postType()->first()->schema() != null)
        @foreach($post->postType()->first()->schema()->sections as $section)

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
    <div class="blog section section-invert pt-2 pb-3" id="contentApp" v-if="info != null && info.meta != null && info.meta.total != null && info.meta.total > 0">
        <h3 class="section-title text-center mt-5 ">Recommended For You</h3>

        <div class="container text-center">
            <div class="pt-5 mb-0">


                <div class="row justify-content-center"  >
                    {!! renderResourceTableHtmlDynamically(['CARD_CLASS' => 'card text-left', 'CARD_HEADER_FIELD' => 'title', 'CARD_BODY_FIELD' => 'excerpt', 'CARD_CONTAINER_CLASS' => 'col-md-4 mb-4', 'WRAPPER_CLASS' => null, 'SHOW_TIMESTAMP' => false,  'SHOW_TAGS' => false,'SHOW_PAGINATION' => false, 'CARD_ROW_CLASS'=> 'px-4 justify-content-center', 'PATH' => '/content']) !!}
                </div>


            </div>
        </div>
    </div>
    <!-- / Related Content Section -->

    <!-- Tags Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="tagsModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Related Topics</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="position:relative;right:-10px;top:0px;margin-top:-13px;">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav w-100">

                        <?php $tagCount = 1; ?>

                        @foreach($post->tags as $tag)

                                    <li class="nav-item w-100">
                                        <a href="/content/tags/{{ $tag->slug }}" class="nav-link">{{ $tag->name }}</a>
                                    </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- / Tags Modal -->
@endsection

@section('scripts')
    {!! renderResourceTableScriptsDynamically(['url' => '/api/resources/content', 'DISPLAY_FORMAT' => 'cards', "FILTERS" => "{exclude: 'id!=$post->id'}", "SORT_BY" => 'views', "LIMIT" => 3]) !!}
@endsection