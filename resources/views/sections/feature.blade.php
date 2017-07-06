<section class="aligncenter <?php if($section->getBackgroundClass() !== NULL) { echo $section->getBackgroundClass(); } ?>" id="section-{{ $count }}" style="min-height:auto !important;">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap">
        <div class="grid vertical-align">
            <?php if($section->getImagePosition() == NULL OR $section->getImagePosition() == "left") { ?>
            <div class="column">
                <figure><img class="aligncenter" src="<?php echo $section->getImage()->getFile()->getUrl(); ?>" alt="<?php echo $section->getImage()->getTitle(); ?>"></figure>
            </div>
            <?php } ?>
            <div class="column">
                <?php if($section->getHeading() !== NULL) { ?>
                <h1>
                    <?php echo $section->getHeading(); ?>
                </h1>
                <?php } ?>
                <?php if($section->getSubHeading() !== NULL) { ?>
                <p class="text-intro"><?php echo $section->getSubHeading(); ?></p>
                <?php } ?>
                <div align="left" style="margin-bottom:15px;"><?php echo @markdown($section->getContent()); ?></div>
                <?php if($section->getButtonText() !== NULL) { ?>
                <p>
                    <a href="<?php echo $section->getButtonLink(); ?>" class="button ga-track" data-ga-text="<?php echo $section->getButtonText(); ?>" title="<?php echo $section->getButtonText(); ?>">
                        <?php echo $section->getButtonText(); ?>
                        <?php if($section->getButtonIcon() !== NULL) { ?>
                            <svg class="<?php echo $section->getButtonIcon(); ?>">
                                <use xlink:href="#<?php echo $section->getButtonIcon(); ?>"></use>
                            </svg>
                        <?php } ?>
                    </a>
                </p>
                <?php } ?>
            </div>
            <?php if($section->getImagePosition() == "right") { ?>
            <div class="column">
                <figure><img class="aligncenter" src="<?php echo $section->getImage()->getFile()->getUrl(); ?>" alt="<?php echo $section->getImage()->getTitle(); ?>"></figure>
            </div>
            <?php } ?>
        </div>
        <!-- end .grid-->
    </div>
    <!-- .end .wrap -->
</section>