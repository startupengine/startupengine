<div class="btn-group mb-1">
    <a href="#" class="btn btn-secondary pull-right actionButton ml-1" data-toggle="modal" v-if="info != null"
       data-target="#modal-filter-content" style="width:auto !important;padding-top:10px;float:right;"><i class="fa fa-filter"></i> &nbsp;Filter Results</a>
    <div class="btn btn-danger btn-danger-light pull-right" v-if="filterString != '' && filterString != '&filter=' || search != ''" v-on:click="reset({'filters':true, 'search':true})"
         style="width:auto !important;padding-top:10px;float:right;"><i class="fa fa-times"></i> &nbsp;Clear Filters</div>
</div>