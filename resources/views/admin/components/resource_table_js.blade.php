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
                startDate: '',
                endDate: ''
            }
        },
        methods: {
            onSubmit() {

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
            )
                ;
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
                    var string = '{{ $options['url'] }}?{{ $options['GLOBAL_FILTER'] }}&page[number]=' + pageNumber + '&perpage=' + this.perPage + this.filterString + '&perPage=' + this.perPage + '&limit=' + this.limit + '&includes=' + this.includeString + '&sort=' + this.sortString + this.searchString;
                }
                else {
                    var string = '{{ $options['url'] }}?{{ $options['GLOBAL_FILTER'] }}&page[number]=' + pageNumber + '&perPage=' + this.perPage + '&limit=' + this.limit + '&includes=' + this.includeString + '&sort=' + this.sortString + this.searchString;
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
                    if (filters.hasOwnProperty(filter)) {
                        this.filterString = this.filterString + filters[filter] + ',';
                    }
                }
                this.updateData();
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
            var url = '{{ $options['url'] }}?' + this.filterString + '&perPage=' + this.perPage + '&limit=' + this.limit + '{{ $options['GLOBAL_FILTER'] }}' + this.sortString;
            console.log(url);
            var config = {headers: {'Content-Type': 'application/json', 'Cache-Control': 'no-cache'}};
            axios
                .get(url, config)
                .then(response => (this.info = response.data)
        );
        }
    });
</script>