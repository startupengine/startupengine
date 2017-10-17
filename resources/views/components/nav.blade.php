<header role="banner" style="opacity:1;background:transparent;padding-left:35px;padding-right:35px; height:75px;box-shadow: 0px 0px 60px rgba(0,0,0,0.1);" class="{{ setting('site.site_menu_class') }} ">
    <nav role="navigation" id="primary-nav" class="navbar " style="padding-top:15px !important;margin-top:-10px;width: 100%;height:100px !important;">
        <ul style="float:left;">
            <li  style="float:left;padding:5px !important;position:absolute;top:-2px;left:-16px;">
                <a href="/"  style="color:#000 !important;background:none !important;border:none !important;font-weight: 400;">
                    <?php if(setting('site.logo') !== null) { ?>
                    <img src="{{ Storage::disk('public')->url(setting('site.logo')) }}"  />
                    <?php } ?>
                     <span id="site-title" style="max-height:35px;float:right !important; margin-top:8px !important;margin-left:0px !important;background:#fff ;padding:5px 10px !important;border-radius:4px !important;" class="">{{ setting('site.title') }}</span></a>
            </li>
        </ul>
        <span class="hiddenOnMobile">
            {{ menu('site') }}
        </span>
        <span class="hiddenOnDesktop">
            <ul><li><a href="#" id="mobile-nav-button"  onclick="slideout.open();">Menu</a></li></ul>
        </span>
    </nav>
</header>