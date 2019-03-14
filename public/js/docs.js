// Anonymous "self-invoking" function
(function() {
    var startingTime = new Date().getTime();
    // Load the script
    var script = document.createElement("SCRIPT");
    script.src = 'https://code.jquery.com/jquery-3.3.1.min.js';
    script.type = 'text/javascript';
    document.getElementsByTagName("head")[0].appendChild(script);

    // Poll for jQuery to come into existance
    var checkReady = function(callback) {
        if (window.jQuery) {
            callback(jQuery);
        }
        else {
            window.setTimeout(function() { checkReady(callback); }, 20);
        }
    };

    // Start polling...
    checkReady(function($) {
        $(function() {
            var endingTime = new Date().getTime();
            var tookTime = endingTime - startingTime;
            //window.alert("jQuery is loaded, after " + tookTime + " milliseconds!");
            $( document ).ready(function() {



                $('a').each(function() {
                    var a = new RegExp('/' + window.location.host + '/');
                    if(!a.test(this.href)) {
                        $(this).click(function(event) {
                            event.preventDefault();
                            event.stopPropagation();
                            window.open(this.href, '_blank');
                        });
                    }
                });
                $( ".sidebar > ul:first-of-type" ).clone().appendTo( ".navbar .navbar-collapse" );
                $(".article > ul:first-of-type").addClass('scrollSpyNav');
                $(".scrollSpyNav").addClass('nav');
                $(".scrollSpyNav").attr('id', 'scrollSpyNav');
                $( "<div id='navContainer'></div>" ).insertBefore( "#scrollSpyNav" );
                $( "<ul id='dummyNav'></ul>" ).insertBefore( "#scrollSpyNav" );
                $("#scrollSpyNav").appendTo("#navContainer");
                $(".scrollSpyNav").addClass('flex-column');
                $(".scrollSpyNav li").addClass('nav-item');
                $(".scrollSpyNav li a").addClass('nav-link');
                //$( "#scrollSpyNav li:first-of-type" ).addClass('active');




                $('#repository_button').append(' Source Code');



                var next = $('.is-active').next('li').children('a').attr('href');
                var nextText = $('.is-active').next('li').children('a').html();
                //alert(next);

                var prev = $('.is-active').prev('li').children('a').attr('href');
                var prevText = $('.is-active').prev('li').children('a').html();
                //alert(prev);

                $('.article').append('<div class="col-md-12" id="prevNextNav" align="center" style="padding:25px;"></div>');

                if(prev != '' && prev != null){
                    $("#prevNextNav").append('<a href="' + prev + '" class="btn btn-outline-primary btn-block btn-prev">&larr; '+ prevText +'</a>');
                }

                if(next != '' && next != null){
                    $("#prevNextNav").append('<a href="' + next + '" class="btn btn-outline-primary btn-block btn-next pull-right">'+ nextText +' &rarr; </a>');
                }

                $( ".custom-toggle" ).click(function() {
                    $('.sidebar').toggleClass('is-hidden');
                    $('.article').toggleClass('expanded');
                    if($(this).prev('input').prop('checked') == true) {
                        $(this).prev('input').prop('checked', false);
                    } else {
                        $(this).prev('input').prop('checked', true);
                    }
                });
                var width = $( window ).width();
                if(width < 720){
                    $('.sidebar').addClass('is-hidden');
                    $('.article').addClass('expanded');
                    $('.custom-toggle input').prop('checked', false);
                }

                $(".sidebar ul > li > ul").hide();
                $(".sidebar .is-active").parent('ul').show();
                $(".sidebar .is-active").parent('ul').prev('h2').addClass('active-category');
                $("body").animate({
                    opacity:1
                }, 250, function() {
                    $(".navbar > .container-fluid").animate({
                        opacity:1
                    }, 500, function() {
                        // Animation complete.
                        !function(t,e){t.fn.extend({scrollspy:function(n){var a={namespace:"scrollspy",activeClass:"active",animate:!1,offset:0,container:e};n=t.extend({},a,n);var o=function(t,e){return parseInt(t,10)+parseInt(e,10)},r=function(e){for(var n=[],a=0;a<e.length;a++){var o=e[a],r=t(o).attr("href"),f=t(r);if(f.length>0){var s=Math.floor(f.offset().top),i=s+Math.floor(f.outerHeight());n.push({element:f,hash:r,top:s,bottom:i})}}return n},f=function(e,n){for(var a=0;a<e.length;a++){var o=t(e[a]);if(o.attr("href")===n)return o}},s=function(e){for(var a=0;a<e.length;a++){var o=t(e[a]);o.parent().removeClass(n.activeClass)}};return this.each(function(){for(var a=this,i=t(n.container),l=t(a).find("a"),c=0;c<l.length;c++){var h=l[c];t(h).on("click",function(a){var r=t(this).attr("href"),f=t(r);if(f.length>0){var s=o(f.offset().top,n.offset);n.animate?t("html, body").animate({scrollTop:s},1e3):e.scrollTo(0,s),a.preventDefault()}})}var v=r(l);i.bind("scroll."+n.namespace,function(){for(var e,r={top:o(t(this).scrollTop(),Math.abs(n.offset)),left:t(this).scrollLeft()},i=0;i<v.length;i++){var c=v[i];if(r.top>=c.top&&r.top<c.bottom){var h=c.hash;if(e=f(l,h)){n.onChange&&n.onChange(c.element,t(a),r),s(l),e.parent().addClass(n.activeClass);break}}}!e&&n.onExit&&n.onExit(t(a),r)})})}})}(jQuery,window,document,void 0);
                        $("#navContainer").scrollspy({ offset: -100 });

                    });
                });

                $( "#scrollSpyNav li" ).click(function() {
                    $('#scrollSpyNav li').removeClass('active');
                    $(this).addClass('active');
                });

                $( ".sidebar h2" ).click(function() {
                    $('.sidebar ul > li > ul').hide();
                    $('.sidebar h2').removeClass('active-category');
                    $(this).addClass('active-category');
                    $(this).next('ul').slideToggle();
                });


                $( ".navbar-collapse h2" ).click(function() {
                    $('.sidebar ul > li > ul').hide();
                    $('.sidebar h2').removeClass('active-category');
                    $(this).addClass('active-category');
                    $(this).next('ul').slideToggle();
                });
            });
        });
    });
})();