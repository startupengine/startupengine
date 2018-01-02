<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white fixed-top" id="adminNav">
    <div class="container-fluid">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/" rel="tooltip" title="{{ setting('site.description') }}"
               data-placement="bottom">
                <?php if(setting('site.logo') !== null) { ?><img src="{{ setting('site.logo') }}" alt="Logo Icon"
                                                                 style="max-width:40px;">
                    <?php } else { ?>
                    <img src="https://s3.us-east-2.amazonaws.com/startupengine/logos/startup-engine-icon.png" alt="Logo Icon"
                         style="max-width:40px;">
                    <?php } ?>
                <div style="display:inline;">
                    <span>{{ setting('site.name') }}</span>&nbsp;
                    <span class="text400">{{ setting('admin.name') }}</span>
                </div>
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div id="mobile-nav-brand" align="center" style="
    margin-top: 25px;
"><a class="navbar-brand" href="/" style="margin:0px;text-align:center;">
                    <?php if(setting('site.logo') !== null) { ?><img src="{{ setting('site.logo') }}" alt="Logo Icon"
                                                                     style="max-width:40px;"> <?php } ?>{{ setting('site.name') }}</span>
                </a>
            </div>
            <ul class="navbar-nav">
                <?php echo setting('site.menu'); ?>
                <?php if(\Auth::user() !== null && \Auth::user()->role()->name == 'admin'){  ?>
                <li class="nav-item">
                    <a href="/" class="nav-link hiddenOnDesktop"><i class="now-ui-icons arrows-1_share-66"></i> Site</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hiddenOnDesktop" style="text-align: left;border-color:#eee !important;"
                       href="/app/pages"><i class="now-ui-icons files_paper"></i>&nbsp; Pages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link hiddenOnDesktop" style="text-align: left;border-color:#eee !important;"
                       href="/app/content"><i class="now-ui-icons design_bullet-list-67"></i>&nbsp; Content</a>
                </li>
                <li class="nav-item hiddenOnDesktop">
                    <a class="nav-link" style="text-align: left;border-color:#eee !important;"
                       href="/app/design"><i class="now-ui-icons objects_diamond"></i>&nbsp; Design</a>
                </li>

                <li class="nav-item hiddenOnDesktop">
                    <a class="nav-link" style="text-align: left;border-color:#eee !important;"
                       href="/app/packages"><i class="now-ui-icons design_app"></i>&nbsp; Packages</a>
                </li>
                <li class="nav-item hiddenOnDesktop">
                    <a class="nav-link" style="text-align: left;border-color:#eee !important;"
                       href="/app/analytics"><i class="now-ui-icons business_chart-bar-32"></i>&nbsp; Analytics</a>
                </li>
                <li class="nav-item hiddenOnDesktop">
                    <a class="nav-link" style="text-align: left;border-color:#eee !important;"
                       href="/app/users"><i class="now-ui-icons users_single-02"></i>&nbsp; Users</a>
                </li>
                <li class="nav-item hiddenOnDesktop">
                    <a class="nav-link" style="text-align: left;border-color:#eee !important;"
                       href="/app/settings"><i class="now-ui-icons ui-1_settings-gear-63"></i>&nbsp; Settings</a>
                </li>
                <li class="nav-item">
                    <div class="btn-group hiddenOnMobile">
                        <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <i class="now-ui-icons users_circle-08"></i>&nbsp;
                            Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right ">
                            <button class="dropdown-item" type="button" onclick="location.href='/app/profile';"><i
                                        class="now-ui-icons users_circle-08"></i>&nbsp; Profile
                            </button>
                            <button class="dropdown-item" type="button" onclick="location.href='/logout';"><i
                                        class="now-ui-icons ui-1_lock-circle-open"></i>&nbsp; Sign Out
                            </button>
                        </div>
                    </div>
                </li>
                <li class="nav-item hiddenOnDesktop">
                    <a class="nav-link" style="text-align: left;border-color:#eee !important;"
                       href="/logout"><i class="now-ui-icons ui-1_lock-circle-open"></i>&nbsp; Logout</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->