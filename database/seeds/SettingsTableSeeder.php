<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Site Title',
                'value' => 'Startup Engine',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Site Description',
                'value' => 'A CMS designed for startups.',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'site.logo',
                'display_name' => 'Site Logo',
                'value' => 'settings/October2017/logo.png',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'Google Analytics Tracking ID',
                'value' => 'UA-44021606-2',
                'details' => '',
                'type' => 'text',
                'order' => 6,
                'group' => 'Site',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'admin.bg_image',
                'display_name' => 'Admin Background Image',
                'value' => 'settings/October2017/luca-bravo-207676.jpg',
                'details' => '',
                'type' => 'image',
                'order' => 5,
                'group' => 'Admin',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'admin.title',
                'display_name' => 'Admin Title',
                'value' => 'Admin Panel',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'admin.description',
                'display_name' => 'Admin Description',
                'value' => 'A CMS designed for startups.',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Admin',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'admin.loader',
                'display_name' => 'Admin Loader',
                'value' => 'settings/October2017/logo2.png',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'admin.icon_image',
                'display_name' => 'Admin Icon Image',
                'value' => 'settings/October2017/logo1.png',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'admin.google_analytics_client_id',
            'display_name' => 'Google Analytics Client ID (used for admin dashboard)',
                'value' => '541075191896-uu43j0q9785g4flqqv2d6psd40nujnpb.apps.googleusercontent.com',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'site.global_css',
                'display_name' => 'Global CSS',
                'value' => '<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<!-- CSS Files -->
<link href="/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
<style>
.h1-seo {
font-weight:400 !important;
}
.card {
border-radius:5px !important;
}
.card h4 {
margin-top:10px !important;
text-align:center;
}
@media screen and (max-width: 991px) {
.sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
border: 1px solid rgba(255,255,255,0.1);
}
.sidebar-collapse .navbar .navbar-nav {
margin-top: 15px !important;
}
}
h4.title, h1.title {
font-weight:400;
}

h1, h4 {
text-shadow: 0px 3px 7px rgba(0,0,0,0.3) !important;
}

.sidebar-collapse .navbar-collapse:before {
background: #ff2e0c;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #ff2e0c, #ffb733);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #ff2e0c, #ffb733); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

.page-header[filter-color="orange"] {
background: rgba(44, 44, 44, 0.0);
background: -webkit-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
background: -o-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
background: -moz-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
background: linear-gradient(0deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
}
#disqus_thread {
padding:15px;
}
</style>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 9,
                'group' => 'Site',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'site.global_scripts',
                'display_name' => 'Global Scripts',
                'value' => '<script>
</script>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 10,
                'group' => 'Site',
            ),
            12 => 
            array (
                'id' => 14,
                'key' => 'site.footer_html',
                'display_name' => 'Footer HTML',
                'value' => '<div class="column">
<ul>
<li><strong>Navigation</strong></li>
<li><a href="/home">Home</a></li>
<li><a href="/articles">Blog</a></li>
<li><a href="/signin">Sign In</a></li>
</ul>
</div>
<div class="column">
<ul>
<li><strong>About This Site</strong></li>
<li><a href="mailto:example@example.com">Contact Support</a></li>
<li><a href="https://github.com/luckyrabbitllc/startupengine">View the code on GitHub</a></li>
<li><a href="https://dashboard.heroku.com/new?button-url=https%3A%2F%2Fgithub.com%2Fluckyrabbitllc%2Fstartupengine&template=https%3A%2F%2Fgithub.com%2Fluckyrabbitllc%2FStartupEngine">Deploy to Heroku</a></li>
</ul>
</div>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 12,
                'group' => 'Site',
            ),
            13 => 
            array (
                'id' => 15,
                'key' => 'site.comments_code',
                'display_name' => 'Comments Code',
                'value' => '<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page\'s canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable
};
*/
(function() { // DON\'T EDIT BELOW THIS LINE
var d = document, s = d.createElement(\'script\');
s.src = \'https://startupengine-1.disqus.com/embed.js\';
s.setAttribute(\'data-timestamp\', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 13,
                'group' => 'Site',
            ),
            14 => 
            array (
                'id' => 16,
                'key' => 'site.twitter_account',
                'display_name' => 'Twitter Account',
                'value' => '@StartupEngine',
                'details' => NULL,
                'type' => 'text',
                'order' => 14,
                'group' => 'Site',
            ),
            15 => 
            array (
                'id' => 17,
                'key' => 'site.primary_color',
                'display_name' => 'Primary Color',
                'value' => '#4444ff',
                'details' => NULL,
                'type' => 'text',
                'order' => 21,
                'group' => 'Site',
            ),
            16 => 
            array (
                'id' => 18,
                'key' => 'site.secondary_color',
                'display_name' => 'Secondary Color',
                'value' => '#7777ff',
                'details' => NULL,
                'type' => 'text',
                'order' => 24,
                'group' => 'Site',
            ),
            17 => 
            array (
                'id' => 20,
                'key' => 'site.enable_comments',
                'display_name' => 'Enable Comments',
                'value' => '1',
                'details' => NULL,
                'type' => 'checkbox',
                'order' => 26,
                'group' => 'Site',
            ),
            18 => 
            array (
                'id' => 21,
                'key' => 'forum.forum_logo',
                'display_name' => 'Forum Logo',
                'value' => '',
                'details' => NULL,
                'type' => 'image',
                'order' => 15,
                'group' => 'Forum',
            ),
            19 => 
            array (
                'id' => 22,
                'key' => 'forum.welcome_message',
                'display_name' => 'Forum Welcome Message',
                'value' => 'Discussions',
                'details' => NULL,
                'type' => 'text',
                'order' => 16,
                'group' => 'Forum',
            ),
            20 => 
            array (
                'id' => 23,
                'key' => 'forum.description',
                'display_name' => 'Forum Description',
                'value' => 'A place for feedback and support',
                'details' => NULL,
                'type' => 'text',
                'order' => 17,
                'group' => 'Forum',
            ),
            21 => 
            array (
                'id' => 24,
                'key' => 'forum.header-background',
                'display_name' => 'Forum Header Background',
                'value' => '[{"download_link":"settings\\/October2017\\/1QuqaoWqotQL8J8ou1XJ.jpeg","original_name":"photo-1503454175556-2d47ed6f1f7a.jpeg"}]',
                'details' => NULL,
                'type' => 'file',
                'order' => 18,
                'group' => 'Forum',
            ),
            22 => 
            array (
                'id' => 25,
                'key' => 'authentication.enable_auth0',
                'display_name' => 'Enable Auth0',
                'value' => '0',
                'details' => NULL,
                'type' => 'checkbox',
                'order' => 19,
                'group' => 'Authentication',
            ),
            23 => 
            array (
                'id' => 26,
                'key' => 'authentication.auth0_lock_code',
                'display_name' => 'auth0_lock_code',
                'value' => '',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 20,
                'group' => 'Authentication',
            ),
            24 => 
            array (
                'id' => 27,
                'key' => 'site.menu_html',
                'display_name' => 'Menu HTML',
                'value' => '<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-info fixed-top navbar-transparent " color-on-scroll="100">
<div class="container">
<div class="navbar-translate">
<a class="navbar-brand" href="/" rel="tooltip" title="A CMS designed for startups." data-placement="bottom">
<img src="https://psychoanalytics.s3-us-west-1.amazonaws.com/settings/October2017/logo1.png" alt="Logo Icon" style="max-width:40px;"> Startup Engine
</a>
<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-bar bar1"></span>
<span class="navbar-toggler-bar bar2"></span>
<span class="navbar-toggler-bar bar3"></span>
</button>
</div>
<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="/img/blurred-image-1.jpg">
<ul class="navbar-nav">
<li class="nav-item hidden-sm-up">
<a class="nav-link" href="/">
<p>Home</p>
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/features">
<p>Features</p>
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/articles">
<p>Articles</p>
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="/help">
<p>Help & Documentation</p>
</a>
</li>
<li class="nav-item">
<a class="nav-link btn btn-neutral" href="/get-started" style="color:#0f76ff;box-shadow: 0px 10px 30px rgba(0,0,0,0.1);">
<i class="now-ui-icons arrows-1_share-66"></i>
<p>Get Started</p>
</a>
</li>
</ul>
</div>
</div>
</nav>
<!-- End Navbar -->',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 11,
                'group' => 'Site',
            ),
            25 => 
            array (
                'id' => 28,
                'key' => 'analytics.psychoanalytics_key',
                'display_name' => 'PsychoAnalytics Key',
                'value' => '',
                'details' => NULL,
                'type' => 'text',
                'order' => 22,
                'group' => 'Analytics',
            ),
            26 => 
            array (
                'id' => 29,
                'key' => 'analytics.custom_dashboard_html',
                'display_name' => 'Custom Dashboard HTML',
                'value' => '',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 23,
                'group' => 'Analytics',
            ),
            27 => 
            array (
                'id' => 30,
                'key' => 'site.global_header',
                'display_name' => 'Global Header',
                'value' => '<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content=\'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no\' name=\'viewport\' />
<script src="/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/vue"></script>
<!--   Core JS Files   -->
<script src="/js/core/popper.min.js" type="text/javascript"></script>
<script src="/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 7,
                'group' => 'Site',
            ),
            28 => 
            array (
                'id' => 31,
                'key' => 'help.header_html',
                'display_name' => 'Header HTML',
                'value' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header page-header-small clear-filter" filter-color="black">
<div class="page-header-image" data-parallax="true" style="background-color:#3a92f1;">
</div>
<div class="container">
<div class="content-center" style="top:200px !important;">
<h1 class="title text-center">How can we help?</h1>
<div class="form-group" style="padding:0px 15%;">
<form method="get" enctype="multipart/form-data" action="/search">
<input type="text" id="s" name="s" class="form-control" placeholder="Search for..." aria-label="Search for...">                     
</form>
</div>
</div>
</div>
</div>
</div>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 25,
                'group' => 'Help',
            ),
            29 => 
            array (
                'id' => 32,
                'key' => 'site.favicon',
                'display_name' => 'Favicon',
                'value' => 'settings/October2017/logo3.png',
                'details' => NULL,
                'type' => 'image',
                'order' => 4,
                'group' => 'Site',
            ),
            30 => 
            array (
                'id' => 33,
                'key' => 'post.header_html',
                'display_name' => 'Header HTML',
                'value' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header page-header-small clear-filter" filter-color="orange">
<div class="page-header-image" data-parallax="true" style="background-image: url(\'https://images.unsplash.com/photo-1493679349286-c570804c71ec?dpr=1&auto=compress,format&fit=crop&w=2851&h=&q=80&cs=tinysrgb&crop=\');">
</div>
<div class="container">
<div class="content-center">
<div id="articles">
<todo-item
v-for="item in items"
v-bind:todo="item"
v-bind:key="item.id"
v-bind:href="item.slug">
</todo-item>
</div>
</div>
</div>
</div>
</div>
<div class="section" style="padding-top:25px;margin-top:-75px !important;background:none;">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<div id="articles" class="card-deck">
<div class="col-md-12" href="/content/post-with-video-2"><div class="card" style="box-shadow:0px -60px 60px rgba(0,0,0,0.2);"><div class="card-body">',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 27,
                'group' => 'Post',
            ),
            31 => 
            array (
                'id' => 34,
                'key' => 'help.footer_html',
                'display_name' => 'Footer HTML',
                'value' => '</body>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 28,
                'group' => 'Help',
            ),
            32 => 
            array (
                'id' => 35,
                'key' => 'search.header_html',
                'display_name' => 'Header HTML',
                'value' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header page-header-small clear-filter" filter-color="black">
<div class="page-header-image" data-parallax="true" style="background-color:#222;">
</div>
<div class="container">
<div class="content-center" style="top:200px !important;">
<h1 class="title text-center">Search Results</h1>
<div class="form-group" style="padding:0px 15%;">
<form method="get" enctype="multipart/form-data" action="">
<input type="text" id="s" name="s" class="form-control" placeholder="Search for..." aria-label="Search for...">                     
</form>
</div>
</div>
</div>
</div>
</div>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 29,
                'group' => 'Search',
            ),
            33 => 
            array (
                'id' => 36,
                'key' => 'search.footer_html',
                'display_name' => 'Footer HTML',
                'value' => '</body>',
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 30,
                'group' => 'Search',
            ),
            34 => 
            array (
                'id' => 37,
                'key' => 'post.footer_html',
                'display_name' => 'Footer HTML',
                'value' => '</div>  
</div>
</div>
</div>
</div>
</div>
<script>
var slug = /[^/]*$/.exec(window.location)[0];
Vue.component(\'todo-item\', {
props: [\'todo\'],
template: \'<div style="margin-top:100px;"><h1>{{ todo.title }}</h1><h4>{{ todo.meta_description }}</h4></div>\'
});
console.log(slug);
var app7 = new Vue({
el: \'#articles\',
data: {
items: null
},
created: function () {
var _this = this;
$.getJSON(\'/api/item?type=posts&slug=\' + slug, function (json) {
_this.items = json;
});
}
});

</script>
</div>
</body>',
            'details' => NULL,
            'type' => 'code_editor',
            'order' => 31,
            'group' => 'Post',
        ),
    ));
        
        
    }
}