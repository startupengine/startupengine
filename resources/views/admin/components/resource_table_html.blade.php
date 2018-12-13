<div class="col-md-12" v-if="info.data == null">
    <span class="badge badge-loading text-dark mr-2">Loading... <i
                class="fa fa-fw fa-spin text-dark fa-spinner"></i></span>
</div>
<div v-if="info != null & info.data != null" style="width:calc(100%);height:100%;opacity:0;" v-bind:style="{ 'opacity': '1' }">
    <div class="{{ $options['WRAPPER_CLASS'] }}" style="height:100%;">
    <div class="card card-small mb-4" id="listView" style="min-width:100%;height:100%;" v-if="displayFormat == 'list'" >
        <div class="card-header" align="center">
            {!! $options['HEADER']  !!}
        </div>
        <div class="card-body p-0 pb-0 text-center">
            <table class="table mb-0">
                @if(isset( $options['TABLE_HEADER']))
                <thead class="bg-light border-top" style="max-width:100%;">
                <tr>
                    {!! $options['TABLE_HEADER'] !!}
                </tr>
                </thead>
                @endif
                <tbody>

                <tr class="dataRow" v-for="(item, index) in info.data" @if( isset($options['TABLE_ROW_CONDITIONS'] )) v-if="{!! $options['TABLE_ROW_CONDITIONS']  !!}" @endif>
                    {!! $options['TABLE_ROW']  !!}
                </tr>
                @if( !isset($options['TABLE_ROW_NO_RESULTS_CONDITIONS'] ))
                <tr v-if="info.meta.total == 0 && status !== 'loading'">
                    <td colspan="5" class="dimmed" align="center" style="height:55px;">No results.</td>
                </tr>
                @endif
                @if( isset($options['TABLE_ROW_NO_RESULTS_CONDITIONS'] ))
                        <td v-if="info.data.every(function(item){return ( {!! $options['TABLE_ROW_NO_RESULTS_CONDITIONS'] !!} )}) && status != 'loading'" colspan="5" class="dimmed" align="center" style="height:55px;">@if(isset($options['TABLE_ROW_NO_RESULTS_MESSAGE'])) {{ $options['TABLE_ROW_NO_RESULTS_MESSAGE'] }} @else No results. Try different settings.@endif</td>
                @endif
                <tr class="loadingRow" v-if="status == 'loading'">
                    <td colspan="5" align="center">
                        <span style="display:none;">Loading...</span><i class="fa fa-fw fa-spin fa-spinner"></i>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>
        @if(isset($options['TABLE_FOOTER']))
            <div class="card-footer">
                <div class="py-1" align="center">
                    {!! $options['TABLE_FOOTER'] !!}
                </div>
            </div>
        @else

            <div align="center"  v-if="info.meta.pages > 0" class="card-footer align-text-bottom"
                 style="bottom: 0px;width: 100% !important;display: table;">
                <nav aria-label="Pagination" class="pull-left page-meta-container"
                     style="display:inline-block;float:left; width:75px;">
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item disabled page-meta">
                            <a class="page-link" href="#">P<span class="hiddenOnMobile">age</span><span
                                        class="hiddenOnDesktop">g.</span> @{{ info.meta.current_page }}
                                <span class="hiddenOnMobile"> of @{{ info.meta.pages}} </span></a>
                        </li>
                    </ul>
                </nav>

                <nav aria-label="Pagination" style="display:inline-block;">
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item">
                            <a class="page-link" href="#"
                               v-on:click="updateData(info.meta.current_page - 1)"
                               v-bind:data-url="info.links.prev_page_url" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item hiddenOnMobile" v-on:click="updateData(1)"
                            v-bind:class="{ active: info.meta.current_page == 1 }"><a class="page-link"
                                                                                      href="#">1</a></li>
                        <li v-if="info.meta.pages > 1"
                            v-bind:class="{ active: info.meta.current_page == 2 }"
                            class="page-item hiddenOnMobile" v-on:click="updateData(2)"><a class="page-link"
                                                                                           href="#">2</a>
                        </li>
                        <li v-if="info.meta.pages > 2"
                            v-bind:class="{ active: info.meta.current_page == 3 }"
                            class="page-item hiddenOnMobile" v-on:click="updateData(3)"><a class="page-link"
                                                                                           href="#">3</a>
                        </li>
                        <li v-if="info.meta.pages > 5 && info.meta.current_page <= (info.meta.pages - 3) && info.meta.current_page != 4"
                            class="page-item disabled hiddenOnMobile"><a class="page-link" href="#">...</a>
                        </li>
                        <li v-if="info.meta.current_page > 3 && info.meta.current_page <= (info.meta.pages - 3)"
                            class="page-item active hiddenOnMobile"><a class="page-link" href="#">@{{
                                info.meta.current_page }}</a></li>
                        <li class="page-item active hiddenOnDesktop"><a class="page-link" href="#">@{{
                                info.meta.current_page }}</a></li>
                        <li data-test="4" v-if="info.meta.current_page >= 4 && info.meta.pages > 6"
                            class="page-item disabled hiddenOnMobile"><a class="page-link" href="#">...</a>
                        </li>
                        <li data-test="3" v-if="info.meta.pages >= 6 "
                            v-bind:class="{ active: info.meta.current_page == (info.meta.pages - 2) }"
                            class="page-item hiddenOnMobile" v-on:click="updateData(info.meta.pages - 2)"><a
                                    class="page-link" href="#">@{{ info.meta.pages - 2}}</a></li>
                        <li data-test="2" v-if="info.meta.pages >= 5 "
                            v-bind:class="{ active: info.meta.current_page == (info.meta.pages - 1) }"
                            class="page-item hiddenOnMobile" v-on:click="updateData(info.meta.pages - 1)"><a
                                    class="page-link" href="#">@{{ info.meta.pages - 1}}</a></li>
                        <li data-test="1" v-if="info.meta.pages >= 4 "
                            v-bind:class="{ active: info.meta.current_page == (info.meta.pages) }"
                            v-bind:class="{ disabled: (info.meta.current_page == info.meta.pages) }"
                            class="page-item hiddenOnMobile" v-on:click="updateData(info.meta.pages)"><a
                                    class="page-link" href="#">@{{ info.meta.pages }}</a></li>
                        <li class="page-item"
                            v-bind:class="{ disabled: (info.meta.current_page == info.meta.pages) }">
                            <a class="page-link" href="#"
                               v-on:click="updateData(info.meta.current_page + 1)" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <nav aria-label="Pagination" class="right page-meta-container"
                     style="display:inline-block;float:right; width:75px;">
                    <ul class="pagination justify-content-center mt-3">
                        <li class="page-item disabled page-meta">
                            <a class="page-link hiddenOnDesktop" href="#">of @{{ info.meta.pages }}</a>
                        </li>
                    </ul>
                </nav>
            </div>

        @endif
    </div>
    </div>
    @if(1 == 1)
    <div class="col-md-12">
    <div id="cardView" v-if="displayFormat == 'cards'">
        <div class="row row-eq-height">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 " v-if="info.total == 0">
                <div class="card card-small h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-ford-blue" href="#">No results.</a>
                        </h5>
                        <p class="card-text">Try changing your filters or search terms.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 loadingRow" v-if="status == 'loading'" >
                <div class="card card-small h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-ford-blue" href="#">Loading...</a>
                        </h5>
                        <p class="card-text" align="center"><i class="fa fa-fw fa-spinner fa-spin"></i></p>
                    </div>
                </div>
            </div>

            <div v-if="info.data != null" class="col-lg-3 col-md-6 col-sm-12 mb-4 dataRow" v-for="item in info.data"
                 >
                <div class="card card-small h-100"
                     v-if="item.content != null && item.content.sections != null">
                    <div v-if="(item.thumbnail != null && item.thumbnail != '')"
                         class="card-post__image"
                         v-bind:style="{ backgroundImage: 'url(' + item.thumbnail + ')' }"
                         style="background: #333; );">
                        <span v-for="tag in item.tags.slice(0,3)" class="badge badge-dark badge-pill mt-2 mr-2"
                              v-if="tag != null" style="float:right;">@{{ tag.name }}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">
                            <a class="text-ford-blue text-capitalize" v-bind:href="'<?php echo $options['PATH'] ?>/' + item.id">{{ item.<?php echo $options['CARD_HEADER_FIELD']; ?>}}</a>
                        </h5>
                        <p class="card-text dimmed my-2" style="text-transform:capitalize;">Last Updated @{{
                            moment(item.updated_at, "YYYYMMDD").fromNow() }}
                        </p>
                        <p class="card-text mt-2 mb-3">{{ item.<?php echo $options['CARD_BODY_FIELD']; ?> }}</p>
                        <div v-if="item.thumbnail == null" align="left">
                            <span v-for="tag in item.tags.slice(0,3)" class="badge badge-dark badge-pill mt-2 mr-2"
                                  style="float:left;">@{{ tag.name }}</span>
                        </div>
                        @if(isset($options['CARD_BODY_HTML']))
                            {!! $options['CARD_BODY_HTML'] !!}
                        @endif
                    </div>
                    <div class="card-footer border-top p-0 pt-3 pb-3" align="center">
                        <div align="center">
                            <div class="btn-group mb-2" role="group" aria-label="Table row actions">
                                <a href="" class="btn btn-outline-primary btn-pill"
                                   v-bind:href="'<?php echo $options['PATH'] ?>/' + item.id">
                                    <i class="material-icons">search</i> View
                                </a>
                                <?php /*
                                        <a href="" class="btn btn-white" v-bind:href="'/admin/content/edit/' + item.post_type + '/' + item.id">
                                <i class="material-icons">bar_chart</i> Analytics
                                </a> */ ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12 pb-4 px-0" align="center">
            <nav aria-label="Pagination" class="pull-left page-meta-container"
                 style="display:inline-block;float:left; width:75px;">
                <ul class="pagination justify-content-left mt-3">
                    <li class="page-item disabled page-meta">
                        <a class="page-link" style="background:#ddd;" href="#">P<span class="hiddenOnMobile">age</span><span
                                    class="hiddenOnDesktop">g.</span> @{{ info.meta.current_page }} <span
                                    class="hiddenOnMobile"> of @{{ info.meta.pages}} </span></a>
                    </li>
                </ul>
            </nav>

            <nav aria-label="Pagination" style="display:inline-block;">
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item" v-bind:class="{ disabled: (currentPage == 1) }">
                        <a class="page-link" href="#" v-on:click="updateData(info.meta.current_page - 1)"
                           v-bind:data-url="info.links.prev_page_url" aria-label="Previous" style="background: #ddd !important;">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item hiddenOnMobile" v-on:click="updateData(1)"
                        v-bind:class="{ active: info.meta.current_page == 1 }"><a class="page-link" href="#">1</a></li>
                    <li v-if="info.meta.pages > 1" v-bind:class="{ active: info.meta.current_page == 2 }"
                        class="page-item hiddenOnMobile" v-on:click="updateData(2)"><a class="page-link" href="#">2</a>
                    </li>
                    <li v-if="info.meta.pages > 2" v-bind:class="{ active: info.meta.current_page == 3 }"
                        class="page-item hiddenOnMobile" v-on:click="updateData(3)"><a class="page-link" href="#">3</a>
                    </li>
                    <li v-if="info.meta.pages > 5 && info.meta.current_page <= (info.meta.pages - 3) && info.meta.current_page != 4"
                        class="page-item disabled hiddenOnMobile"><a class="page-link" href="#">...</a></li>
                    <li v-if="info.meta.current_page > 3 && info.meta.current_page <= (info.meta.pages - 3)"
                        class="page-item active hiddenOnMobile"><a class="page-link" href="#">@{{ info.meta.current_page
                            }}</a></li>
                    <li class="page-item active hiddenOnDesktop"><a class="page-link" href="#">@{{
                            info.meta.current_page }}</a></li>
                    <li data-test="4" v-if="info.meta.current_page >= 4 && info.meta.pages > 6"
                        class="page-item disabled hiddenOnMobile"><a class="page-link" href="#">...</a></li>
                    <li data-test="3" v-if="info.meta.pages >= 6 "
                        v-bind:class="{ active: info.meta.current_page == (info.meta.pages - 2) }"
                        class="page-item hiddenOnMobile" v-on:click="updateData(info.meta.pages - 2)"><a
                                class="page-link" href="#">@{{ info.meta.pages - 2}}</a></li>
                    <li data-test="2" v-if="info.meta.pages >= 5 "
                        v-bind:class="{ active: info.meta.current_page == (info.meta.pages - 1) }"
                        class="page-item hiddenOnMobile" v-on:click="updateData(info.meta.pages - 1)"><a
                                class="page-link" href="#">@{{ info.meta.pages - 1}}</a></li>
                    <li data-test="1" v-if="info.meta.pages >= 4 "
                        v-bind:class="{ active: info.meta.current_page == (info.meta.pages) }"
                        v-bind:class="{ disabled: (info.meta.current_page == info.meta.pages) }"
                        class="page-item hiddenOnMobile" v-on:click="updateData(info.meta.pages)"><a class="page-link"
                                                                                                     href="#">@{{
                            info.meta.pages }}</a></li>
                    <li class="page-item" v-bind:class="{ disabled: (info.meta.current_page == info.meta.pages) }">
                        <a class="page-link" href="#" v-on:click="updateData(info.meta.current_page + 1)"
                           aria-label="Next" style="background: #ddd !important;">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <nav aria-label="Pagination" class="right page-meta-container"
                 style="display:inline-block;float:right; width:75px;">
                <ul class="pagination mt-3" style="float:right;">
                    <li class="page-item disabled page-meta">
                        <a class="page-link hiddenOnDesktop"  style="background:#ddd;" href="#">of @{{ info.meta.pages }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    </div>
    @endif
</div>