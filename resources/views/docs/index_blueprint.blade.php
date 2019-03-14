@extends('layouts.shards_docs')

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

        .actionButton {
            width: 120px !important;
        }

        .postTypeSelector {
            background: rgba(126, 186, 255, 0.1);
            border-left: 2px solid rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            padding: 15px 0px;
            transition: all 0.5s;
        }

        .postTypeSelector:hover {
            background: rgba(95, 114, 255, 0.1);
            border-left: 2px solid #333;
            cursor: pointer;
        }

        .postTypeSelector:last-of-type {
            margin-bottom: 0px !important;
        }

        .modal-header .close {
            padding: 1.25rem 5px;
            margin: -1rem -1rem -1rem auto;
        }

        .modal-footer {
            padding-top: 20px;
            padding-bottom: 20px;
            padding-right: 25px;
            padding-left: 25px;
        }

        .card .postTag {
            display: none;
        }

        .card .postTag:first-of-type {
            display: inline-flex;
        }

        .modal .input-group-text {
            min-width: 130px;
        }

        #docsApp .card ul {
            line-height: 15%;
        }

        #docsApp .card {
            margin-bottom: 20px;
        }

        .hljs-attribute{
            color:mediumseagreen;
            font-weight:bold;
        }

        .table-sm td p {
            margin-bottom:5px;
            text-align: left;
        }

        .table-sm td p code {
            text-align: left;
            padding-left:0px;
        }

        .card-small {
            box-shadow:none !important;
            border:1px solid #ddd !important;
        }

        pre {
            background:#333;
            border-radius:4px;
            color:#fff;
            padding:5px 20px;
        }
    </style>
@endsection

@section('head')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
@endsection

@section('page-title') {{ $api->name }} @endsection

@section('top-menu')
@endsection

@section('content')
    <div class="row px-3" id="docsApp" v-if="info != null">
        <div class="col">
            <div class="row">
                <div class="card" style="width:100%;">
                    <div class="card-body">
                        {!! $api->descriptionHtml !!}
                    </div>
                </div>

                @foreach($api->resourceGroups as $resourceGroup)

                    <div class="card" style="width:100%;">
                        <div class="card-header border-bottom">
                            <strong class="text-primary" id="{{ $resourceGroup->elementId }}">
                                {{ $resourceGroup->name }}
                            </strong>
                        </div>
                        <div class="card-body">
                            {!! $resourceGroup->descriptionHtml !!}

                            @foreach($resourceGroup->resources as $resource)
                                <h6 id="{{ $resource->elementId }}">
                                    {{ $resource->name ?: 'Resource' }}
                                </h6>
                                {!! $resource->descriptionHtml !!}

                                @foreach($resource->actions as $action)
                                    <div class="card card-small" style="width:100%;">
                                        <div class="card-header">
                                            <strong class="card-title" id="{{ $action->elementId }}">
                                                <?php
/* <span class="name text-primary mr-2">{{ $action->name }}</span> */
?>
                                                <span class="badge badge-dark method {{ $action->methodLower }}">{{ $action->method }}</span>
                                                <code class="uri">{!! urldecode($action->uriTemplate) !!}</code>
                                            </strong>
                                        </div>
                                        <div class="card-body">
                                            {!! $action->descriptionHtml !!}


                                            <div class="definition">
                                                <strong>Example URI</strong> <span class="d-none method {{ $action->methodLower }}">{{ $action->method }}</span>
                                                <span class="uri">
                <span class="hostname">{{ $api->host }}</span>{!! urldecode($action->colorizedUriTemplate) !!}
            </span>
                                            </div>


                                            @if ($action->parameters->count())
                                                <br>
                                                <p>
                                                    <strong class="text-muted">URI Parameters</strong>
                                                </p>
                                                <div class="parameters">
                                                    <table class="table table-sm" style="width:100%;">

                                                        <tbody style="width:100%;">
                                                        @foreach ($action->parameters as $parameter)
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ $parameter->name }}</strong>
                                                                </td>
                                                                <td>
                                                                    <p>
                                                                        <code>string</code>
                                                                        @if ($parameter->required)
                                                                            &nbsp;({{ $parameter->required }})
                                                                        @endif
                                                                        @if ($parameter->defaultValue)
                                                                            &nbsp;<span class="text-muted">Default: {{ $parameter->defaultValue }}</span>
                                                                        @endif
                                                                        @if ($parameter->example)
                                                                            &nbsp;<span class="text-muted">Example: {{ urldecode($parameter->example) }}</span>
                                                                        @endif
                                                                    </p>
                                                                    {!! $parameter->descriptionHtml !!}
                                                                    @if (!empty($parameter->values))
                                                                        <p class="choices">
                                                                            <strong>Choices:</strong>&nbsp;
                                                                            @foreach($parameter->values as $value)
                                                                                <code>{{ $value }}</code>&#32;
                                                                            @endforeach
                                                                        </p>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            @endif
                                        </div>
                                        @if ($action->examples->count())
                                            <div class="card-footer">
                                                <div class="transaction">
                                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                                        <li role="presentation" class="mr-2">
                                                            <a href="{{ $action->elementLink }}-request"
                                                               class="btn btn-outline-primary"
                                                               aria-controls="{{ $action->elementId }}-request"
                                                               role="tab" data-toggle="tab">Example Request</a>
                                                        </li>
                                                        @foreach($action->examples->pluck('response') as $response)
                                                            <li role="presentation">
                                                                <a href="{{ $action->elementLink }}-response-{{ $response->statusCode }}"
                                                                   class="btn btn-outline-primary"
                                                                   aria-controls="{{ $action->elementId }}-response-{{ $response->statusCode }}"
                                                                   role="tab"
                                                                   data-toggle="tab">Example Response
                                                                    ({{ $response->statusCode }})</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                    <div class="tab-content pt-2 pb-0 mb-0">
                                                        <div role="tabpanel" class="tab-pane"
                                                             id="{{ $action->elementId }}-request">
                                                            @include('blueprintdocs::requestresponsebody', ['requestresponse' => $action->examples->first()->get('request')])
                                                        </div>
                                                        @foreach($action->examples->pluck('response') as $response)
                                                            <div role="tabpanel" class="tab-pane"
                                                                 id="{{ $action->elementId }}-response-{{ $response->statusCode }}">
                                                                @include('blueprintdocs::requestresponsebody', ['requestresponse' => $response])
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection