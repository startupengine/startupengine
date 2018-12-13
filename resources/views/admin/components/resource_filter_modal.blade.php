<!-- Filter Content Modal -->
<div class="modal fade" id="modal-filter-content" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="width:100%;">
                    Filter Results
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true" style="margin-top:-15px !important;">&times;</button>
            </div>

            <div class="modal-body pt-4">
                <!-- Form Errors -->
                <!-- Create Client Form -->
                <form class="form-horizontal" id="formFilters" role="form" v-on:submit.prevent="onSubmit">
                    <label style="margin-bottom:1.5rem!important;margin-top:0px;">Display Options</label>
                    @if(isset($options['display_formats']) && count($options['display_formats']) > 1)
                    <div class="input-group mb-2" style="">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Display Format</span>
                        </div>
                        <select class="custom-select" style="border-radius:0px 4px 4px 0px;" id="viewMode" v-model="displayFormat">
                            <option selected  value="list">List</option>
                            <option value="cards">Cards</option>
                        </select>
                    </div>
                    @endif
                    @if(isset($options['per_page_options']) && count($options['per_page_options']) > 1)
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Results Per Page</span>
                        </div>
                        <select class="custom-select formFilter" id="statusFilter" v-model="perPage" @change="updatePerPage(perPage)">
                            @foreach($options['per_page_options'] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Max # of Results</span>
                        </div>
                        <select class="custom-select formFilter" id="statusFilter" v-model="limit" @change="updateLimit(limit)">
                            <option value="10">10</option>
                            <option value="100">100</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>
                    <label style="margin-bottom:1.5rem!important;">Filters</label>

                    <div class="input-group mb-2" style="height:36px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Search</span>
                        </div>
                        <input class="form-control formFilter" id="s" name="s" autocomplete="off" v-model="search" @change="updateSearch(search)" />
                    </div>
                    @if(isset($options['filters']))
                        @foreach($options['filters'] as $filter => $settings)
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">{{ $filter }}</span>
                                </div>
                                <select class="custom-select formFilter" id="typeFilter" v-model="filters.{{ $settings['label'] }}" @change="updateFilters({'type': filters.{{ $settings['label'] }}})">
                                    @foreach($settings['options'] as $option => $value)
                                        <option selected value="{!! $value !!}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    @endif
                    @if(isset($options['created_fields']))
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Created</span>
                        </div>
                        <select class="custom-select formFilter" id="createdAtFilter"  v-model="filters.created_at" @change="updateFilters({'created_at': filters.created_at})">
                            @foreach($options['created_fields'] as $option => $value)
                            <option value="created_at>={{ \Carbon\Carbon::now()->sub(\Carbon\CarbonInterval::createFromDateString($value))->toDateTimeString() }}">In the last {{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(isset($options['sort_fields']))
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Sort By...</span>
                        </div>
                        <select class="custom-select formFilter" id="createdAtFilter"  v-model="sortField" @change="updateSortField(sortField)">
                            @foreach($options['sort_fields'] as $option => $value)
                            <option value="{{$value}}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Sort Direction</span>
                        </div>
                        <select class="custom-select formFilter" id="createdAtFilter" v-model="sortDirection" @change="updateSortDirection(sortDirection)">
                            <option selected value="-">Descending</option>
                            <option value="">Ascending</option>
                        </select>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>