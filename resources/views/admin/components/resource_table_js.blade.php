<script>


    var pageNumber = 1;
    var {{ $options['VUE_APP_NAME'] }} = new Vue({
        el: '#{{ $options['div_id'] }}',
        data() {
            return {
                currentPage: 1,
                info: null,
                status: 'init',
                itemName: '',
                filters: @if(isset($options['FILTERS'])){!! $options['FILTERS'] !!} @else {} @endif,
                filterString: @if(isset($options['FILTER_STRING'])) '{!! $options['FILTER_STRING'] !!}' @else '' @endif,
                includes: {},
                includesString: '',
                perPage: {{ $options['PER_PAGE'] }},
                limit: {{ $options['LIMIT'] }},
                displayFormat: '{{ $options['DISPLAY_FORMAT'] }}',
                search: '',
                searchString: '',
                showDeleted: false,
                sortField: '{{ $options['SORT_BY'] }}',
                sortDirection: '-',
                sortString: @if(isset($options['SORT_STRING'])) '{!! $options['SORT_STRING'] !!}' @else '' @endif,
                withAnyTags: {!! $options['WITH_ANY_TAGS'] !!},
                withAnyTagsString: '',
                withAllTags: {!! $options['WITH_ALL_TAGS'] !!},
                withAllTagsString: '',
                withoutTags: {!! $options['WITHOUT_TAGS'] !!},
                withoutTagsString: '',
                startDate: '',
                endDate: '',
                transformationStatus: null,
                transformationResult: null,
                transformationError: null
            }
        },
        methods: {
            onSubmit() {

            },
            updateInfo(response){
              this.info = response;
            },
            reset(options) {
                if (options.hasOwnProperty('filters')) {
                    this.filters = {};
                    this.filterString = '';
                }
                if (options.hasOwnProperty('search')) {
                    this.search = '';
                    this.searchString = '';
                }
                this.updateData();
            },
            undelete(item) {
                url = '{{ $options['url'] }}/' + item.id + '/edit?&undelete=true&save=true&json={}';
                axios
                    .get(url)
                    .then(response => (item.deleted_at = null)
            );
            },
            updateTags(withAny, withAll, without){
                if (withAny != null) {
                    this.withAnyTags = withAny;
                }
                this.withAnyTagsString  = '&withAnyTag=';
                for (var tag in this.withAnyTags) {
                    this.withAnyTagsString = this.withAnyTagsString + this.withAnyTags[tag] + ',';
                }
                if (withAll != null) {
                    this.withAllTags = withAll;
                }
                this.withAllTagsString  = '&withAllTags=';
                for (var tag in this.withAllTags) {
                    this.withAllTagsString = this.withAllTagsString + this.withAllTags[tag] + ',';
                }
                if (without != null) {
                    this.withoutTags = without;
                }
                this.withoutTagsString  = '&withoutTags=';
                for (var tag in this.withAllTags) {
                    this.withoutTagsString = this.withoutTagsString + this.withoutTags[tag] + ',';
                }
            },
            updateData(pageNumber) {
                if (pageNumber != null) {
                    this.currentPage = pageNumber;
                }
                else {
                    pageNumber = 1;
                    this.currentPage = pageNumber;
                }
                this.status = 'loading';
                $('.dataRow').hide();
                $('.loadingRow').show();
                if (this.filters !== null) {
                    var string = '{{ $options['url'] }}?{!! $options['GLOBAL_FILTER'] !!}&page[number]=' + pageNumber + '&perpage=' + this.perPage + this.filterString + '&perPage=' + this.perPage + '&limit=' + this.limit + '&includes=' + this.includeString + '&sort=' + this.sortString + this.searchString  + this.withAnyTagsString + this.withAllTagsString + this.withoutTagsString;
                }
                else {
                    var string = '{{ $options['url'] }}?{!! $options['GLOBAL_FILTER'] !!}&page[number]=' + pageNumber + '&perPage=' + this.perPage + '&limit=' + this.limit + '&includes=' + this.includeString + '&sort=' + this.sortString + this.searchString  + this.withAnyTagsString + this.withAllTagsString + this.withoutTagsString;
                }
                if(this.startDate != ''){
                    string = string + '&startDate=' + this.startDate;
                }
                if(this.endDate != ''){
                    string = string + '&endDate=' + this.endDate;
                }
                console.log('GET ' + string);
                var config = {headers: {'Content-Type': 'application/json', 'Cache-Control': 'no-cache'}};
                axios
                    .get(string, config)
                    .then((response) => {
                    this.info = response.data;
                this.status = 'loaded';
                $('.loadingRow').hide();
                $('.dataRow').fadeIn(200);
            })
                ;
            },
            updateSortField(sortField) {
                this.sortField = sortField;
                this.sortDirection = this.sortDirection;
                this.sortString = this.sortDirection + this.sortField;
                this.updateData();
            },
            updateSortDirection(sortDirection) {
                this.sortDirection = sortDirection || '';
                this.sortString = this.sortDirection + this.sortField;
                this.updateData();
            },
            updateSearch(search) {
                this.search = search;
                if (typeof(this.search) !== "undefined") {
                    this.searchString = '&s=' + this.search;
                }
                else {
                    this.searchString = '';
                }
                this.updateData();
            },
            updateFilters(filters) {
                this.filterString = '&filter=';
                for (var filter in filters) {
                    if (filters.hasOwnProperty(filter)) {
                        this.filters[filter] = filters[filter];
                    }
                }
                for (var filter in this.filters) {
                    if (this.filters.hasOwnProperty(filter)) {
                        this.filterString = this.filterString + this.filters[filter] + ',';
                    }
                }
                this.updateData();
            },
            transform(id, transformation, action, confirm) {
                console.log('Recieved:');
                console.log([id, transformation, action, confirm]);
                this.transformationResult = null;
                this.transformationError = null;
                if (transformation.options != null && confirm != true) {
                    console.log('test1');
                    this.transformationStatus = null;
                    if (typeof confirmAction === "function") {
                        confirmAction({appName: '{{ $options['VUE_APP_NAME'] }}', id: id, message: transformation.confirmation_message, transformation: transformation});
                    }
                }
                else if(transformation.require_confirmation != null && confirm != true) {
                    console.log('test2');
                    this.transformationStatus = null;
                    if (typeof confirmAction === "function") {
                        confirmAction({appName: '{{ $options['VUE_APP_NAME'] }}', id: id, message: transformation.confirmation_message, transformation: transformation});
                    }
                }
                else {
                    if (action == null) {
                        var actionString = '&action=true';
                    }
                    else {
                        var actionString = '&action=' + action;
                    }
                    this.transformationStatus = 'loading';
                    url = '{{ $options['url'] }}/' + id + '/transformation?transformation=' + transformation.slug + actionString @if( isset($options['FORCE_URL_ARGUMENTS']) ) + '&{{ $options['FORCE_URL_ARGUMENTS'] }}'@endif;
                    console.log(url);
                    axios
                        .post(url)
                        .catch(function (error) {
                            {{ $options['VUE_APP_NAME'] }}.updateTransformationError(error);
                            if (error.response) {
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            }
                        })
                        .then(response => (this.updateTransformationResult(response)));

                }
            },
            updateTransformationError(error){
                console.log('Error:');
                console.log(error);
                if(notificationsApp != null){
                    notificationsApp.errorNotification('Something went wrong.');
                }
                if(confirmActionApp != null){
                    confirmActionApp.dismissActionModal();
                }
                this.transformationError = error;
            },
            sendErrorNotification(error){
                console.log('Error:');
                console.log(error);
                if(typeof notificationsApp != 'undefined'){
                    notificationsApp.errorNotification('Something went wrong.');
                }
                this.transformationError = error;
            },
            updateTransformationResult(response){
                this.transformationResult = response;
                if(this.transformationResult.data.hasOwnProperty('errors') && this.transformationResult.data.errors.hasOwnProperty('status')){
                    if(confirmActionApp != null){
                        confirmActionApp.dismissActionModal();
                    }
                    if(notificationsApp != null){
                        if(this.transformationResult.data.errors.message != null) {
                            notificationsApp.errorNotification(this.transformationResult.data.errors.message);
                        }
                        else {
                            notificationsApp.errorNotification('Something went wrong.');
                        }
                    }
                }
                this.transformationStatus = 'loaded';
                this.updateData();
                return response;
            },
            updatePerPage(perPage) {
                this.perPage = perPage;
                console.log(perPage);
                this.updateData();
            },
            updateLimit(limit) {
                this.limit = limit;
                this.updateData();
            },
            updateInclude(includes) {
                this.includeString = 'include=';
                for (var include in includes) {
                    if (includes.hasOwnProperty(include)) {
                        this.filters[include] = includes[include];
                        this.includeString = this.includeString + includes[include] + ',';
                    }
                }
                this.updateData();
            },
            contentType(type) {
                if (type != null) {
                    this.newContentType = type;
                }
                return this.newContentType;
            },
            save() {
                url = '{{ $options['url'] }}?title=' + this.itemName + '&type=' + this.newContentType;
                axios
                    .get(url)
                    .then(response => (window.location.href = '/admin/content/view/' + response.data.data.id)
            )
                ;
            },
            moment(input){
                return moment(input);
            }
        },
        mounted() {
            this.updateFilters(this.filters);
            this.updateTags(this.withAnyTags, this.withAllTags, this.withoutTags);
            var url = '{{ $options['url'] }}?' + this.filterString + '&perPage=' + this.perPage + '&limit=' + this.limit + '{!! $options['GLOBAL_FILTER'] !!}' + this.sortString + this.withAnyTagsString + this.withAllTagsString + this.withoutTagsString;
            console.log(url);
            var config = {headers: {'Content-Type': 'application/json', 'Cache-Control': 'no-cache'}};
            axios
                .get(url, config)
                .then(response => ({{ $options['VUE_APP_NAME'] }}.updateInfo(response))
        );
        }
    });

</script>