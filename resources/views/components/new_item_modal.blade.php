<!-- Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="newItemApp" v-if="status == 'loaded'">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New <span class="text-capitalize" v-if="info.data != null && info.data.schema != null && info.data.schema.lang.en.singular != null">@{{ info.data.schema.lang.en.singular }}</span><span v-else>Item</span></h5>
            </div>
            <div class="modal-body">
                <div v-for="item, index in info.data.schema.fields" class="pt-2 mt-2">
                    <span class="badge badge-light text-dark mb-2" v-if="item['display name'] != null">
                        @{{ item['display name'] }}
                    </span>
                    <span class="badge badge-light text-dark mb-2 text-capitalize" v-else>
                        @{{ index }}
                    </span>
                    <input class="form-control mt-2" v-model="newItemInput[index]">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>