<script>

    var newUserApp = new Vue({
        el: '#newUserApp',
        data: {
            info: {},
            record: {},
            payload: {},
            validationResults: {},
            newItemSchema: null,
            newItemInput: {},
            status: 'loading',
            savedItem: {},
            formSubmitted: null
        },

        methods: {
            onSubmit(){},
            changed(input){
                this.appStatus = 'editing';
                if(input == true){
                    this.formSubmitted = true;
                }
                if(this.formSubmitted != null) {
                    var payload = {};
                    payload = this.newItemInput;
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
                        data: payload
                    }).then(response => (this.validationResults = response.data));
                }
            },
            updateSavedItem(data){
                this.savedItem = data;
                this.status = 'success';
            },
            save(){
                this.status = 'loading';
                //console.log('Saving...');
                var payload = {};

                payload = this.newItemInput;
                //console.log(payload);
                this.payload = payload;
                url = '/api/resources/' + this.type;
                payload = {data: payload, save: true};
                //console.log('Payload:');
                //console.log(payload);
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
                    data: payload
                }).then(response => (this.updateSavedItem(response.data)));
            },
            updateNewItem(input){
                this.info = input;
            },
            newItem(options){
                this.savedItem = {};
                this.validationResults = {};
                this.status = 'loaded';
                this.formSubmitted = true;
                this.type = options.type;
                var config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'Cache-Control': 'no-cache'
                    },
                    data: this.newItemInput,
                    save: true
                };
                var url = '/api/new-register';
                axios
                    .post(url, config)
                    .then(response => (this.updateNewItem(response.data)));
            }
        },
        mounted () {
            this.status = 'loaded';
        }

    });
</script>