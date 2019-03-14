<div class="btn-group mb-1">
    <a href="#" class="btn btn-light border pull-right actionButton" data-toggle="modal" v-if="info != null"  v-bind:class="{ active: displayFormat == 'list' }"  v-on:click="displayFormat = 'list'"
       style="width:auto !important;padding-top:10px;padding-bottom:10px;float:right;"><i class="material-icons" style="top:2px;">list</i><span class="hiddenOnMobile"> &nbsp;List View</span></a>
    <a href="#" class="btn btn-light border pull-right actionButton" data-toggle="modal" v-if="info != null" v-bind:class="{ active: displayFormat == 'cards' }" v-on:click="displayFormat = 'cards'"
       style="width:auto !important;padding-top:10px;padding-bottom:10px;float:right;"><i class="material-icons" style="top:1.5px;">view_week</i><span class="hiddenOnMobile"> &nbsp;Card View</span></a>
</div>