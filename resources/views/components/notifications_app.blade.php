<div id="notificationsApp">
    <vue-snotify></vue-snotify>
</div>
<script>
    var notificationsApp = new Vue({
        el: '#notificationsApp',
        data: {},
        methods: {
            infoNotification(input){
                this.$snotify.info(input,  {
                    timeout: 10000,
                    pauseOnHover: true
                });
            },
            errorNotification(input){
                this.$snotify.error(input,  {
                    timeout: 10000,
                    pauseOnHover: true
                });
            }
        },
        mounted() {
        }
    })
</script>