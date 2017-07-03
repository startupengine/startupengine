<section class="bg-white" id="section-{{ $count }}">
    <!--.wrap.longform (width:72rem=720px) = Better reading experience (90-95 characters per line) -->
    <div class="wrap longform">
        <?php echo @markdown($section->getContent()); ?>
        @foreach($section->getComponents() as $component)
            <?php $type = $component->getContentType()->getName();?>  @include('components.'.strtolower($type))
        @endforeach
    </div>
</section>