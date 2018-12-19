<script>
    var confirmActionApp = new Vue({
        el: '#confirmActionModal',
        data() { return {
            options: {},
            instance: null,
            response:null,
            selectedOption: 'defaultChoice',
            message: ''
        }
        },
        methods: {
            hasOptions(){
                if(this.options.transformation.options != null) {
                    return true;
                }
                else {
                    return false;
                }
            },
            hasMessage(){
                return true;
            },
            getMessage(){
                return this.message;
            },
            transform(id, transformation, action){
                this.response = this.instance.transform(id, transformation, action, true);
            }
        }
    });

    confirmAction = function(options){
        this.options = {};
        var message = options.message;

        if (typeof options.action === "undefined") {
            options.action = null;
        }
        confirmActionApp.options = options;

        if(options.hasOwnProperty('confirmation_message')) {
            confirmActionApp.message = options.confirmation_message;
        }

        if(options.hasOwnProperty('instruction')) {
            confirmActionApp.message = options.instruction;
        }

        if(options.hasOwnProperty('options')) {
            var transformationOptions = Object.keys(options.transformation.options).map(function (key) {
                return [key, options.transformation.options[key]];
            });
            console.log('Options: ' + transformationOptions);
            var currentlySelected = transformationOptions.find(function (element) {
                return element.selected == true;
            });
            console.log('Currently Selected: '+ currentlySelected);
        }

        if(currentlySelected != null){
            confirmActionApp.selectedOption = currentlySelected.slug;
        }
        else {
            confirmActionApp.selectedOption = 'defaultChoice';
        }

        confirmActionApp.instance = window[options.appName];
        $('#confirmActionModal').modal('toggle');
    }

    closeConfirmActionModal = function(){
        $('#confirmActionModal').modal('toggle');
    }
</script>