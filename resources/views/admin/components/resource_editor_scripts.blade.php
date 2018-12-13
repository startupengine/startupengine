<script>



    Vue.use(VueQuillEditor);

    Vue.component('Editor', {
        template: '<div :id="editorId" style="width: 100%; height: 100%;"></div>',
        props: ['editorId', 'content', 'lang', 'theme'],
        data () {
            return {
                editor: Object,
                beforeContent: ''
            }
        },
        watch: {
            'content' (value) {
                if (this.beforeContent !== value) {
                    this.editor.setValue(value, 1)
                }
            }
        },
        mounted () {
            const lang = this.lang || 'text'
            const theme = this.theme || 'github'

            this.editor = window.ace.edit(this.editorId)
            this.editor.setValue(this.content, 1)

            // mode-xxx.js or theme-xxx.jsがある場合のみ有効
            this.editor.getSession().setMode(`ace/mode/${lang}`)
            this.editor.setTheme(`ace/theme/${theme}`)

            this.editor.on('change', () => {
                this.beforeContent = this.editor.getValue()
            this.$emit('change-content', this.editor.getValue())
        })
        }
    });

    Vue.directive('highlightjs', {
        deep: true,
        bind: function (el, binding) {
            // on first bind, highlight all targets
            let targets = el.querySelectorAll('code')
            targets.forEach((target) => {
                // if a value is directly assigned to the directive, use this
                // instead of the element content.
                if (binding.value) {
                target.textContent = binding.value
            }
            hljs.highlightBlock(target)
        })
        },
        componentUpdated: function (el, binding) {
            // after an update, re-fill the content and then highlight
            let targets = el.querySelectorAll('code')
            targets.forEach((target) => {
                if (binding.value) {
                target.textContent = binding.value
                hljs.highlightBlock(target)
            }
        })
        }
    });

    $(document).on('click', 'a#editContentButton', function () {
        $("#contentForm").addClass('explicitButtons');
    });

    <?php echo "var contentId = "; ?>{{ $options['id'] }}<?php echo ";"; ?>

    var contentEditor = new Vue({
            el: '#contentApp',
            data: {
                info: {},
                record: {},
                resource: {},
                payload: {},
                selected: '',
                deleted: '',
                editorHasErrors: false,
                fieldDisplayName: null,
                fieldSchema: null,
                resourceItem: null,
                resourceEditUrl: '',
                displayAddItemForm: null,
                newItemSchema: null,
                newItem: {},
                resourceOptions: null,
                status: 'loading',
                editorStatus: null,
                quillOptions: {
                    modules: {
                    }
                }
            },

            methods: {
                onEditorReady(){},
                onEditorFocus(){},
                ready(){},
                editJson(fieldInput){
                    this.fieldInput = JSON.parse(fieldInput);
                },
                addResourceItem(fieldSchema){

                    this.displayAddItemForm = true;
                    url = fieldSchema['options']['resource_schema_url'];
                    axios
                        .get(url)
                        .then(response => (this.newItemSchema = response.data)
                )
                    ;
                    return this.newItemSchema;
                },
                editResourceItem(item, field, value) {
                    var schema = item.schema;
                    if (schema.fields.hasOwnProperty(field)) {
                        var fieldSchema = schema['fields'][field];
                        var fieldType = schema['fields'][field]['type'];
                        var fieldInput = value;
                        this.updateFieldSchema(fieldSchema);
                        this.updateFieldName(schema['fields'][field]['display name']);
                        this.updateFieldSlug(field);
                        this.updateFieldType(schema['fields'][field]['type']);
                        if (this.fieldType == 'select') {
                            fieldInput = 'null';
                        }
                        else {
                            fieldInput = value;
                        }
                        this.updateFieldInput(fieldInput);
                        this.updateFieldDescription(schema['fields'][field]['description']);
                        this.updateFieldDisplayName(null);
                    }
                },
                deleteResourceItem(item){
                    url = this.resourceEditUrl + '?product_id=' + this.record.data.id + '&plan_id=' + item.id + '&delete=true&save=true';
                    console.log(url);
                    axios
                        .get(url)
                        .then(response => (this.info = response.data))
                    ;
                    if (this.info.status == 'success') {
                        //item.$remove(0)
                        console.log(this.resource);
                        this.getResource(this.resourceOptions);
                    }
                },
                viewItem(item){
                    this.resourceItem = item;
                },
                getResource(options){
                    this.resourceOptions = options;
                    if (typeof(options) == 'undefined') {
                        options = this.resourceOptions;
                    }
                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var string = '?get';
                    var record = this.record;
                    options.arguments.forEach(function (currentValue, index, array) {
                        string = string + '&' + currentValue['to'] + '=' + eval(currentValue['from']);
                    });
                    this.resourceEditUrl = options['resource_edit_url'];
                    var url = options.resource_get_url + string;
                    axios
                        .get(url, config)
                        .then(response => (this.resource = response.data)
                )
                    ;
                    return this.resource;
                },
                getSelected(sectionName, fieldSlug, optionKey){
                    if (((((data || {}).content || {}).sections || {}).sectionName || {}).fieldSlug != null) {
                        return (JSON.stringify(record['data']['content']['sections'][sectionName]['fields'][fieldSlug]) == optionKey);
                    }
                    else {
                        return null;
                    }
                },
                hasConditions(data, fieldConditions) {
                    var status = true;
                    if (fieldConditions != null) {
                        if (eval(fieldConditions)) {
                            status = true;
                        }
                        else {
                            status = false;
                        }
                    }

                    return status;
                },
                delete(){
                    return null;
                },
                changed(){
                    var payload = {};

                    payload[this.fieldName] = this.fieldInput;
                    console.log(payload);

                    this.payload = payload;
                    this.selected = this.fieldInput;
                    if(this.fieldType == 'code') {
                        this.editorHasErrors = 'pending';
                    }

                    if (this.resourceEditUrl != '' && this.resourceItem != null) {
                        url = this.resourceEditUrl + '?product_id=' + this.record.data.id + '&plan_id=' + this.resourceItem.id + '&' + this.fieldName.toLowerCase() + '=' + this.fieldInput;
                    }
                    else if (this.resourceEditUrl != '' && this.resourceItem == null) {
                        url = this.resourceEditUrl + '?product_id=' + this.record.data.id + '&newItem=' + JSON.stringify(this.newItem);
                    }
                    else {
                        url = '/api/resources/{{ $options['type'] }}/' + contentId;
                    }
                    payload = {data: payload, validate: true};
                    console.log('Payload:');
                    console.log(payload);
                    axiosConfig = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache',
                            "Access-Control-Allow-Origin": "*"
                        }
                    };
                    axios({
                        method: 'post',
                        url: url,
                        headers: axiosConfig,
                        data:payload
                    }).then(response => (this.info = response.data));
                    console.log('Server recieved:');
                    console.log(this.info);
                },
                refreshTagInput(tagInput) {
                    this.fieldInput = tagInput;
                },
                newTag(){
                    fieldInput = $('#tagInput').val();
                    this.fieldInput = fieldInput;
                    var payload = {};
                    payload['add'] = this.fieldInput;
                    url = '/api/resources/{{ $options['type'] }}/' + contentId + '?validate&tags=' + encodeURIComponent(JSON.stringify(payload));
                    axios
                        .post(url)
                        .then(response => (this.info = response.data)
                )
                    ;
                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var url2 = '/api/resources/{{ $options['type'] }}/' + contentId;
                    axios
                        .get(url2, config)
                        .then(response => (this.record = response.data)
                )
                    ;
                    this.fieldInput = null;
                },
                removeTag(tagId){
                    var payload = {};
                    payload['untag'] = tagId;
                    url = '/api/resources/{{ $options['type'] }}/' + contentId + '?validate&tags=' + encodeURIComponent(JSON.stringify(payload));
                    axios
                        .post(url)
                        .then(response => (this.info = response.data)
                )
                    ;
                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var url2 = '/api/resources/{{ $options['type'] }}/' + contentId;
                    axios
                        .get(url2, config)
                        .then(response => (this.record = response.data)
                )
                    ;
                },
                getSelected(){
                    return this.selected;
                },
                save(){
                    var title = '';
                    var slug = '';
                    var status = '';
                    var payload = {};
                    if (this.newItemSchema != null) {
                        url = this.resourceEditUrl + '?product_id=' + this.record.data.id + '&save=true&newItem=' + JSON.stringify(this.newItem);
                        console.log(url);
                        axios
                            .get(url)
                            .then(response => (this.info = response.data)
                    );
                        if (this.info.status == 'success') {
                            this.displayAddItemForm = null;
                            this.newItemSchema = null;
                            this.resourceItem = null;
                            this.getResource(this.resourceOptions);
                            this.newItem = {};
                        }
                    }
                    else {
                        payload[this.fieldName] = this.fieldInput;
                        if (this.resourceEditUrl != '') {
                            url = this.resourceEditUrl + '?product_id=' + this.record.data.id + '&plan_id=' + this.resourceItem.id + '&' + this.fieldName.toLowerCase() + '=' + this.fieldInput + '&save=true';
                        }
                        else {
                            url = '/api/resources/{{ $options['type'] }}/' + contentId;
                        }
                        payload = {'data':payload, 'save': true};
                        console.log('Payload:');
                        console.log(payload);
                        axios
                            .post(url, payload)
                            .then(response => (this.info = response.data)
                    );

                        if (this.info.status == 'success') {
                            $('#modal-edit-content').modal('toggle');
                        }
                        var config = {
                            headers: {
                                'Content-Type': 'application/json',
                                'Cache-Control': 'no-cache'
                            }
                        };
                        var url2 = '/api/resources/{{ $options['type'] }}/' + contentId;
                        axios
                            .get(url2, config)
                            .then(response => (this.record = response.data));
                    }
                },
                updateSectionName(sectionName) {
                    if (typeof(sectionName) == 'undefined') {
                        this.sectionName = null;
                    }
                    else {
                        this.sectionName = sectionName;
                    }
                    return sectionName;
                },
                updateFieldSchema(fieldSchema){
                    if (typeof(fieldSchema) == 'undefined') {
                        this.fieldSchema = null;
                    }
                    else {
                        this.fieldSchema = fieldSchema;
                    }
                    return fieldSchema;
                },
                updateFieldName(fieldName){
                    if (typeof(fieldName) == 'undefined') {
                        this.fieldName = '';
                    }
                    else {
                        this.fieldName = fieldName;
                    }
                    this.info.status = null;
                    return String(this.fieldType);
                },
                updateFieldSlug(fieldSlug){
                    if (typeof(fieldName) == 'undefined') {
                        this.fieldSlug = null;
                    }
                    else {
                        this.fieldSlug = fieldSlug;
                    }
                    return String(this.fieldSlug);
                },
                fieldSlug(){
                    return String(this.fieldSlug);
                },
                fieldName(){
                    return String(this.fieldName);
                },
                updateFieldType(fieldType){
                    if (typeof(fieldType) == 'undefined') {
                        this.fieldType = '';
                    }
                    else {
                        this.fieldType = fieldType;
                    }
                    return String(this.fieldType);
                },
                fieldType(){
                    return String(this.fieldType);
                },
                updateFieldDisplayName(fieldDisplayName){
                    if (typeof(fieldDisplayName) == 'undefined') {
                        this.fieldType = '';
                    }
                    else {
                        this.fieldDisplayName = fieldDisplayName;
                    }
                    return String(this.fieldDisplayName);
                },
                fieldType(){
                    return String(this.fieldDisplayName);
                },
                updateFieldInput(fieldInput){
                    this.changed();
                    if(this.fieldType == 'code') {
                        var test = (fieldInput !== undefined && fieldInput !== null && fieldInput.constructor == Object);
                        if(test) {
                            this.fieldInput = JSON.stringify(fieldInput, null, 2);
                        }
                    }
                    else {
                        this.fieldInput = fieldInput;
                    }
                    return String(this.fieldInput);
                },
                fieldInput(){
                    return String(this.fieldInput);
                    this.code = this.fieldInput;
                },
                updateFieldDescription(fieldDescription){
                    this.fieldDescription = fieldDescription;
                    return String(this.fieldDescription);
                },
                fieldDescription(){
                    return String(this.fieldDescription);
                },
                refresh(argument) {
                    if (argument === 'delete') {
                        console.log('Deleting {{ $options['type'] }} #' + contentId + '...');
                        url1 = '/api/resources/{{ $options['type'] }}/' + contentId;
                        payload = {'data': {}, 'delete': true};
                        axios
                            .delete(url1, payload)
                            .then(response => (this.info = response.data)
                    )
                        ;
                        window.location.href = "{{ $options['index_uri'] }}";
                    }

                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var url2 = '/api/resources/{{ $options['type'] }}/' + contentId;
                    axios
                        .get(url2, config)
                        .then(response => (this.record = response.data)
                )
                    ;
                },
                updateStatus(status){
                    this.editorStatus = status;
                },
                updateForm(options){
                    this.newItemSchema = null;
                    this.displayAddItemForm = null;
                    this.newItemSchema = null;
                    $("#contentForm").removeClass('explicitButtons');
                    this.updateSectionName(options.sectionName);
                    this.updateFieldSchema(options.fieldSchema);
                    this.updateFieldName(options.fieldName);
                    this.updateFieldSlug(options.fieldSlug);
                    this.updateFieldType(options.fieldType);
                    if (options.fieldType == 'select') {
                        fieldInput = 'null';
                    }
                    else {
                        fieldInput = options.fieldInput;
                    }
                    this.updateFieldInput(fieldInput);
                    this.updateFieldDescription(options.fieldDescription);
                    this.updateFieldDisplayName(options.fieldDisplayName);
                    if (options.fieldType == 'resource') {
                        this.getResource(options.fieldSchema.options);
                    }
                    if(this.fieldType == 'richtext') {
                        var quill = new Quill('#editor', {
                            modules: {
                                syntax: true,              // Include syntax module
                                toolbar: [['code-block']]  // Include button in toolbar
                            },
                            theme: 'snow'
                        });
                    }
                    this.resourceItem = null;
                    this.editorHasErrors = false;
                }
            },
            mounted () {
                var config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'Cache-Control': 'no-cache'
                    }
                };
                var url2 = '/api/resources/{{ $options['type'] }}/' + contentId;
                axios
                    .get(url2, config)
                    .then(response => (this.record = response.data)
            )
                ;
                this.status = 'loaded';
            }

        });
</script>