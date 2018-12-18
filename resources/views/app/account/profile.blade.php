@extends('layouts.shards_frontend')

@section('php-variables')
    <?php
        $viewOptions['navbar-classes'] = ['dark'];
        $viewOptions['navbar-scroll-add-classes'] = ['dark'];
        $viewOptions['navbar-unscroll-remove-classes'] = [];
    ?>
@endsection

@section('title')
    Account
@endsection

@section('meta-description')
    <?php echo setting('admin.description') ?>
@endsection

@section('css')
    <style>
        .avatar-large {
            height: 50px;
            width: 50px;
            border-radius: 50px;
            display: inline-block;
            background: url('{{ \Auth::user()->avatar() }}');
            background-size: cover;
            background-position: center;
        }

        .card.border {
            border-color: #cfd8e2 !important;
        }

        .card-header{
            background:#fff !important;
        }

        .card{
            height:auto !important;
            min-height:auto !important;
        }


    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js"></script>

    <style>
        #contentForm .col-lg-9 {
            min-width: 100% !important;
        }
    </style>
@endsection

@section('navbar-classes')
    @foreach($viewOptions['navbar-classes'] as $class)
        {{ $class }}
    @endforeach
@endsection

@section('splash-class')
    minimal
@endsection


@section('content')
    <!-- Related Content Section -->
    <div class="blog section section-invert pt-4 pb-0" style="min-height:calc(100vh - 133px) !important;">
        <h4 class="section-title text-center mb-5 mt-3">My Account</h4>

        <div class="container">
            <div class="row pt-2">
                <div class="pt-0 mb-3 col-md-3 pull-left">
                    @include('app.account.partials.nav')
                </div>
                <div class="pt-0 mb-3 col-md-9" id="contentApp">
                    {!! renderResourceEditorForm($options, \Auth::user()) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- / Related Content Section -->
@endsection

@section('scripts')
    <script src="{{ ENV('APP_URL') }}/js/components/ace-editor-vue-component.js"></script>
    <script>
        hljs.configure({   // optionally configure hljs
            languages: ['json', 'javascript', 'html']
        });
    </script>
    {!! renderResourceEditorScripts($options)  !!}
@endsection