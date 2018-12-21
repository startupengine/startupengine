<div class="modal fade" tabindex="-1" role="dialog" id="confirmActionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  v-if="options != null && options.transformation != null">
            <div class="modal-header">
                <h5 class="modal-title" v-if="instance != null && instance.transformationResult != null && instance.transformationResult.data.meta.status == 'success'">Success</h5>
                <h5 class="modal-title" v-else-if="instance != null && instance.transformationResult != null && instance.transformationResult.data.meta.status == 'error'">Error</h5>
                <h5 class="modal-title" v-else-if="options.transformation != null && options.transformation.label != null">@{{ options.transformation.label }}</h5>
                <h5 class="modal-title" v-else>Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div v-if="hasOptions()">
                    <div class="card-text pb-4">@{{ options.transformation.description }}<br><div v-if="message == null">Select an option.</div><div v-else>@{{ message }}</div></div>
                    <select class="form-control" v-model="selectedOption" v-if="options.transformation.hasOwnProperty('options')">
                        <option disabled value="defaultChoice">Choose an option...</option>
                        <option v-for="option,key in options.transformation.options" :value="key">@{{ option.label }}</option>
                    </select>
                    <p class="card-text text-primary mt-4" style="opacity:0.75;" v-if="selectedOption != 'defaultChoice' && options.transformation.options[selectedOption].description != null">@{{ options.transformation.options[selectedOption].description }}</p>
                </div>
                <div v-else>
                    <p v-if="instance != null && instance.transformationResult != null && instance.transformationResult.data.meta.status == 'success'">
                        <span v-if="options.transformation.success_message != null">@{{ options.transformation.success_message }}</span>
                        <span v-else>Action completed successfully.</span>
                    </p>
                    <p v-else-if="instance != null && instance.transformationResult != null && instance.transformationResult.data.meta.status == 'error'">Something went wrong.</p>
                    <p class="card-text" v-else-if="instance != null && instance.transformationResult == null && options.transformation.hasOwnProperty('confirmation_message')" >@{{ options.transformation.confirmation_message }}</p>
                </div>
            </div>
            <div class="modal-footer px-3" v-if="instance !== null">
                <div v-if="options.transformation.options == null">
                    <button v-if="instance.transformationResult == null" type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button v-if="instance.transformationResult != null && instance.transformationResult.data.meta.status == 'success'" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check-circle text-white mr-2"></i>Okay</button>
                    <button v-if="instance.transformationResult == null" type="button" class="btn btn-danger" id="confirmActionButton" v-on:click="transform(options.id, options.transformation, options.action)">Confirm</button>
                </div>
                <div v-else>
                    <button v-if="instance.transformationResult == null" type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button v-if="instance.transformationResult == null && selectedOption != 'defaultChoice' " type="button" class="btn btn-primary" id="confirmActionButton" v-on:click="transform(options.id, options.transformation, selectedOption, true)">Confirm</button>
                    <button v-if="instance.transformationResult == null && selectedOption == 'defaultChoice' " type="button" class="btn btn-primary disabled" id="confirmActionButton" v-on:click="transform(options.id, options.transformation, selectedOption, true)">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>