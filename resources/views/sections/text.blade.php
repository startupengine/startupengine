<section class="bg-white" id="section-{{ $count }}" style="min-height:auto !important;">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap longform">
        <?php echo @markdown($section->getContent()); ?>
        <?php  if($section->getFeaturedImage() !== NULL) { ?>
            <figure class="text-pull">
                <img src="<?php echo $section->getFeaturedImage()->getFile()->getUrl(); ?>" alt="Image" style="border-radius:4px;">
                <figcaption>
                    <p><?php echo $section->getFeaturedImage()->getTitle(); ?></p>
                </figcaption>
            </figure>
        <?php }  ?>
    </div>
</section>