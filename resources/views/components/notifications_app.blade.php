<div id="notificationsApp">
    <vue-snotify></vue-snotify>
</div>
<script>
    var notificationsApp = new Vue({
        el: '#notificationsApp',
        data: {},
        methods: {
            infoNotification(input){
                this.$snotify.info(input);
            },
            errorNotification(input){
                this.$snotify.error(input);
            }
        },
        mounted() {
        }
    })
</script>