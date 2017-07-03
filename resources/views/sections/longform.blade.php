<section class="bg-white" id="section-{{ $count }}">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap longform">
        <?php echo @markdown($section->getContent()); ?>
            <?php if($section->getImage()->getFile()->getUrl() !== NULL) { ?>
            <figure class="text-pull" >
                <img src="<?php echo $section->getImage()->getFile()->getUrl(); ?>" style="border-radius:4px;">
                <figcaption>
                    <p><?php echo $section->getImage()->getTitle(); ?></p>
                </figcaption>
            </figure>
            <?php } ?>
        @foreach($section->getComponents() as $component)
            <?php $type = $component->getContentType()->getName();?>  @include('components.'.strtolower($type))
        @endforeach
    </div>
</section>