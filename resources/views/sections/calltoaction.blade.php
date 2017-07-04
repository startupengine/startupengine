<section class="aligncenter" id="section-{{ $count }}" style="min-height:auto !important;">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap">

        <h2><?php echo $section->getHeading(); ?></h2>
        <p class="text-intro"></p>
        <p>
            <a href="<?php echo $section->getButtonLink(); ?>" class="button ga-track" data-ga-text="Download WebSlides (last slide index demos)" title="Download WebSlides">
                <?php echo $section->getButtonText(); ?>
            </a>
        </p>
    </div>
</section>