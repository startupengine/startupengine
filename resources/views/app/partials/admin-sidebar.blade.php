<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar"
     id="admin-sidebar"
     style="padding-left:35px;padding-right:10px;height:100%;min-height:100%;">

    <ul class="nav flex-column" style="margin-top:15px;">

        <li class="nav-item">

            <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app') OR \Request::is('app/dashboard')) active @endif"
               style="text-align: left;border-color:#eee !important;" href="/app/dashboard"><i class="fa fa-th"></i>&nbsp; Dashboard</a>
        </li>

        @if(\Auth::user()->hasPermissionTo('browse settings'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/ads*')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/ads"><i class="now-ui-icons shopping_tag-content"></i>&nbsp; Ads</a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('browse users'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/user*')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/users"><i class="now-ui-icons users_single-02"></i>&nbsp; Users</a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('browse pages'))
            <li class="nav-item active">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/page*')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/pages"><i class="now-ui-icons files_paper"></i>&nbsp; Pages</a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('browse settings'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/brand')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/design"><i class="now-ui-icons objects_diamond"></i>&nbsp; Brand</a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('browse posts'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/content')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/content"><i class="now-ui-icons design_bullet-list-67"></i>&nbsp; Content</a>
            </li>
        @endif

        @if(\Auth::user()->hasPermissionTo('view analytics'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/analytics')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/analytics"><i class="now-ui-icons business_chart-bar-32"></i>&nbsp; Analytics</a>
            </li>
        @endif

        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/products')) active @endif"
               style="text-align: left;border-color:#eee !important;"
               href="/app/products"><i class="now-ui-icons shopping_box"></i>&nbsp; Products</a>
        </li>

        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/subscriptions')) active @endif"
               style="text-align: left;border-color:#eee !important;"
               href="/app/subscriptions"><i class="now-ui-icons shopping_credit-card"></i>&nbsp; Purchases</a>
        </li>

        <li class="nav-item">
            <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/social')) active @endif"
               style="text-align: left;border-color:#eee !important;"
               href="/app/social"><i class="now-ui-icons ui-2_like"></i>&nbsp; Social Media</a>
        </li>

        @if(\Auth::user()->hasPermissionTo('browse settings'))
            <li class="nav-item">
                <a class="btn btn-secondary-outline btn-block btn-round @if (\Request::is('app/settings')) active @endif"
                   style="text-align: left;border-color:#eee !important;"
                   href="/app/settings"><i class="now-ui-icons ui-1_settings-gear-63"></i>&nbsp; Admin Panel</a>
            </li>
        @endif

    </ul>

</nav>