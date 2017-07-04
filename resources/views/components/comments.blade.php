<?php if($defaults !== NULL && $defaults->getEnableDisqus() !== NULL && $article->getComments() == TRUE) { ?>
    <?php echo $defaults->getDisqusCode(); ?>
<?php } ?>