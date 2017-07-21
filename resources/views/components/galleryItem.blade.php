<?php if($item->getFeaturedImage() !== NULL) { ?>
    <li style="float:left; max-width:50%;background:#fff;">
        <a href="/{{ $item->getSlug() }}">
            <figure>
                <?php echo "<img src='".$item->getFeaturedImage()->getFile()->getUrl()."'/>"; ?>
                <figcaption>
                    <h2>{{ $item->getTitle() }}</h2>
                    <p>{{  $item->getDescription() }}</p>
                </figcaption>
            </figure>
        </a>
    </li>
<?php } ?>