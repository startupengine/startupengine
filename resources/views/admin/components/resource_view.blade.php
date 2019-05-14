@extends('layouts.shards_admin')

@section('title') Pages - <?php echo setting('site.title'); ?> @endsection

@section('css')
    <style>
        td {
            line-height: 28px;
            vertical-align: middle;
        }

        nav li.page-item {
            box-shadow: none !important;
            border: 1px solid #ddd;
            border-right: 0px;
        }

        nav li.page-item:last-of-type {
            border-right: 1px solid #ddd;
        }

        nav li.page-item.active a {
            background: #555 !important;
        }

        nav li.page-item.active {
            border-color: #555;
        }

        nav li.page-item:hover a {
            color: #000 !important;
        }

        nav li.page-item.active:hover a {
            color: #fff !important;
        }

        .page-item a {
            color: #888;
        }

        table .badge-pill {
            min-width: 80px;
        }

        label {
            width: 100%;
            display: block;
        }

        .formSection {
            border-radius: 4px !important;
        }

        .formSection .input-group label {
            transition: all 0.25s;
        }

        .formSection .input-group:hover label {
            color: #444 !important;
            opacity: 1 !important;
        }

        .formSection .input-group-text {
            background: #5a6169 !important;
            border-left: 3px #333 solid !important;
            color: #fff !important;
        }

        .modal .input-group-text {
            text-transform: capitalize;
        }

        .formSection:hover .input-group-text {
            border-left: 3px #000 solid !important;
            background: #000 !important;
            transition: all 0.3s !important;
        }

        .formSection .card-header {
            border-radius: 4px 4px 0px 0px !important;
            transition: all 0.25s;
            padding: 10px 10px;
            border-color: #c8d3de !important;
            text-transform: capitalize;
            border-bottom: 1px solid #999;
            margin-bottom: 20px !important;
        }

        .formSection .card-header h6 {
            color: #333 !important;
            font-weight: 600 !important;
            font-size: .8125rem;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 300;
            margin-bottom: 0px !important;
            transition: all 0.25s;
        }

        .formSection .card-body {
            padding-left: 20px;
            padding-right: 20px;
        }

        .badge-dark {
            background: #5a6169;
        }

        .formEditButton {
            opacity: 0;
        }

        .formSection .input-group:hover .formEditButton, #tagsCard:hover .formEditButton, #contentDetails:hover .formEditButton {
            opacity: 1;
            transition: all 0.25s !important;
        }

        .formSection .input-group {
            transition: all 0.25s !important;
        }

        .explicitButtons .formEditButton {
            opacity: 1 !important;
        }

        .card-header {
            border-radius: 5px 5px 0px 0px !important;
        }

        .card-text p {
            margin: 0px;
        }

        .text-truncate div, .text-truncate p, .text-truncate h1, .text-truncate h2, .text-truncate h3, .text-truncate h4, .text-truncate h5, .text-truncate h6 {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        textarea {
            word-break: break-all !important;
            overflow-wrap: break-word !important;
        }

        .text-success i, .text-danger i {
            opacity: 0.5;
        }

        .text-success {
            color: #666 !important;
        }

        .text-success i {
            color: #41c076 !important;
        }

        .btn-disabled {
            opacity: 0.6;
            background: #fff !important;
            color: #333 !important;
            border: 1px solid #333 !important;
            cursor: not-allowed !important;
        }

        .btn-dimmed {
            opacity: 0.75;
        }

        .btn-dimmed:hover {
            opacity: 1;
        }

        .fieldData {
            border-radius: 4px;
            border: 1px solid #efefef;
            transition: all 0.25s;
            width: 100%;
        }

        .input-group:hover .fieldData {
            border-color: royalblue;
            background: #fafafa;
        }

        .formSection:hover .card-header {
            border-bottom-color: #c8d3de;
            background: #f8f8ff;
        }

        .formSection .input-group .badge {
            background: #eaeaea !important;
            border: 1px solid #ffffff !important;
            color: #212529 !important;
        }

        #contentDetails .badge {
            opacity: 0.5;
            background: #eaeaea !important;
            border: 1px solid #ffffff !important;
            color: #212529 !important;
            transition: all 0.25s;
            margin-top: 5px;
        }

        #contentDetails:hover .badge {
            opacity: 1;
        }

        .modal-fluid textarea {
            height: calc(100vh - 250px) !important;
        }

        .badge-tag {
            background: #444 !important;
            border: 1px solid #444 !important;
            color: #fff !important;
            transition: all 0.25s;
        }

        .badge-tag span {
            background: #fff;
            color: #333;
            border-radius: 10px;
            padding: 2px 4px 3px 4px;
            margin-left: 5px;
            cursor: pointer;
            transition: all 0.25s;
        }

        .badge-tag:hover span {
            background: #fff;
            color: #333;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2), 0px 5px 25px rgba(0, 0, 0, 0.3);
        }

        .badge-tag:hover {
            color: #eee !important;
            border: 1px solid #a5a5a5 !important;
            background: #a5a5a5 !important;
        }

        #contentDetails .badge, #tagsCard .fieldData {
            background: #eaeaea !important;
            border: 1px solid #ffffff !important;
            color: #212529 !important;
            opacity: 0.5;
        }

        #contentDetails:hover .badge, #tagsCard:hover .fieldData {
            opacity: 1;
        }

        .formSection input {
            transition: all 0.25s;
        }

        .formSection:hover input {
            background: #fafafa !important;
        }

        .badge-price {
            min-width: 100px;
        }

        .deleteResource:hover {
            color: red;
            cursor: pointer;
        }

        .viewResource {
            padding-top: 5px;
        }

        .viewResource:hover {
            cursor: pointer;
            color: #000;
        }

    </style>
    <link href="https://cdn.quilljs.com/1.3.4/quill.core.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.4/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/default.min.css">
@endsection

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.4/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-quill-editor@3.0.4/dist/vue-quill-editor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js"></script>

@endsection

@section('page-title') {{ ucwords($item->standardSchema()->lang->en->singular) }} <span
        style="opacity:0.5;"># {{ $item->id }}</span>@endsection

@section('top-menu')

    @if( count(json_decode(json_encode($item->standardSchema()->sections), true)) > 0 OR  count(json_decode(json_encode($item->standardSchema()->fields), true)))

        <div class="col-md-6 col-sm-6 pageNav justify-content-right">
            <div class="btn-group my-1">
                @if(isset($options['buttons']['top_nav']))

                    @foreach($options['buttons']['top_nav'] as $button)
                        <a href="{{ $button['link'] }}" @if(isset($button['target'])) target="{{ $button['target'] }}"
                           @endif class="btn {{ $button['class'] }}">{!! $button['text'] !!}</a>
                    @endforeach

                @endif
                <a href="#" class="btn btn-secondary" id="editContentButton" style="">
                    <i class="material-icons mr-2">edit</i> <span class="mr-1">Edit  <span
                                class="hiddenOnMobile hiddenOnDesktop">{{ ucwords($item->standardSchema()->lang->en->singular) }}</span></span>
                </a>
                <div class="btn btn-danger px-3" data-toggle="modal"
                     data-target="#modal-delete"><i class="material-icons mr-2">delete</i> Delete <span
                            class="hiddenOnMobile hiddenOnDesktop">{{ ucwords($item->standardSchema()->lang->en->singular) }}</span>
                </div>
            </div>

        </div>
    @endif

@endsection

@section('content')
    {!! renderResourceEditorForm($options, $item) !!}
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