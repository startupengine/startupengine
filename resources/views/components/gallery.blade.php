<div class="wrap" style="width:100%;float:left;">
    <h3>{{ $component->getTitle() }}</h3>
    <p>{{ $component->getDescription() }}</p>
    <ul class="flexblock gallery">


        <?php foreach($component->getImages() as $image) { ?>
            <li>
                <a href="">
                    <figure>
                        <?php echo "<img src='http:".$image->getFile()->getUrl()."'/>"; ?>
                        <div class="overlay">
                            <h2>{{ $image->getTitle() }}</h2>
                            <p>{{ $image->getDescription() }}</p>
                        </div>
                    </figure>
                </a>
            </li>

        <?php } ?>
    </ul>
</div>
