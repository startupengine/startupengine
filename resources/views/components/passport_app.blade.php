<div id="passportApp"></div>
<script>
     axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Authorization': '{!! passportAuthorizationHeader() !!}'
    };

    var passportApp = new Vue({
        el: '#passportApp',
        data: {
            csrfToken: '',
            accessToken: '{!! passportAuthorizationHeader() !!}'
        },
        methods: {
            getCsrfToken(){
                this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
        },
        mounted() {
            this.getCsrfToken();
        }
    })
</script>