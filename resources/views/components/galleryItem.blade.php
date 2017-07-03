<li style="float:left; max-width:50%;background:#fff;">
    <a href="/article/{{ $item->getSlug() }}">
        <figure>
            <?php echo "<img src='".$item->getFeaturedImage()."'/>"; ?>
            <figcaption>
                <h2>{{ $item->getTitle() }}</h2>
                <p><?php echo @markdown($item->getSubtitle()); ?></p>
            </figcaption>
        </figure>
    </a>
</li>
