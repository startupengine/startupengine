<script>
    stripeApp = new Vue({
            el: '#stripeApp',
            data: {
                info: {},
                payload: {},
                hasErrors: false,
                status: 'loading'
            },
            methods: {
                onSubmit(input) {
                    console.log('test');
                    console.log(input);
                },
                updateInfo(info){
                    this.info = info;
                    this.status = 'loaded';
                },
                updatePayload(payload){
                    this.payload = payload;
                    //console.log(this.payload);
                    this.updateMethod();
                },
                updateMethod(){
                    this.status = 'loading';
                    var config = {
                        headers: {
                            'Content-Type': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    };
                    var url = '/api/stripe/payments/method';
                    payload = {data: this.payload};
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
                    }).then(response => (this.updateInfo(response.data))
                );
                }
            },
            mounted () {
                this.status = 'loaded';
            }
        });
</script>