<div class="btn-group mb-1">
    <a href="#" class="btn btn-white pull-right actionButton" data-toggle="modal" v-if="info != null"  v-bind:class="{ active: displayFormat == 'list' }"  v-on:click="displayFormat = 'list'"
       style="width:auto !important;padding-top:7px;float:right;"><i class="material-icons">list</i> &nbsp;List</a>
    <a href="#" class="btn btn-white pull-right actionButton" data-toggle="modal" v-if="info != null" v-bind:class="{ active: displayFormat == 'cards' }" v-on:click="displayFormat = 'cards'"
       style="width:auto !important;padding-top:7px;float:right;"><i class="material-icons">view_week</i> &nbsp;Cards</a>
</div>