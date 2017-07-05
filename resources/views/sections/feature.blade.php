<section class="aligncenter" id="section-{{ $count }}" style="min-height:auto !important;">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap">
        <div class="grid vertical-align">
            <div class="column">
                <figure><img class="aligncenter" src="<?php echo $section->getImage()->getFile()->getUrl(); ?>" alt="<?php echo $section->getImage()->getTitle(); ?>"></figure>
            </div>
            <div class="column">
                <h1>
                    <?php echo $section->getHeading(); ?>
                </h1>
                <p class="text-intro"><?php echo $section->getSubHeading(); ?></p>
                <p><?php echo $section->getContent(); ?></p>
                <p>
                    <a href="<?php echo $section->getButtonLink(); ?>" class="button ga-track" data-ga-text="<?php echo $section->getButtonText(); ?>" title="<?php echo $section->getButtonText(); ?>">
                        <?php echo $section->getButtonText(); ?>
                    </a>
                </p>
            </div>
        </div>
        <!-- end .grid-->
    </div>
    <!-- .end .wrap -->
</section>