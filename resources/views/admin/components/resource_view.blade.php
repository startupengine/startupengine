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

@section('page-title') {{ ucwords($item->schema()->lang->en->singular) }} <span
        style="opacity:0.5;"># {{ $item->id }}</span>@endsection

@section('top-menu')

    @if( count(json_decode(json_encode($item->schema()->sections), true)) > 0 OR  count(json_decode(json_encode($item->schema()->fields), true)))
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
                                class="hiddenOnMobile hiddenOnDesktop">{{ ucwords($item->schema()->lang->en->singular) }}</span></span>
                </a>
                <div class="btn btn-danger px-3" data-toggle="modal"
                     data-target="#modal-delete"><i class="material-icons mr-2">delete</i> Delete <span
                            class="hiddenOnMobile hiddenOnDesktop">{{ ucwords($item->schema()->lang->en->singular) }}</span>
                </div>
            </div>

        </div>
    @endif

@endsection

@section('content')
    <div id="contentForm" v-if="record != null && record.meta != null && record.meta.status == 'success'"
         style="opacity:0;" v-bind:style="{ 'opacity': '1' }">
        <div class="row mb-2">
            <div class="col-lg-9 col-md-12">

            @if(isset($options['custom_view']))
                @include($options['custom_view'])
            @else
                <!-- Add New Post Form -->
                    @if (Schema::hasColumn($item->getTable(), 'title'))
                        <div class="formSection" v-if="record.data != null">
                            <div class="input-group mb-3 border-radius-10 border-0 raised"
                                 style="border:none !important;">
                                <div class="input-group-prepend">
                        <span class="input-group-text" style="border-color:transparent;width:60px;color:#fff;">
                            Title
                        </span>
                                </div>
                                <input type="text"
                                       class="form-control form-control-lg bg-white text-truncate"
                                       v-model="record.data.{{ $item->schema()->metadata->title_key }}"
                                       placeholder="Title"
                                       aria-label="Username" aria-describedby="basic-addon1" disabled
                                       style="pointer-events:none;border:none !important;border-radius:0px 5px 5px 0px;">
                                <div class="formEditButton btn btn-primary btn-pill"
                                     style="position:absolute;right:15px;top:-15px;"
                                     :data-fieldvalue="record.data.{{ $item->schema()->metadata->title_key }}"
                                     data-toggle="modal"
                                     data-target="#modal-edit-content"
                                     v-on:click="updateForm({ 'sectionName': '{{ $item->schema()->metadata->title_key }}','fieldSlug': '{{ $item->schema()->metadata->title_key }}', 'fieldName': '{{ $item->schema()->metadata->title_key }}', 'fieldType': 'text', 'fieldInput': record['data']['{{ $item->schema()->metadata->title_key }}'], 'fieldDisplayName': 'Title', 'fieldDescription': 'Title for this item.' })">
                                    Edit
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Schema::hasColumn($item->getTable(), 'slug'))
                        <div class="formSection" v-if="record.data != null">
                            <div class="input-group formSection  mb-3 border-radius-10 border-0 raised"
                                 style="border:none !important;">
                                <div class="input-group-prepend">
                        <span class="input-group-text" style="border-color:transparent;width:60px;color:#fff;">
                            Slug
                        </span>
                                </div>
                                <input type="text"
                                       class="form-control form-control-lg bg-white text-truncate"
                                       v-model="record.data.slug"
                                       placeholder="Your Post Slug"
                                       value="{{ $item->slug }}"
                                       aria-label="Username" aria-describedby="basic-addon1" disabled
                                       style="pointer-events:none;border:none !important;border-radius:0px 5px 5px 0px;">
                                <div class="formEditButton btn btn-primary btn-pill"
                                     style="position:absolute;right:15px;top:-15px;"
                                     data-toggle="modal"
                                     data-target="#modal-edit-content"
                                     v-on:click="updateForm({'fieldName': 'slug', 'fieldType': 'text', 'fieldInput': record.data.slug, 'fieldDisplayName': 'Slug', 'fieldDescription': 'The text that appears in the URL for this item.'})">
                                    Edit
                                </div>
                            </div>
                        </div>
                    @endif

                    <div v-if="record.data != null && record.data.schema != null && record.data.schema.fields != null">

                        <div v-for="value,fieldName in record.data.schema.fields" class="card p-0 mb-3 formSection"
                             v-if="fieldName !== 'slug' && fieldName !== '{{ $item->schema()->metadata->title_key }}' && fieldName !== 'status'">
                            <div class="card-body pb-3 px-3 pt-0">
                                <div v-if="hasConditions(record['data'], value.conditions)"
                                     class="input-group mt-3">
                                    <div class="formEditButton btn btn-primary btn-pill"
                                         v-if="record['data'] != null && record['data'][fieldName] !== null"

                                         data-toggle="modal"
                                         data-target="#modal-edit-content"

                                         v-on:click="updateForm({ 'fieldSlug': fieldName, 'fieldName': fieldName, 'fieldType': value.type, 'fieldInput': record['data'][fieldName], 'fieldDisplayName': fieldName, 'fieldDescription': value['description'], 'fieldSchema': value })"

                                         style="position:absolute;right:-5px;top:10px;">Edit
                                    </div>

                                    <div class="formEditButton btn btn-primary btn-pill"
                                         v-else

                                         data-toggle="modal"
                                         data-target="#modal-edit-content"

                                         v-on:click="updateForm({ 'fieldSlug': fieldName, 'fieldName': fieldName, 'fieldType': value.type, 'fieldInput': null, 'fieldDisplayName': fieldName, 'fieldDescription': value['description'], 'fieldSchema': value })"
                                         style="position:absolute;right:-5px;top:10px;">Edit
                                    </div>

                                    <label><span class="badge badge-outline-dark text-dark text-uppercase">@{{ fieldName }}</span></label>

                                    <div v-if="((record.data || {})[fieldName]) != null"
                                         class="fieldData card-text mb-2 mt-0 p-2" style="color:#555;">
                                    <span v-if="record.data.schema.fields[fieldName]['type'] == 'code'" class="p-0 m-0">
                                            <pre v-highlightjs style="border-radius:4px;" class="m-0"><code
                                                        class="json">@{{ record.data[fieldName] }}</code></pre>
                                    </span>
                                        <span v-else-if="record.data.schema.fields[fieldName]['type'] == 'image'"
                                              v-bind:style="{ backgroundImage: 'url(' + record['data'][fieldName] + ')' }"
                                              style="display:inline-block;width:100%;max-width:160px;height:100%;min-height:90px;background:#3333;border-radius:4px;background-size:cover;background-position:center;background-size:cover;">
                                    </span>
                                        <span v-else>
                                        @{{ record.data[fieldName] }}
                                    </span>
                                    </div>
                                    <p v-else
                                       <?php /*-if="section['fields'][fieldName]['type'] != 'resource' && record['data']['content']['sections'][sectionName]['fields'][fieldName] == null" */ ?>
                                       class="fieldData card-text mb-2 mt-0 p-2" style="color:#555;">
                                        <span style="opacity:0.5;">No data.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div v-if="record.data != null && record.data.schema != null && record.data.schema.sections != null">

                        <div v-for="section,sectionName in record.data.schema.sections"
                             class="card p-0 mb-3 formSection">
                            <div class="card-header"><h6 v-if="section.title != null">@{{ section.title }}</h6><h6
                                        v-else>@{{ sectionName }}</h6></div>
                            <div class="card-body pb-3 px-3 pt-0">
                                <div v-if="hasConditions(record['data'], value.conditions)"
                                     v-for="value,fieldName in section.fields"
                                     class="input-group">

                                    <div class="formEditButton btn btn-primary btn-pill"
                                         v-if="record['data']['content'] != null && record['data']['content']['sections'] !== null && record['data']['content']['sections'][sectionName] !== null && record['data']['content']['sections'][sectionName]['fields'] !== null && record['data']['content']['sections'][sectionName]['fields'][fieldName] !== null"

                                         data-toggle="modal"
                                         data-target="#modal-edit-content"

                                         v-on:click="updateForm({ 'sectionName': sectionName,'fieldSlug': fieldName, 'fieldName': 'sections.' + sectionName + '.fields.' + fieldName, 'fieldType': value.type, 'fieldInput': record['data']['content']['sections'][sectionName]['fields'][fieldName], 'fieldDisplayName': fieldName, 'fieldDescription': section['fields'][fieldName]['description'], 'fieldSchema': section['fields'][fieldName] })"

                                         style="position:absolute;right:-5px;top:10px;">Edit
                                    </div>

                                    <div class="formEditButton btn btn-primary btn-pill"
                                         v-else

                                         data-toggle="modal"
                                         data-target="#modal-edit-content"

                                         v-on:click="updateForm({ 'sectionName': sectionName,'fieldSlug': fieldName, 'fieldName': 'sections.' + sectionName + '.fields.' + fieldName, 'fieldType': value.type, 'fieldInput': null, 'fieldDisplayName': fieldName, 'fieldDescription': section['fields'][fieldName]['description'], 'fieldSchema': (section['fields'][fieldName]) })"
                                         style="position:absolute;right:-5px;top:10px;">Edit
                                    </div>

                                    <label v-if="value['display name'] != null"
                                           style="text-transform:uppercase;opacity:0.6;" class="mb-2"><span
                                                class="badge badge-outline-dark text-dark">@{{ value['display name'] }}</span></label>
                                    <label v-else style="text-transform:uppercase;opacity:0.6;" class="mb-2"><span
                                                class="badge badge-outline-dark text-dark">@{{ fieldName }}</span></label>

                                    <p v-if="section['fields'][fieldName]['type'] == 'resource'"
                                       class="fieldData card-text mb-2 mt-0 p-2" style="color:#555;">
                                        Click to view.
                                    </p>

                                    <p class="fieldData card-text mb-2 mt-0 p-2" style="color:#555;"
                                       v-if="(((((record.data || {}).content || {}).sections || {})[sectionName] || {}).fields|| {})[fieldName] != null">

                                    <span v-if="section['fields'][fieldName]['type'] == 'image'"
                                          v-bind:style="{ backgroundImage: 'url(' + record['data']['content']['sections'][sectionName]['fields'][fieldName] + ')' }"
                                          style="display:inline-block;width:100%;max-width:160px;height:100%;min-height:90px;background:#3333;border-radius:4px;background-size:cover;background-position:center;background-size:cover;">
                                    </span>
                                        <?php /*
                                    <span v-else-if="section['fields'][fieldName]['type'] == 'code'">
                                        <pre v-highlightjs style="border-radius:4px;" class="mt-2"><code class="json">@{{ record['data']['content']['sections'][sectionName]['fields'][fieldName] }}</code></pre>
                                    </span> */ ?>

                                        <span v-else>
                                        @{{ record['data']['content']['sections'][sectionName]['fields'][fieldName] }}
                                        <span v-if="value.type == 'percentage'"
                                              style="opacity:0.5;margin-left:3px;">%</span>
                                    </span>
                                    </p>

                                    <p v-else class="fieldData card-text mb-2 mt-0 p-2" style="color:#555;">
                                        <span style="opacity:0.5;">No data.</span>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-12">
                <!-- Post Overview -->
                <div class='card card-small mb-3 formSection' id="contentDetails">
                    @if (Schema::hasColumn($item->getTable(), 'status'))
                        <div class="formEditButton btn btn-primary btn-pill"
                             style="position:absolute;right:15px;top:-15px;"

                             data-toggle="modal"
                             data-target="#modal-edit-content"

                             v-on:click="updateForm({'fieldDisplayName': 'Status','fieldName': 'status', 'fieldType': 'select', 'fieldInput': null, 'fieldDescription': 'Publish or unpublish this content.', 'fieldSchema' :{'options': {'ACTIVE': 'ACTIVE', 'INACTIVE': 'INACTIVE'}} })">
                            Edit
                        </div>
                    @endif
                    <div class="card-header border-bottom">
                        <h6 class="m-0"><i class="fa fa-list"></i>&nbsp; Metadata</h6>
                    </div>
                    <div class='card-body p-0'>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item pt-0 px-3 pb-0 mb-2">
                                @if(isset($item->schema()->metadata))
                                    @if(isset($item->schema()->lang->en->singular))
                                        <span class="d-block mb-2">
                                        <span class="badge badge-outline-dark text-dark">Type</span>

                                         <p class="fieldData card-text mb-2 mt-2 p-2"
                                            style="background:#fafafa;color:#555;text-align:center;text-transform:capitalize;"> {{ $item->schema()->lang->en->singular }}
                                             @if (isset($item->schema()->subtype_lang->en->subtype_singular))
                                                 - {{ $item->schema()->subtype_lang->en->subtype_singular }}
                                             @endif
                                         </p>
                                    </span>
                                    @endif
                                    @foreach($item->schema()->metadata->readonly as $key => $value)
                                        <?php $column = $value->column; ?>
                                        <?php $label = $value->label; ?>
                                        <span class="d-block mb-2">
                                    <span class="badge badge-outline-dark text-dark">{{ $label }}</span>

                                     <p class="fieldData card-text mb-2 mt-2 p-2"
                                        style="background:#fafafa;color:#555;text-align:center;text-transform:capitalize;">
                                        {{ $item->$column }}
                                    </p>
                                </span>
                                    @endforeach
                                @endif
                                @if($item->published_at !== null)
                                    <span class="d-block mt-2 mb-3">
                                    <span class="badge badge-outline-dark text-dark">Created</span>
                                    <br>
                                    <p class="fieldData card-text mb-2 mt-2 p-2"
                                       style="background:#fafafa;color:#555;text-align:center;">
                                        {{ $item->created_at->format("M j Y") }}
                                        ({{ $item->created_at->diffForHumans() }})
                                    </p>
                                </span>
                                @endif
                                <span class="d-block mb-2 mt-2">
                                @if (Schema::hasColumn($item->getTable(), 'status'))
                                        <span class="badge badge-outline-dark text-dark">Status</span><br>
                                        <p v-if="record.data.status == 'ACTIVE'"
                                           class="fieldData card-text mb-2 mt-2 p-2"
                                           style="border-color:mediumseagreen !important;color:mediumseagreen !important;text-align:center;">@{{ record.data.status }}</p>
                                        <p v-else class="fieldData card-text mb-2 mt-2 p-2"
                                           style="color:#555;text-align:center;">@{{ record.data.status }}</p>
                                  </span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- / Post Overview -->
                <!-- Post Overview -->
                @if(isset($item->schema()->metadata->taggable) && $item->schema()->metadata->taggable)
                    <div class='card card-small mb-3 formSection' id="tagsCard">
                        <div class="formEditButton btn btn-primary btn-pill"
                             style="position:absolute;right:15px;top:-15px;"
                             v-on:click="updateForm({'fieldSlug': 'tags','fieldName': 'tags', 'fieldType': 'tags', 'fieldInput': null, 'fieldDisplayName': 'Tags', 'fieldDescription': 'Assign tags to this item.'})"
                             data-toggle="modal"
                             data-target="#modal-edit-content">Edit
                        </div>
                        <div class="card-header border-bottom" style="margin-bottom:15px !important;">
                            <h6 class="m-0"><i class="fa fa-tag"></i> &nbsp;Tags</h6>
                        </div>
                        <div class='card-body p-0'>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-3 pb-3 pt-0">
                                    <div v-if="(record.data.tags != null && record.data.tags.length > 0)">
                                    <span class="badge badge-primary badge-pill badge-tag m-1"
                                          v-for="tag,tagName in record.data.tags" v-if="tag != null">
                                        @{{ tag.name }}
                                    </span>
                                    </div>
                                    <p class="card-text mb-1 p-1" v-else>
                                        No tags.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" v-if="record != null">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="width:100%;">
                            Are you sure?
                        </h4>
                        <a class="close" data-dismiss="modal"
                           aria-hidden="true">&times;</a>
                    </div>
                    <div class="modal-body pt-4">
                        <p class="card-text">
                            You are about to delete the following <?php echo $item->schema()->lang->en->singular; ?>:
                            <strong class="text-danger">{{ record.data.<?php echo $item->schema()->metadata->title_key;?> }}</strong>
                        </p>
                        <p class="card-text">
                            Once you delete this <?php echo $item->schema()->lang->en->singular; ?> it can only be
                            un-deleted by an administrator.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-outline-secondary" data-dismiss="modal" aria-hidden="true">Cancel</div>
                        <div class="btn btn-danger" v-on:click="refresh('delete')">Delete <i class="material-icons">delete</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Content Modal -->
        <div class="modal fade" id="modal-edit-content" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="width:100%;">
                            Editing
                            <span style="text-transform:capitalize;opacity:0.5;"
                                  v-if="fieldSchema != null && fieldSchema.hasOwnProperty('display name')">@{{ fieldSchema['display name'] }}</span>
                            <span style="text-transform:capitalize;opacity:0.5;"
                                  v-else-if="fieldDisplayName != null">@{{ fieldDisplayName }}</span>
                            <span style="text-transform:capitalize;opacity:0.5;"
                                  v-else>@{{ fieldName }}</span>
                        </h4>
                        <a class="close" data-dismiss="modal"
                           aria-hidden="true" v-on:click="refresh()">&times;</a>
                        <a class="expand hiddenOnMobile" onclick="$('.modal-dialog').toggleClass('modal-fluid');"><i
                                    class="fa fa-expand"></i></a>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="form-horizontal" id="formFilters" role="form">
                            <label style="margin-bottom:1.5rem!important;margin-top:0px;"
                                   v-if="fieldType != 'tags' && fieldDescription != null">@{{ fieldDescription
                                }}</label>
                            <div v-if="fieldType == 'code'">
                                <ace-editor style="border: 1px solid #eee;border-radius: 4px;" v-model="fieldInput"
                                            v-on:input="changed()" min-lines="5"></ace-editor>
                            </div>
                            <div v-else-if="fieldType == 'richtext'">
                                <quill-editor v-model="fieldInput"
                                              ref="quillEditorA"
                                              :options="quillOptions"
                                              <?php /*@blur="onEditorBlur($event)"
                                              @focus="onEditorFocus($event)"
                                              @ready="onEditorReady($event)" */ ?>
                                              v-on:error="changeStatus('error')"
                                              v-on:input="changed()"
                                              style="height:100%;">
                                </quill-editor>
                            </div>
                            <div v-else-if="fieldType == 'image'">
                                <div class="input-group mb-2" style="height:36px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">@{{ fieldType }}</span>
                                    </div>
                                    <input v-on:input="changed()" class="form-control formFilter text-truncate"
                                           autocomplete="off" v-model="fieldInput" name="input"/><br>
                                </div>
                                <p v-if="(info.status != 'error' && fieldInput != '' && fieldInput != null)"
                                   class="card-text text-muted text-truncate"
                                   v-bind:style="{ backgroundImage: 'url(' + fieldInput + ')' }"
                                   style="border: 1px solid #ddd;padding: 7px 10px;border-radius: 4px;max-width: 100%; max-height:300px !important; background-color:#eee;min-height:300px;background-size:cover;background-position:center;">
                                </p>
                                <p v-else class="card-text text-muted text-truncate"
                                   style="background-image:url('/images/add-image.png');opacity:0.5;border: 1px solid #ddd;padding: 7px 10px;border-radius: 4px;max-width: 100%; max-height:300px !important; background-color:#eee;min-height:300px;background-size:cover;background-position:center;">
                                </p>
                            </div>
                            <div v-else-if="fieldName == 'status'">
                                <select v-model="fieldInput" class="form-control" v-on:change="changed()">
                                    <option disabled>SELECT ONE</option>
                                    <?php /*
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>
                                    */?>
                                    @if(isset($item->schema()->fields->status->options))
                                        @foreach($item->schema()->fields->status->options as $option => $value)
                                            <option value="{{ $value }}">{{ $option }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div v-else-if="fieldType == 'text'">
                                <input class="form-control formFilter text-truncate"
                                       autocomplete="off" v-model="fieldInput" v-on:input="changed()"
                                       style="min-height:35px;"/>
                            </div>
                            <div v-else-if="fieldType == 'resource'">
                                <div v-if="resourceItem == null && newItemSchema == null">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">All Items</li>
                                    </ol>
                                </div>
                                <div v-if="resourceItem != null">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"
                                                v-on:click="resourceItem = null; newItemSchema = null;"><a href="#">All
                                                    Items</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">View Item</li>
                                        </ol>
                                    </nav>
                                    <div class="list-group mb-4">
                                        <div class="list-group-item list-group-item-action"
                                             v-for="value,field in resourceItem"
                                             v-if="fieldSchema.options.resource_display_keys.includes(field)">
                                            <span class="badge badge-dark mr-2"
                                                  style="min-width:75px;">@{{ field }}</span> @{{ value }}
                                            <span v-if="value == null" style="opacity:0.5;">No data.</span>
                                            <span v-if="fieldSchema.options.resource_edit_keys.includes(field)"
                                                  class="badge badge-outline-primary pull-right"
                                                  style="cursor: pointer;"
                                                  v-on:click="editResourceItem(resourceItem,field,value)">Edit</span>
                                        </div>
                                    </div>
                                    <div class="btn btn-outline-danger" v-on:click="resourceItem = null">Back</div>
                                </div>
                                <div class="list-group"
                                     v-if="resource != null && resource.data != null && resourceItem == null && displayAddItemForm != true">
                                    <div v-if="resource.data.length == 0"
                                         class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <p class="card-text">No results.</p>
                                    </div>
                                    <div v-for="item in resource.data"
                                         class="list-group-item list-group-item-action d-inline-block">
                                        @{{ item.name }} <span style="float:right"><span
                                                    class="badge badge-primary badge-pill badge-price pull-left mr-1"
                                                    style="text-transform:capitalize;">@{{ item.price }}
                                            / @{{ item.interval }}</span> <i v-on:click="deleteResourceItem(item)"
                                                                             class="fa fa-fw fa-minus deleteResource ml-2 pull-right"
                                                                             style="padding-top:5px;"></i> <i
                                                    v-on:click="viewItem(item)"
                                                    class="fa fa-fw fa-search viewResource ml-2 pull-right"></i>
                                            </span>
                                    </div>
                                    <div v-on:click="addResourceItem(fieldSchema)"
                                         class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-primary">
                                        Add Item <i class="fa fa-fw fa-plus"></i>
                                    </div>
                                </div>
                                <div v-if="displayAddItemForm == true && newItemSchema != null">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"
                                                v-on:click="displayAddItemForm = null; newItemSchema = null;"><a
                                                        href="#">All Items</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">New Item</li>
                                        </ol>
                                    </nav>
                                    <div v-for="field,key in newItemSchema.fields" class="mb-2">
                                        <span class="badge badge-dark mb-2">@{{ key }}</span><br>
                                        <p class="card-text mb-2">@{{ field.description }}</p>
                                        <div v-if="info.data != null && info.data.fields != null && info.data.fields[key] != null && info.data.fields[key]['first_error'] != null"
                                             class="text-danger mb-2">@{{ info.data.fields[key]['first_error'] }}
                                        </div>
                                        <div v-if="field.type == 'select'">
                                            <select id="contentEditor" class="form-control"
                                                    style="text-transform:capitalize !important;"
                                                    v-on:input="changed()"
                                                    v-on:change="changed()"
                                                    v-model="newItem[key]"
                                                    v-bind:name="'newItem[' + key + ']'">
                                                <option disabled selected="selected" value="null">Select an option...
                                                </option>
                                                <option v-if="field.options != null"
                                                        v-for="option,optionKey in field.options">
                                                    @{{ option }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-else-if="field.type == 'textarea'">
                                            <textarea v-on:input="changed()" v-model="newItem[key]"
                                                      v-bind:name="'newItem[' + key + ']'" class="form-control"
                                                      autocomplete="off"></textarea>
                                        </div>
                                        <input v-else v-on:input="changed()" v-model="newItem[key]"
                                               v-bind:name="'newItem[' + key + ']'" class="form-control"
                                               autocomplete="off"/>
                                    </div>
                                    <div class="mt-3">
                                        <div v-if="info.status != null && info.status == 'success'" v-on:click="save()"
                                             class="btn btn-success pull-right">Save
                                        </div>
                                        <div v-else class="btn btn-success pull-right"
                                             style="opacity:0.5;pointer-events: none;">Save
                                        </div>
                                        <div class="btn btn-outline-danger pull-right mr-2"
                                             v-on:click="displayAddItemForm = null; this.newItem = null;">Back
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else-if="fieldType == 'select'">
                                <select id="contentEditor" class="form-control"
                                        v-on:input="changed()"
                                        v-model="fieldInput">
                                    <option disabled selected value="null">Select an option...</option>
                                    <option v-if="fieldSchema.options != null"
                                            v-for="option,optionKey in fieldSchema.options" :key="optionKey"
                                            :selected="getSelected(sectionName, fieldSlug, optionKey)">
                                        @{{ option }}
                                    </option>
                                </select>
                                <div class="mt-3" style="opacity:0.5;">Previously
                                    Selected: @{{
                                    JSON.stringify(record['data']['content']['sections'][sectionName]['fields'][fieldSlug])
                                    }}
                                </div>
                            </div>
                            <div v-else-if="fieldType == 'number'">
                                <div class="input-group mb-2" style="height:36px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input rows="3" class="form-control formFilter text-truncate"
                                           autocomplete="off" v-model="fieldInput" v-on:input="changed()"
                                           style="min-height:35px;"/>
                                </div>
                            </div>
                            <div v-else-if="fieldType == 'percentage'">
                                <div class="input-group mb-2" style="height:36px;">
                                    <input rows="3" class="form-control formFilter text-truncate"
                                           autocomplete="off" v-model="fieldInput" v-on:input="changed()"
                                           style="min-height:35px;"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div v-else-if="fieldType == 'textarea'">
                                <textarea wrap="hard" rows="3" class="form-control formFilter text-truncate"
                                          autocomplete="off" v-model="fieldInput" v-on:input="changed()"
                                          style="min-height:35px;"></textarea>
                            </div>
                            <div v-else-if="fieldType == 'richtext'">
                                <textarea wrap="hard" rows="3" class="form-control formFilter text-truncate"
                                          autocomplete="off" v-model="fieldInput" v-on:input="changed()"
                                          style="min-height:35px;"></textarea>
                            </div>

                            <div v-else-if="fieldType == 'code'">
                                <textarea wrap="hard" rows="3" class="form-control formFilter text-truncate"
                                          autocomplete="off" v-model="fieldInput" v-on:input="changed()"
                                          style="min-height:35px;"></textarea>
                            </div>
                            <div v-else-if="fieldType == 'tags'">
                                <div v-if="record != null">
                                    <div v-if="record.data.tags != null">
                                    <span class="badge badge-primary badge-pill badge-tag m-1"
                                          style="color:#333 !important;background:rgb(224, 240, 255) !important;border-color:rgb(224, 240, 255) !important;padding:10px 10px;cursor:pointer;width:100%;display:inline-block;text-align:left;">
                                        <input id="tagInput" v-model="fieldInput"
                                               <?php echo '@input="refreshTagInput(fieldInput)"'; ?>
                                               <?php echo '@change="refreshTagInput(fieldInput)"'; ?>
                                               style="min-width:calc(100% - 55px);width:auto;background:none;box-shadow:none !important;outline: none !important;border:none !important;"
                                               autocomplete="off" placeholder="Type and press ENTER to add a new tag"
                                               v-on:keyup.enter="newTag()"
                                        />
                                        <span v-on:click="newTag()"
                                              style="float:right;padding-right:6px; padding-left:6px;font-size:9px;">ENTER</span>
                                    </span>
                                        <span class="badge badge-primary badge-pill badge-tag m-1"
                                              v-for="tag,tagName in record.data.tags" v-if="tag != null"
                                              style="padding:10px 10px;cursor:default !important;">
                                        @{{ tag.name }}
                                            <span v-on:click="removeTag(tag.slug)">×</span>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-2" style="height:36px;width:100%;" v-else>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@{{ fieldType }}</span>
                                    <input v-on:input="changed()" class="form-control formFilter text-truncate"
                                           autocomplete="off" v-model="fieldInput" name="input" style="width:100%;"/>
                                </div>
                            </div>
                        </div>
                        <div v-if="info.status !== null && resourceItem == null">
                            <div v-if="info.status == 'error'" class="text-danger mt-2"><i
                                        class="fa fa-fw fa-exclamation-circle mr-1"></i>
                                <span v-if="info.data != null && info.data.fields != null && info.data.fields[fieldName] != null && newItem != null">@{{ info['data']['fields'][fieldName]['first_error'] }}</span>
                                <span v-else>Something went wrong.</span>
                            </div>
                            <div v-else-if="info.status == 'success' && editorHasErrors == false"
                                 class="text-success mt-2"><i
                                        class="fa fa-fw fa-check-circle mr-1"></i>Input is valid
                            </div>
                            <div v-else-if="fieldType == 'code' && editorHasErrors == 'pending'"
                                 class="text-warning mt-2"><i
                                        class="fa fa-fw fa-spinner fa-spin fa-sync mr-1"></i>
                                Analyzing...
                            </div>
                        </div>
                        <div v-if="editorHasErrors == true" class="text-danger mt-2"><i
                                    class="fa fa-fw fa-exclamation-circle mr-1"></i>
                            Invalid syntax.
                        </div>
                    </div>

                    <div class="modal-footer" v-if="fieldType != 'tags' && fieldType != 'resource'" style="width:100%;">
                        <a v-on:click="refresh()" href="#" class="btn btn-danger btn-dimmed" data-dismiss="modal"
                           aria-hidden="true" style="float:left;">
                            Cancel
                        </a>
                        <a v-if="info.status == 'success' && editorHasErrors == false" href="#"
                           class="btn btn-success btn-save"
                           v-on:click="save()"
                           data-dismiss="modal" aria-hidden="true" style="float:right;">
                            Save
                        </a>
                        <a v-else href="#" class="btn btn-light btn-disabled" style="float:right;">
                            Save
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <span class="badge badge-loading text-dark mr-2">Loading... <i
                    class="fa fa-fw fa-spin text-dark fa-spinner fa-sync"></i></span>
    </div>

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