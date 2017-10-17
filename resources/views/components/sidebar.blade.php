<nav id="menu">
    <header>
        <ul style="float:left;position:absolute;top:-18px;left:10px;width:100%;">
            <li  style="float:left;padding:5px !important;position:absolute;top:-2px;left:-16px;">
                <a href="#" style="color:#000 !important;background:none !important;border:none !important;font-weight: 400;">
                    <?php if(setting('site.logo') !== null) { ?>
                    <img src="{{ Storage::disk('public')->url(setting('site.logo')) }}"  style="max-height:50px;" />
                    <?php } ?>
                    <span id="site-title" style="max-height:35px;float:right !important; margin-top:8px !important;margin-left:0px !important;background:#fff ;padding:5px 10px !important;border-radius:4px !important;" class="">{{ setting('site.title') }}</span></a>
            </li>
        </ul>
        <div><a href="#" onclick="slideout.close();" id="menu-close-button">X</a></div>
    </header>
    {{ menu('site') }}
</nav>