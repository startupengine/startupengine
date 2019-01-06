<script>
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

    var newItemApp = new Vue({
        el: '#newItemApp',
        data: {
            test: '1234',
            info: {},
            record: {},
            resource: {},
            type: '',
            payload: {},
            selected: '',
            deleted: '',
            editorHasErrors: false,
            fieldDisplayName: null,
            resourceItem: null,
            resourceEditUrl: '',
            validationResults: {},
            displayAddItemForm: null,
            newItemSchema: null,
            newItemInput: {},
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
            changed(){
                var payload = {};

                payload = this.newItemInput;
                console.log(payload);
                this.payload = payload;
                url = '/api/resources/' + this.type;
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
                }).then(response => (this.validationResults = response.data));
                console.log('Server recieved:');
                console.log(this.info);
            },
            save(){
                var title = '';
                var slug = '';
                var status = '';
                var payload = {};

                    payload[this.fieldName] = this.fieldInput;
                    if (this.resourceEditUrl != '') {
                        url = this.resourceEditUrl + '?product_id=' + this.record.data.id + '&plan_id=' + this.resourceItem.id + '&' + this.fieldName.toLowerCase() + '=' + this.fieldInput + '&save=true' @if(isset($options['URL_PARAMETERS'])) + '&{!! $options['URL_PARAMETERS'] !!}' @endif ;
                    }
                    else {
                        url = '/api/resources/{{ $options['type'] }}/' + contentId @if(isset($options['URL_PARAMETERS'])) + '?{!! $options['URL_PARAMETERS'] !!}' @endif ;
                    }
                    payload = {'data':payload, 'save': true};
                    console.log('Payload:');
                    console.log(payload);
                    axios
                        .post(url, payload)
                        .then(response => (this.info = response.data)
                );

                    if (this.info.status == 'success') {
                        $('#modal-new-item').modal('toggle');
                    }
                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var url2 = '/api/resources/' + this.type;
                    axios
                        .get(url2, config)
                        .then(response => (this.record = response.data));

            },
            updateStatus(status){
                this.editorStatus = status;
            },
            updateType(input){
                this.type = input;
            },
            newItem(options){
                this.type = options.type;
                var config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'Cache-Control': 'no-cache'
                    }
                };
                var url = '/api/resources/' + this.type;
                axios
                    .post(url, config)
                    .then(response => (this.info = response.data));
            }
        },
        mounted () {
            this.status = 'loaded';
            console.log('1234');
        }

    });
</script>