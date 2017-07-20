<?php if($defaults !== NULL && $defaults->getFooterMenu() !== NULL) { ?>
<footer role="contentinfo">
    <div class="wrap">
        <div class="grid">
            <?php foreach($defaults->getFooterMenu()->getItems() as $item) { ?>
                <div class="column">
                    <ul>
                        <li><?php echo @markdown($item->getContent()); ?></li>
                    </ul>
                </div>
            <?php } ?>
            <!-- .end .column -->
        </div>
        <!-- .end .grid -->
    </div>
    <!-- .end .wrap -->
</footer>
<? } ?>