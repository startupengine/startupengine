<div class="ui modal" id="mobileNav">
    <i class="close icon"></i>
    <div class="header" align="center">
        Navigation
    </div>
    <div class="content">
        <ul style="list-style: none !important;">
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin">
                    <p>
                        <svg class="fa-th-large" style="margin: 15px 5px;">
                            <use xlink:href="#fa-th-large"></use>
                        </svg>
                        <span class="hiddenOnTablet">Dashboard</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/pages">
                    <p>
                        <svg class="fa-th-list" style="margin: 15px 5px;">
                        <use xlink:href="#fa-th-list"></use>
                        </svg>
                        <span class="hiddenOnTablet">Pages</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/analytics" >
                    <p>
                        <svg class="fa-bar-chart" style="margin: 15px 5px;">
                            <use xlink:href="#fa-bar-chart"></use>
                        </svg>
                        <span class="hiddenOnTablet">Analytics</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/users" >
                    <p>
                        <svg class="fa-users" style="margin: 15px 5px;">
                            <use xlink:href="#fa-users"></use>
                        </svg>
                        <span class="hiddenOnTablet">Users</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/products" >
                    <p>
                        <svg class="fa-dropbox" style="margin: 15px 5px;">
                            <use xlink:href="#fa-dropbox"></use>
                        </svg>
                        <span class="hiddenOnTablet">Products</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/revenue" >
                    <p>
                        <svg class="fa-usd" style="margin: 15px 5px;">
                            <use xlink:href="#fa-usd"></use>
                        </svg>
                        <span class="hiddenOnTablet">Sales</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/marketing" >
                    <p>
                        <svg class="fa-commenting" style="margin: 15px 5px;">
                            <use xlink:href="#fa-commenting"></use>
                        </svg>
                        <span class="hiddenOnTablet">Marketing</span>
                    </p>
                </a>
            </li>
            <li class="" style="text-align:left;">
                <a rel="external" href="/admin/settings" >
                    <p>
                        <svg class="fa-cogs" style="margin: 15px 5px;">
                            <use xlink:href="#fa-cogs"></use>
                        </svg>
                        <span class="hiddenOnTablet">Settings</span>
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Semantic UI Components-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.js"></script>
<script>
    $( document ).ready(function() {
        $(".showMobileNav").click(function () {
            $('#mobileNav')
                .modal('show');
            console.log('Clicked');
        });
        $(".showLightbox").click(function () {
            var url = $(this).find('img').attr('src');
            console.log(url);
            $('#lightboxImage').css('background-image', 'url(' + url + ')');
            $('#lightbox')
                .modal('show');
            console.log('Clicked');
        });
    });
</script>