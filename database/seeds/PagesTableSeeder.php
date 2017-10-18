<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 2,
                'author_id' => 1,
                'title' => 'Home',
                'excerpt' => NULL,
                'body' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header clear-filter" filter-color="orange">
<div class="page-header-image" data-parallax="true" style="background-image: url(\'https://images.unsplash.com/photo-1450149632596-3ef25a62011a?dpr=1&auto=compress,format&fit=crop&w=2816&h=&q=80&cs=tinysrgb&crop=\');">
</div>
<div class="container">
<div class="content-center brand">
<img class="n-logo" src="https://psychoanalytics.s3-us-west-1.amazonaws.com/settings/October2017/logo1.png" alt="" style="margin-bottom:25px;max-width:75px;">
<h1 class="h1-seo">Startup Engine</h1>
<h3>Beautiful, Open-Source, & Free <span style="display:inline-block">CMS for Startups</span></h3>
<a class="btn btn-neutral" href="/get-started">
Learn More
</a>
</div>
</div>
</div>
</div>
</body>',
                'type' => 'page',
                'css' => NULL,
                'scripts' => NULL,
                'image' => NULL,
                'slug' => 'home',
                'meta_description' => NULL,
                'meta_keywords' => NULL,
                'status' => 'ACTIVE',
                'created_at' => '2017-10-15 08:08:05',
                'updated_at' => '2017-10-16 05:46:05',
            ),
            1 => 
            array (
                'id' => 3,
                'author_id' => 1,
                'title' => 'Help',
                'excerpt' => NULL,
                'body' => '<div class="wrapper">
<div class="section" style="padding-top:25px;margin-top:-100px;background:none;">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

<div class="col-md-6" style="float:left;">
<div class="card">
<div class="card-body">
<h4 class="card-title">Frequently Asked Questions</h4>
<p class="card-text">What does Startup Engine do? How does it work? What does it cost?</p>
<a href="/browse?category=frequently-asked-questions" class="btn btn-info pull-right">View FAQs</a>
</div>
</div>
</div>

<div class="col-md-6" style="float:left;">
<div class="card">
<div class="card-body">
<h4 class="card-title">Tutorials</h4>
<p class="card-text">Learn the tricks of the trade to bootstrap your marketing.</p>
<a href="/browse?category=tutorials" class="btn btn-info pull-right">View Tutorials</a>
</div>
</div>
</div>
<div class="col-md-6" style="float:left;">
<div class="card">
<div class="card-body">
<h4 class="card-title">Articles</h4>
<p class="card-text">Insights and observations about the startup life.</p>
<a href="/articles" class="btn btn-info pull-right">View Articles</a>
</div>
</div>
</div>
<div class="col-md-6" style="float:left;">
<div class="card">
<div class="card-body">
<h4 class="card-title">Documentation</h4>
<p class="card-text">Technical information about the content API.</p>
<a href="/browse?category=documentation" class="btn btn-info pull-right">View Docs</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>',
                'type' => 'help',
                'css' => '<style>
.page-header-image{
background: #ff9966;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top right, #ff5e62, #ff9966); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
</style>',
                'scripts' => '<!-- Start of Async Drift Code -->
<script>
!function() {
var t;
if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void (window.console && console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0, 
t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
t.factory = function(e) {
return function() {
var n;
return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
};
}, t.methods.forEach(function(e) {
t[e] = t.factory(e);
}), t.load = function(t) {
var e, n, o, i;
e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"), 
o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + i + "/" + t + ".js", 
n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
});
}();
drift.SNIPPET_VERSION = \'0.3.1\';
drift.load(\'gd2u4pcakv8w\');
</script>
<!-- End of Async Drift Code -->',
            'image' => NULL,
            'slug' => 'help',
            'meta_description' => NULL,
            'meta_keywords' => NULL,
            'status' => 'ACTIVE',
            'created_at' => '2017-10-15 18:58:24',
            'updated_at' => '2017-10-17 08:25:27',
        ),
        2 => 
        array (
            'id' => 4,
            'author_id' => 1,
            'title' => 'Features',
            'excerpt' => NULL,
            'body' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header clear-filter" filter-color="black">
<div class="page-header-image" data-parallax="true" style="background-image: url(\'https://images.unsplash.com/photo-1437422061949-f6efbde0a471?dpr=1&auto=compress,format&fit=crop&w=2850&h=&q=80&cs=tinysrgb&crop=\');">
</div>
<div class="container">
<div class="content-center brand">
<h1 class="h1-seo">Features</h1>
<h3>Custom CMS, A/B Testing, Integrated Analytics & More</h3>
<a class="btn btn-neutral" href="/get-started">
Learn More
</a>
</div>
</div>
</div>
</div>
</body>',
            'type' => 'page',
            'css' => NULL,
            'scripts' => NULL,
            'image' => NULL,
            'slug' => 'features',
            'meta_description' => NULL,
            'meta_keywords' => NULL,
            'status' => 'INACTIVE',
            'created_at' => '2017-10-15 22:24:01',
            'updated_at' => '2017-10-17 03:14:27',
        ),
        3 => 
        array (
            'id' => 5,
            'author_id' => 1,
            'title' => 'Articles',
            'excerpt' => NULL,
            'body' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header page-header-small clear-filter" filter-color="black">
<div class="page-header-image" data-parallax="true" style="background-image:url(\'https://images.unsplash.com/photo-1501954378833-0ee4020fd660?dpr=1&auto=compress,format&fit=crop&w=2978&h=&q=80&cs=tinysrgb&crop=\');">
</div>
<div class="container">
<div class="content-center" style="top:200px !important;">
<h1 class="title text-center" style="padding-bottom: 25px;border-bottom: #fff solid 5px;">The Launchpad</h1>
<h4 class="title text-center">A blog about starting up & taking off</h5>
</div>
</div>
</div>
</div>
<div class="wrapper">
<div class="section" style="padding-top:25px;margin-top:-100px !important;background:none;">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<div id="articles" class="card-deck">
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
</div>
</body>',
            'type' => 'page',
            'css' => '<style>
.card-link:hover {
text-decoration:none !important;
}
.card-text  {
color:#666;
}
.card-title {
color:#111 !important;
}
.card-footer {
color:#2CA8FF !important;
}
</style>',
            'scripts' => '<script>
Vue.component(\'todo-item\', {
props: [\'todo\'],
template: \'<div class="col-sm-4"><a class="card-link" v-bind:href="todo.slug"><div class="card"><img class="card-img-top" v-bind:src="todo.image"><div class="card-body"><h4 class="card-title" align="center">{{ todo.title }}</h4><p class="card-text">{{ todo.meta_description }}</p></div><div class="card-footer" align="center">Read More</div></div></a></div>\'
});
var app7 = new Vue({
el: \'#articles\',
data: {
items: null
},
created: function () {
var _this = this;
$.getJSON(\'/api/items?type=posts&limit=10\', function (json) {
_this.items = json;
});
}

});
</script>',
        'image' => NULL,
        'slug' => 'articles',
        'meta_description' => NULL,
        'meta_keywords' => NULL,
        'status' => 'INACTIVE',
        'created_at' => '2017-10-15 22:38:47',
        'updated_at' => '2017-10-17 03:11:41',
    ),
    4 => 
    array (
        'id' => 6,
        'author_id' => 1,
        'title' => 'Search',
        'excerpt' => NULL,
        'body' => '<div class="wrapper">
<div class="section" style="padding-top:25px;margin-top:-100px;background:none;">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<div id="articles" class="card-deck">
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
</div>',
        'type' => 'search',
        'css' => '<style>
.page-header-image{
background: #ff9966;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top right, #ff5e62, #ff9966); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
</style>',
        'scripts' => '<script>
var url_string = window.location;
var url = new URL(url_string);
var input = url.searchParams.get("s");
Vue.component(\'todo-item\', {
props: [\'todo\'],
template: \'<div class="col-md-6" style="float:left;"><div class="card"><div class="card-body"><h4 class="card-title">{{ todo.title }}</h4><p class="card-text">{{ todo.meta_description }}</p><a href="/category/tutorials" class="btn btn-info pull-right">View Tutorials</a></div></div></div>\'
});
var app7 = new Vue({
el: \'#articles\',
data: {
items: null
},
created: function () {
var _this = this;
$.getJSON(\'/api/search?type=posts&s=\' + input, function (json) {
_this.items = json;
});
}

});
</script>',
    'image' => NULL,
    'slug' => 'search',
    'meta_description' => NULL,
    'meta_keywords' => NULL,
    'status' => 'INACTIVE',
    'created_at' => '2017-10-15 23:55:56',
    'updated_at' => '2017-10-16 11:14:14',
),
5 => 
array (
    'id' => 7,
    'author_id' => 1,
    'title' => 'Browse',
    'excerpt' => NULL,
    'body' => '<body class="index-page sidebar-collapse">
<div id="startup_engine_nav_container"></div>
<div class="wrapper">
<div class="page-header page-header-small clear-filter" filter-color="black">
<div class="page-header-image" data-parallax="true" style="background-image:url(\'https://images.unsplash.com/photo-1501954378833-0ee4020fd660?dpr=1&auto=compress,format&fit=crop&w=2978&h=&q=80&cs=tinysrgb&crop=\');">
</div>
<div class="container">
<div class="content-center" style="top:200px !important;">
<div id="heading">
<category
v-for="item in categories"
v-bind:category="item"
v-bind:key="item.id">
</category>
</div>
</div>
</div>
</div>
</div>
<div class="wrapper">
<div class="section" style="padding-top:25px;margin-top:-100px !important;background:none;">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">
<div id="articles" class="card-deck">
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
</div>
</body>',
    'type' => 'page',
    'css' => '<style>
.card-link:hover {
text-decoration:none !important;
}
.card-text  {
color:#666;
}
.card-title {
color:#111 !important;
}
.card-footer {
color:#2CA8FF !important;
}
.page-header-image {
background: #ff9966 !important;
background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966) !important;
background: linear-gradient(to top right, #ff5e62, #ff9966) !important;
}
</style>',
    'scripts' => '<script>
var url_string = window.location;
var url = new URL(url_string);
var input = url.searchParams.get("category");
console.log(input);
Vue.component(\'todo-item\', {
props: [\'todo\'],
template: \'<div class="col-sm-4"><a class="card-link" v-bind:href="todo.slug"><div class="card"><img class="card-img-top" v-bind:src="todo.image"><div class="card-body"><h4 class="card-title" align="center">{{ todo.title }}</h4><p class="card-text">{{ todo.meta_description }}</p></div><div class="card-footer" align="center">Read More</div></div></a></div>\'
});
Vue.component(\'category\', {
props: [\'category\'],
template: \'<div><h1 class="title">{{ category.name }}</h1><h4 class="title">{{ category.description }}</h4></div>\'
});
var heading = new Vue({
el: \'#heading\',
data: {
categories: null
},
created: function () {
var _this = this;
$.getJSON(\'/api/item?type=categories&slug=\' + input, function (json) {
_this.categories = json;
});
}
});            
var articles = new Vue({
el: \'#articles\',
data: {
items: null
},
created: function () {
var _this = this;
$.getJSON(\'/api/browse?type=posts&category=\' + input, function (json) {
_this.items = json;
});
}
});
</script>',
'image' => NULL,
'slug' => 'browse',
'meta_description' => NULL,
'meta_keywords' => NULL,
'status' => 'INACTIVE',
'created_at' => '2017-10-15 22:38:47',
'updated_at' => '2017-10-17 20:02:55',
),
));
        
        
    }
}