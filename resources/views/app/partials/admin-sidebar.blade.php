<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar" id="admin-sidebar"
     style="padding-left:35px;padding-right:10px;height:100%;min-height:100%;">
    <ul class="nav flex-column" style="margin-top:15px;">
        <?php /* ?>
        <li class="nav-item">
            <?php <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app"><i class="now-ui-icons design_bullet-list-67"></i>&nbsp; Dashboard</a>
        </li>
        <?php */ ?>
        <?php /*
        <li>
            <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app/insights"><i class="now-ui-icons business_bulb-63"></i>&nbsp; Insights</a>
        </li>
        */ ?>
        <?php /*
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app/research"><i class="now-ui-icons education_glasses"></i>&nbsp; Research</a>
        </li>
        */ ?>
        <?php /*
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app/sprints"><i class="now-ui-icons sport_user-run"></i>&nbsp; Sprints</a>
        </li>
        */ ?>
        <?php /*
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app/experiments"><i class="now-ui-icons education_atom"></i>&nbsp; Experiments</a>
        </li>
        */ ?>
        @if(\Auth::user()->hasPermissionTo('browse users'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/users"><i class="now-ui-icons users_single-02"></i>&nbsp; Users</a>
            </li>
        @endif
        @if(\Auth::user()->hasPermissionTo('browse pages'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/pages"><i class="now-ui-icons files_paper"></i>&nbsp; Pages</a>
            </li>
        @endif
        @if(\Auth::user()->hasPermissionTo('browse settings'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/design"><i class="now-ui-icons objects_diamond"></i>&nbsp; Design</a>
            </li>
        @endif
        @if(\Auth::user()->hasPermissionTo('browse posts'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/content"><i class="now-ui-icons design_bullet-list-67"></i>&nbsp; Content</a>
            </li>
        @endif
        <?php /*
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app/media"><i class="now-ui-icons design_image"></i>&nbsp; Media</a>
        </li>
        */ ?>
        @if(\Auth::user()->hasPermissionTo('view analytics'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/analytics"><i class="now-ui-icons business_chart-bar-32"></i>&nbsp; Analytics</a>
            </li>
        @endif

        <?php /*
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round"
               style="text-align: left;border-color:#eee !important;"
               href="/app/design"><i class="now-ui-icons shopping_box"></i>&nbsp; Products</a>
        </li>
        */ ?>
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round"
               style="text-align: left;border-color:#eee !important;"
               href="/app/subscriptions"><i class="now-ui-icons shopping_credit-card"></i>&nbsp; Subscriptions</a>
        </li>

        @if(\Auth::user()->hasPermissionTo('browse settings'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/settings"><i class="now-ui-icons ui-1_settings-gear-63"></i>&nbsp; Admin Settings</a>
            </li>
        @endif
        <?php /*
        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round" style="text-align: left;border-color:#eee !important;" href="/app/help"><i class="now-ui-icons business_bulb-63"></i>&nbsp; Help</a>
        </li>
        */ ?>
    </ul>
</nav>