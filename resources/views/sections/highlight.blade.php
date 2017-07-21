<section class="aligncenter <?php if($section->getStyle() !== NULL) { echo $section->getStyle(); } ?>" id="section-{{ $count }}" style="min-height:auto !important;">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap">
        <div class="grid vertical-align">
            <?php if($section->getAlignment() == "left") { ?>
            <div class="column">
                <figure><img class="aligncenter" src="<?php echo $section->getFeaturedImage()->getFile()->getUrl(); ?>" alt="<?php echo $section->getFeaturedImage()->getTitle(); ?>" style="max-height:50%;max-width:77%;border-radius:4px;"></figure>
            </div>
            <?php } ?>
            <div class="column">
                <?php if($section->getTitle() !== NULL) { ?>
                <h1>
                    <?php echo $section->getTitle(); ?>
                </h1>
                <?php } ?>
                <?php if($section->getSubtitle() !== NULL) { ?>
                <p class="text-intro"><?php echo $section->getSubtitle(); ?></p>
                <?php } ?>
                <div align="left" style="margin-bottom:15px;"><?php echo @markdown($section->getContent()); ?></div>
                <?php if($section->getButtonText() !== NULL) { ?>
                <p>
                    <a href="<?php echo $section->getButtonUrl(); ?>" class="button ga-track" data-ga-text="<?php echo $section->getButtonText(); ?>" title="<?php echo $section->getButtonText(); ?>">
                        <?php echo $section->getButtonText(); ?>
                    </a>
                </p>
                <?php } ?>
            </div>
            <?php if($section->getAlignment() == "right" OR $section->getAlignment() == "center" OR $section->getAlignment() == null) { ?>
            <div class="column">
                <figure><img class="aligncenter" src="<?php echo $section->getFeaturedImage()->getFile()->getUrl(); ?>" alt="<?php echo $section->getFeaturedImage()->getTitle(); ?>" style="max-height:50%;max-width:77%;border-radius:4px;"></figure>
            </div>
            <?php } ?>
        </div>
        <!-- end .grid-->
    </div>
    <!-- .end .wrap -->
</section>