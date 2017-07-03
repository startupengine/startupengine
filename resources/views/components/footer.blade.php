<?php if(isset($defaults) && $defaults !== NULL) { ?>
<footer role="contentinfo">
    <div class="wrap">
        <div class="grid">
            <?php foreach($defaults->getMenu()->getMenuGroups() as $menuGroup) { ?>
            <div class="column">
                <h3><?php echo $menuGroup->getTitle(); ?></h3>
                <ul>
                    <?php foreach($menuGroup->getItems() as $item) { ?>
                    <li><a href="#"><?php echo @markdown($item->getContent()); ?></a></li>
                    <?php } ?>
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

<!-- OPTIONAL - svg-icons.js (fontastic.me - Font Awesome as svg icons) -->
<script defer src="/js/svg-icons.js"></script>
