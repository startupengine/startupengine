<?php if($defaults !== NULL && $defaults->getComments() == TRUE && $article->getComments() == TRUE) { ?>
<section class="" style="min-height:auto !important;">
    <!--.wrap = container width: 90% -->
    <div class="wrap" align="center" style="padding:0% 10%;">
        <?php echo $defaults->getCommentsCode(); ?>
    </div>
</section>
<?php } ?>