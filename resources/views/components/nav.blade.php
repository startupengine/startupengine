<?php if($defaults !== NULL && $defaults->getHeaderMenu() !== NULL) { ?>
<header role="banner" style="opacity:1;background:transparent;padding-left:35px;padding-right:35px;" class="<?php if($defaults !== NULL && $defaults->getHeaderMenu()->getStyle() !== NULL) { echo strtolower($defaults->getHeaderMenu()->getStyle()); } ?>">
    <nav role="navigation" class="navbar hiddenOnMobile" style="width: 100%;">
        <ul>
            <?php if($defaults !== NULL) { ?>
                <?php if($defaults->getHeaderMenu()->getLogo() !== null) { ?>
                    <li style="max-width:100px;"><a href="/" style="padding:4px;"><img src="<?php echo $defaults->getHeaderMenu()->getLogo()->getFile()->getUrl(); ?>" style="max-height:50px;"/></a></li>
                <?php } ?>
                <?php foreach($defaults->getHeaderMenu()->getItems() as $item) { ?>
                    <li><?php echo @markdown($item->getContent()); ?></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </nav>
    <nav role="navigation" class="hiddenOnDesktop" style="width:100%;">
        <ul class="hiddenOnDesktop" style="margin-right:11px;">
            <li class="showMobileNav menuButton">
                <a style="font-size:133%;padding:1px 0px 2px 2px;">
                    <i class="sidebar icon"></i>
                </a>
            </li>
        </ul>
    </nav>
</header>
<?php } ?>
<div class="ui modal" id="mobileNav">
    <i class="close icon"></i>
    <div class="header" align="center">
        Navigation
    </div>
    <div class="content">
        <ul style="list-style: none !important;">
            <li><a href="/">Home</a></li>
            <?php if($defaults !== NULL && $defaults->getHeaderMenu()->getItems() !== NULL) { ?>
            <?php foreach($defaults->getHeaderMenu()->getItems() as $item) { ?>
            <li><?php echo @markdown($item->getContent()); ?></li>
            <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
