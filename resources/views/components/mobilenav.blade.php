<div class="ui modal" id="mobileNav">
    <i class="close icon"></i>
    <div class="header" align="center">
        Navigation
    </div>
    <div class="content">
        <ul style="list-style: none !important;">
            <?php if($defaults !== NULL && $defaults->getFacebook() !== NULL) { ?>
            <?php foreach($defaults->getHeaderMenu()->getItems() as $item) { ?>
            <li><?php echo @markdown($item->getContent()); ?></li>
            <?php } ?>
            <?php } ?>
            <?php if($defaults !== NULL && $defaults->getFacebook() !== NULL) { ?>
            <li class="facebook">
                <a rel="external" href="<?php echo $defaults->getFacebook(); ?>" target="_blank" title="Facebook">
                    <svg class="fa-facebook" viewBox="0 0 512 512">
                        <path d="m384 3l0 76-45 0c-17 0-28 3-33 10-6 7-9 17-9 31l0 54 84 0-11 85-73 0 0 216-87 0 0-216-73 0 0-85 73 0 0-62c0-36 10-63 29-83 20-19 47-29 80-29 28 0 49 1 65 3z"></path>
                    </svg>
                    Facebook
                </a>
            </li>
            <?php } ?>
            <?php if($defaults !== NULL && $defaults->getTwitter() !== NULL) { ?>
            <li class="twitter">
                <a rel="external" href="<?php echo $defaults->getTwitter(); ?>" target="_blank"title="Twitter">
                    <svg class="fa-twitter" viewBox="0 0 512 512">
                        <path d="m481 117c-13 18-28 34-46 47 0 3 0 7 0 12 0 25-3 50-11 74-7 25-18 49-33 71-14 23-32 43-52 61-21 17-45 31-74 41-29 11-60 16-92 16-52 0-99-14-142-42 7 1 14 2 22 2 43 0 81-14 115-40-20 0-38-6-54-18-16-12-27-27-33-46 7 1 13 2 18 2 8 0 16-1 24-4-21-4-39-15-53-31-14-17-21-37-21-59l0-1c13 7 27 11 42 11-13-8-23-19-30-32-8-14-11-29-11-44 0-17 4-33 12-47 23 28 51 51 84 68 33 17 69 27 107 29-2-8-3-15-3-22 0-25 9-47 27-65 18-18 40-27 66-27 26 0 49 10 67 29 21-4 40-11 59-22-7 22-21 39-41 51 18-2 35-7 53-14z"></path>
                    </svg>
                    Twitter
                </a>
            </li>
            <? } ?>
            <?php if($defaults !== NULL && $defaults->getGithub() !== NULL) { ?>
            <li class="">
                <a rel="external" href="<?php echo $defaults->getGithub(); ?>" target="_blank" title="Twitter">
                    <svg class="fa-github">
                        <use xlink:href="#fa-github"></use>
                    </svg>
                    Github
                </a>
            </li>
            <? } ?>
        </ul>
    </div>
</div>