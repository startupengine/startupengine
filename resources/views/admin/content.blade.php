@extends('layouts.app-semanticui')
@section('content')
    <script>
        function replaceUrlParam(url, paramName, paramValue){
            var pattern = new RegExp('(\\?|\\&)('+paramName+'=).*?(&|$)')
            var newUrl=url
            if(url.search(pattern)>=0){
                newUrl = url.replace(pattern,'$1$2' + paramValue + '$3');
            }
            else{
                newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue
            }
            return newUrl
        }
        $( document ).ready(function() {
            $('#contentType').change(function(){
                var value = $(this).val();
                window.location = "/admin/content/?page=" + value;
            });
            $('#periodSelector').change(function(){
                var value = $(this).val();
                console.log(window.location.href);
                var newurl = replaceUrlParam(window.location.href, 'period', value);
                window.location = newurl;
            });
        });
    </script>
    <div class="ui grid sixteen wide">
        <div class="sixteen wide column" align="center">

                <p class="header" style="margin-bottom:35px;padding-bottom:0px;">Popular content for the last
                    <select class="ui inline dropdown" style="margin:0px 10px 0px 10px;" id="periodSelector">
                        <option value="30">30</option>
                        <option value="60">60</option>
                        <option value="90">90</option>
                        <option value="365">365</option>
                    </select>
                    days</p>
                <div class="ui buttons fluid" align="center">
                    <a href="/admin/content?page=all" class="ui button default <?php if($page !== NULL) { echo "active"; }?>" style="border-right:#ccc 1px solid;" >Pages</a>
                    <a href="/admin/content?topic=all" class="ui button default <?php if($topic !== NULL) { echo "active"; }?>" style="border-right:#ccc 1px solid;" >Topics</a>
                    <a href="/admin/content?campaign=all" class="ui button default <?php if($campaign !== NULL) { echo "active"; }?>" style="border-right:#ccc 1px solid;" >Campaigns</a>
                </div>


            <div class="ui top attached tabular menu hiddenOnMobile" align="center">
                    <a href="/admin/content?<?php if(isset($page)) { echo "page"; } if(isset($topic)) { echo "topic"; } if(isset($campaign)) { echo "campaign"; } ?>=all" class="item <?php if($page == 'all') { echo "active"; }?> "  >All Content</a>
                    <a href="/admin/content?<?php if(isset($page)) { echo "page"; } if(isset($topic)) { echo "topic"; } if(isset($campaign)) { echo "campaign"; } ?>=landings" class="item <?php if($page == 'landings') { echo "active"; }?> "  >Landing Pages</a>
                    <a href="/admin/content?<?php if(isset($page)) { echo "page"; } if(isset($topic)) { echo "topic"; } if(isset($campaign)) { echo "campaign"; } ?>=articles" class="item <?php if($page == 'articles') { echo "active"; }?> ">Articles</a>
                    <a href="/admin/content?<?php if(isset($page)) { echo "page"; } if(isset($topic)) { echo "topic"; } if(isset($campaign)) { echo "campaign"; } ?>=products" class="item <?php if($page == 'products') { echo "active"; }?> ">Products</a>
                    <a href="/admin/content?<?php if(isset($page)) { echo "page"; } if(isset($topic)) { echo "topic"; } if(isset($campaign)) { echo "campaign"; } ?>=services" class="item <?php if($page == 'services') { echo "active"; }?> ">Services</a>
                    <a href="/admin/content?<?php if(isset($page)) { echo "page"; } if(isset($topic)) { echo "topic"; } if(isset($campaign)) { echo "campaign"; } ?>=subscriptions" class="item <?php if($page == 'subscriptions') { echo "active"; }?> ">Subscriptions</a>
            </div>
            <div class="ui top attached segment hiddenOnDesktop hiddenOnTablet">
                <select class="ui dropdown " style="margin:10px;" id="contentType">
                    <option class="" value="all" <?php if($page == 'all') { echo "selected"; }?>>All Content</option>
                    <option class="" value="landings" <?php if($page == 'landings') { echo "selected"; }?>>Landing Pages</option>
                    <option class="" value="articles" <?php if($page == 'articles') { echo "selected"; }?>>Articles</option>
                    <option class="" value="products" <?php if($page == 'products') { echo "selected"; }?>>Products</option>
                    <option class="" value="services" <?php if($page == 'services') { echo "selected"; }?>>Services</option>
                    <option class="" value="subscriptions" <?php if($page == 'subscriptions') { echo "selected"; }?>>Subscriptions</option>
                </select>
            </div>
            <div class="ui bottom attached active tab segment">
                <?php if($popular->totalsForAllResults['ga:pageviews'] > 0) { ?>
                <table class="ui table">
                    <thead class="hiddenOnMobile">
                    <tr>
                        <th>Page</th>
                        <th >Views</th>
                        <th >Minutes On Page</th>
                        <th >Entrances</th>
                        <th >Exits</th>
                        <th >Bounces</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($popular->rows as $post) { ?>
                    <tr>
                        <td><a href="<?php echo $post[0]; //ga:pagePath?>" target="_blank"><?php echo $post[1]; //ga:pageTitle ?></a></td>
                        <td ><?php echo $post[2]; //ga:pageViews ?><span class="hiddenOnDesktop hiddenOnTablet"> Views</span></td>
                        <td ><?php echo round($post[4]/60); //ga:timeOnPage ?><span class="hiddenOnDesktop hiddenOnTablet"> Minutes On Page</span></td>
                        <td ><?php echo $post[6]; //ga:entrances ?><span class="hiddenOnDesktop hiddenOnTablet"> Entrances</span></td>
                        <td ><?php echo $post[7]; //ga:exits ?><span class="hiddenOnDesktop hiddenOnTablet"> Exits</span></td>
                        <td ><?php echo $post[5]; //ga:bounces ?><span class="hiddenOnDesktop hiddenOnTablet"> Bounces</span></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <p>No results.</p>
                <?php } ?>
            </div>



        </div>
    </div>
@endsection