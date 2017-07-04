<?php if($defaults !== NULL && $defaults->getEnableDisqus() !== NULL && $article->getComments() == TRUE) { ?>
<section class="<?php echo $splash; ?>">
    <!--.wrap = container width: 90% -->
    <div class="wrap" align="center" style="padding:0% 10%;">
        <?php echo $defaults->getDisqusCode(); ?>
    </div>
</section>
<?php } ?>