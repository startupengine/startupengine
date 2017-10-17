<?php if($defaults !== NULL && $defaults->getComments() == TRUE && $page->getComments() == TRUE) { ?>
<section class="" style="min-height:auto !important;">
    <!--.wrap = container width: 90% -->
    <div class="wrap" align="center" style="padding:0% 10%;">
    @include('laravelLikeComment::like', ['like_item_id' => 'post_'.$page->id])
    </div>
</section>
<?php } ?>