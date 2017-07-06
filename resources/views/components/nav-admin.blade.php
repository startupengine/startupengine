<header role="banner" style="opacity:1;background:transparent;padding-left:35px;padding-right:35px;" class="<?php if($defaults !== NULL && $defaults->getNavStyle() !== NULL) { echo strtolower($defaults->getNavStyle()); } ?>">
    <nav role="navigation" class="navbar hiddenOnMobile" style="width: 100%;">
        <ul style="text-align:left;justify-content: flex-start;">
            <li class="" style="text-align:left;">
                <a rel="external" href="/">
                    <p>
                        <svg class="fa-home" style="margin: 15px 5px;">
                            <use xlink:href="#fa-home"></use>
                        </svg>
                        Home
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/app/admin/marketing" >
                    <p>
                        <svg class="fa-tasks" style="margin: 15px 5px;">
                            <use xlink:href="#fa-tasks"></use>
                        </svg>
                        Marketing
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/app/admin/analytics" >
                    <p>
                        <svg class="fa-line-chart" style="margin: 15px 5px;">
                            <use xlink:href="#fa-line-chart"></use>
                        </svg>
                        Analytics
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/app/admin/settings" >
                    <p>
                        <svg class="fa-cog" style="margin: 15px 5px;">
                            <use xlink:href="#fa-cog"></use>
                        </svg>
                        Settings
                    </p>
                </a>
            </li>
            <li>
                <a rel="external" href="/app/admin/help" >
                    <p>
                        <svg class="fa-question-circle" style="margin: 15px 5px;">
                            <use xlink:href="#fa-question-circle"></use>
                        </svg>
                        Help
                    </p>
                </a>
            </li>
            <li class="" style="">
                <a rel="external" href="/signout" >
                    <p>
                        Sign Out
                        <svg class="fa-sign-out" style="margin: 15px 5px;">
                            <use xlink:href="#fa-sign-out"></use>
                        </svg>
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <nav role="navigation" class="hiddenOnDesktop" style="width:100%;">
        <ul class="hiddenOnDesktop" style="margin-right:11px;">
            <li class="showMobileNav menuButton">
                <a href="#" style="font-size:150%;">
                    <svg class="fa-bars" style="margin: 15px 5px;">
                        <use xlink:href="#fa-bars"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</header>