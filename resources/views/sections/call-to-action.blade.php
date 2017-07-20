<section class="aligncenter" id="section-{{ $count }}" style="min-height:auto !important;">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap">
        <h2><?php echo $section->getTitle(); ?></h2>
        <p class="text-intro"<?php echo $section->getSubtitle(); ?>></p>
        <?php echo @markdown($section->getContent()); ?>
        <p>
            <a href="<?php echo $section->getButtonUrl(); ?>" class="button ga-track" data-ga-text="<?php echo $section->getButtonText(); ?>" title="<?php echo $section->getButtonText(); ?>">
                <?php echo $section->getButtonText(); ?>
            </a>
        </p>
    </div>
</section>