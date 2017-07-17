<div class="ui huge borderless fixed main menu" style="border-radius:0px;">
    <div class="ui container">
        <div class="item hiddenOnDesktop" align="center">
            <a href="/"><img src="/images/sitepress-logo.png" style="max-height:40px;margin-top:3px;"></a>
        </div>
        <div class="left labeled icon menu hiddenOnMobile">
            <div class="item" align="center">
                <a href="/"><img src="/images/sitepress-logo.png" style="max-height:40px;margin-top:3px;"></a>
            </div>
            <a class="item <?php if($active == 'dashboard') { echo "active"; } ?>" href="/admin"><i class="block layout icon"></i><span class="hiddenOnTablet"> Dashboard</span></a>
            <?php /* <a class="item" href="/admin/research"><i class="idea icon"></i><span class="hiddenOnTablet"> Strategy</span></a> */ ?>
            <a class="item <?php if($active == 'content') { echo "active"; } ?>" href="/admin/content"><i class="list icon"></i><span class="hiddenOnTablet"> Content</span></a>
            <?php /* <a class="item <?php if($active == 'schedule') { echo "active"; } ?>" href="/admin/calendar"><i class="calendar icon"></i><span class="hiddenOnTablet"> Calendar</span></a> */ ?>
            <a class="item <?php if($active == 'analytics') { echo "active"; } ?>" href="/admin/analytics"><i class="bar chart icon"></i><span class="hiddenOnTablet"> Analytics</span></a>
            <?php /*<a class="item" href="/admin/sales"><i class="dollar icon"></i><span class="hiddenOnTablet"> Sales</span></a> */ ?>
            <a class="item" href="/admin/users"><i class="user outline icon"></i><span class="hiddenOnTablet"> Users</span></a>
            <a class="item" href="/admin/integrations"><i class="server icon"></i><span class="hiddenOnTablet"> Apps</span></a>
        </div>
        <div class="right menu hiddenOnMobile" >
            <div class="ui simple dropdown item">
                <div style="position: relative; text-align: right; width:100%; ">
                    <div><i class="bars icon"></i></div>
                </div>
                <div class="menu">
                    <div class="">
                        <a class="item ui" href="/admin/notifications" style="border-bottom:1px solid #ddd;"><span class="ui label yellow"><i class="announcement icon"></i> 23 <div class="detail">Notifications</div></span></a>
                        <a class="item" href="/admin/account"><i class="user circle outline icon"></i> Your Account</a>
                        <a class="item" href="/logout"><i class="sign out icon"></i> Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="right menu hiddenOnDesktop " >
            <div class="ui simple dropdown item">
                <div style="position: relative; text-align: right; width:100%; ">
                    <div><i class="bars icon"></i></div>
                </div>
                <div class="menu">
                    <div class="">
                        <a class="item ui" href="/admin/notifications" style="border-bottom:1px solid #ddd;"><span class="ui label yellow"><i class="announcement icon"></i> 23 <div class="detail">Notifications</div></span></a>
                        <a class="item" href="/admin"><i class="block layout icon"></i> Dashboard</a>
                        <?php /* <a class="item" href="/admin/research"><i class="idea icon"></i><span class="hiddenOnTablet"> Strategy</span></a> */ ?>
                        <a class="item" href="/admin/content"><i class="list icon"></i> Content</a>
                        <?php /* <a class="item" href="/admin/calendar"><i class="calendar icon"></i> Calendar</a> */?>
                        <a class="item" href="/admin/analytics"><i class="bar chart icon"></i> Analytics</a>
                        <?php /*<a class="item" href="/admin/sales"><i class="dollar icon"></i><span class="hiddenOnTablet"> Sales</span></a> */ ?>
                        <a class="item" href="/admin/users"><i class="user outline icon"></i> Users</a>
                        <a class="item" href="/admin/integrations"><i class="server icon"></i>Apps</a>
                        <a class="item" href="/admin/account"  style="border-top:1px solid #ddd;"><i class="user circle outline icon"></i> Your Account</a>
                        <a class="item" href="/logout"><i class="sign out icon"></i> Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>