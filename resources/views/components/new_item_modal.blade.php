<!-- Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="newItemApp" v-if="status == 'loaded'">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New <span class="text-capitalize" v-if="info.data != null && info.data.schema != null && info.data.schema.lang.en.singular != null">@{{ info.data.schema.lang.en.singular }}</span><span v-else>Item</span></h5>
            </div>
            <div class="modal-body">
                <div v-for="item, index in info.data.schema.fields" class="pt-2 mt-2" v-if="item.validations.required">
                    <span class="badge badge-light text-dark mb-2" v-if="item['display name'] != null">
                        @{{ item['display name'] }}
                    </span>
                    <span class="badge badge-light text-dark mb-2 text-capitalize" v-else>
                        @{{ index }}
                    </span>
                    <input class="form-control mt-2" v-model="newItemInput[index]" v-on:input="changed()">
                    <p class="text-danger my-2" v-if="validationResults.hasOwnProperty('meta') && validationResults.meta.hasOwnProperty('fields')  && validationResults.meta.fields.hasOwnProperty(index)">
                        @{{ validationResults.meta.fields[index]['first_error'] }}
                    </p>
                </div>
                <div v-for="item, index in info.data.schema.sections" class="pt-2 mt-2">
                    <hr class="mb-4">
                    <span class="card-text badge-section text-dark my-2 mb-4" v-if="item['display name'] != null">
                        @{{ item['display name'] }}
                    </span>
                    <span class="card-text badge-section text-dark my-2 mb-4 text-capitalize" v-else>
                        @{{ index }}
                    </span>
                    <div v-for="field, fieldIndex in item.fields" class="pt-2 mt-2">
                        <span class="badge badge-light text-dark mb-2" v-if="field['display name'] != null">
                            @{{ field['display name'] }}
                        </span>
                            <span class="badge badge-light text-dark mb-2 text-capitalize" v-else>
                            @{{ fieldIndex }}
                        </span>
                        <input class="form-control mt-2" v-model="newItemInput['json.sections.'+ index + '.fields.' + fieldIndex]" v-on:input="changed()">
                        <p class="text-danger my-2" v-if="validationResults.hasOwnProperty('meta') && validationResults.meta.hasOwnProperty('fields')  && validationResults.meta.fields.hasOwnProperty('sections.' + index + '.fields.' + fieldIndex)">
                            @{{ validationResults.meta.fields['sections.' + index + '.fields.' + fieldIndex]['first_error'] }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary disabled" v-if="validationResults != {} && validationResults.hasOwnProperty('errors')">Save changes</button>
                <button type="button" class="btn btn-primary" v-on:click="changed()" v-else>Save changes</button>
            </div>
        </div>
    </div>
</div>