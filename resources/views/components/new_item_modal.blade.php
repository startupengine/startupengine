<!-- Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="newItemApp" v-if="info != null">
            <div v-if="status == 'success'">
                <div class="modal-body p-4" align="center">
                    <p class="text-dark my-2">
                        <i class="fa fa-fw fa-check-circle text-success mr-2"></i>Your item was saved.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-outline-primary" v-bind:href="redirectPath() + savedItem.data.id">Continue Editing</a>
                </div>
            </div>
            <div v-if="status == 'loading'">
                <div class="modal-body p-4" align="center">
                    <p class="text-dark my-2">
                        Loading...
                    </p>
                </div>
            </div>
            <div v-if="status == 'loaded'">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New <span class="text-capitalize" v-if="info.data != null && info.data.schema != null && info.data.schema.lang.en.singular != null">@{{ info.data.schema.lang.en.singular }}</span><span v-else>Item</span></h5>
                </div>


                <div class="modal-body p-4">
                    <div v-for="item, index in info.data.schema.fields" class="pt-0 mb-2" v-if="item != null && item.validations != null && item.validations.required">
                        <span class="badge badge-light text-dark mt-2 d-inline-block" v-if="item['display name'] != null">
                            @{{ item['display name'] }}
                        </span>
                        <span class="badge badge-light text-dark mt-2 text-capitalize d-inline-block" v-else>
                            @{{ index }}
                        </span>
                        <p class="text-dark my-0">
                            @{{ item['description'] }}
                        </p>
                        <?php /* <input class="form-control mt-2" v-model="newItemInput[index]" v-on:input="changed()"> */ ?>
                        {!! renderFormInputs() !!}
                        <p class="text-danger my-2" v-if="validationResults.hasOwnProperty('meta') && validationResults.meta.hasOwnProperty('fields')  && validationResults.meta.fields.hasOwnProperty(index)">
                            @{{ validationResults.meta.fields[index]['first_error'] }}
                        </p>
                    </div>
                    <div v-for="item, index in info.data.schema.sections" class="pt-2 mt-2" v-if="sectionHasValidations(item)">
                        <hr class="mb-4">
                        <span class="card-text badge-section text-dark my-2 mb-4" v-if="item['display name'] != null">
                            @{{ item['display name'] }}
                        </span>
                        <span class="card-text badge-section text-dark my-2 mb-4 text-capitalize" v-else>
                            @{{ index }}
                        </span>
                        <div v-for="field, fieldIndex in item.fields" class="pt-2 mt-2" v-if="field.validations != null && field.validations.required == true">
                            <span class="badge badge-light text-dark mb-2" v-if="field['display name'] != null">
                                @{{ field['display name'] }}
                            </span>
                                <span class="badge badge-light text-dark mb-2 text-capitalize" v-else>
                                @{{ fieldIndex }}
                            </span>
                            <p class="text-dark my-2">
                                @{{ field['description'] }}
                            </p>
                            {!! renderFormInputs(["jsonFields" => true, "fieldName" => "field"]) !!}
                            <?php /* <input class="form-control mt-2" v-model="" v-on:input="changed()"> */ ?>
                            <p class="text-danger my-2" v-if="validationResults.hasOwnProperty('meta') && validationResults.meta.hasOwnProperty('fields')  && validationResults.meta.fields.hasOwnProperty('json.sections.' + index + '.fields.' + fieldIndex)">
                                @{{ validationResults.meta.fields['json.sections.' + index + '.fields.' + fieldIndex]['first_error'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-success" v-if="validationResults != {} && validationResults.hasOwnProperty('status')  && validationResults.status == 'success'" v-on:click="save()" >Save</button>
                    <button type="button" class="btn btn-outline-primary disabled" v-else-if="validationResults != {} && validationResults.hasOwnProperty('errors')">Validate Input</button>
                    <button type="button" class="btn btn-primary" v-on:click="changed(true)" v-else>Validate Input</button>
                </div>
            </div>

        </div>
    </div>
</div>