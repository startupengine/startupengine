<!-- UX -->
<script type="text/javascript">
    function scrollToMore() {
        if ($('#more').length != 0) {
            $("html, body").animate({
                scrollTop: $('#more').offset().top - 75
            }, 500);
        }
    }

    $(document).ready(function () {

    });
</script>

<!-- Mixpanel -->
<script type="text/javascript">
    (function (e, a) {
        if (!a.__SV) {
            var b = window;
            try {
                var c, l, i, j = b.location, g = j.hash;
                c = function (a, b) {
                    return (l = a.match(RegExp(b + "=([^&]*)"))) ? l[1] : null
                };
                g && c(g, "state") && (i = JSON.parse(decodeURIComponent(c(g, "state"))), "mpeditor" === i.action && (b.sessionStorage.setItem("_mpcehash", g), history.replaceState(i.desiredHash || "", e.title, j.pathname + j.search)))
            } catch (m) {
            }
            var k, h;
            window.mixpanel = a;
            a._i = [];
            a.init = function (b, c, f) {
                function e(b, a) {
                    var c = a.split(".");
                    2 == c.length && (b = b[c[0]], a = c[1]);
                    b[a] = function () {
                        b.push([a].concat(Array.prototype.slice.call(arguments,
                            0)))
                    }
                }

                var d = a;
                "undefined" !== typeof f ? d = a[f] = [] : f = "mixpanel";
                d.people = d.people || [];
                d.toString = function (b) {
                    var a = "mixpanel";
                    "mixpanel" !== f && (a += "." + f);
                    b || (a += " (stub)");
                    return a
                };
                d.people.toString = function () {
                    return d.toString(1) + ".people (stub)"
                };
                k = "disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
                for (h = 0; h < k.length; h++)e(d, k[h]);
                a._i.push([b, c, f])
            };
            a.__SV = 1.2;
            b = e.createElement("script");
            b.type = "text/javascript";
            b.async = !0;
            b.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === e.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
            c = e.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(b, c)
        }
    })(document, window.mixpanel || []);
    mixpanel.init("c3af8ab4b008e22adf4772978aca66ec");

    function clickEvent(id, name, title, url, type, src, text) {
        mixpanel.track("click", {
            "id": id,
            "name": name,
            "title": title,
            "url": url,
            "type": type,
            "src": src,
            "text": text
        });
    }

    $(document).ready(function () {
        $("a, button, .btn, input, img").click(function () {
            var id = $(this).attr('id');
            var name = $(this).attr('name');
            var title = $(this).attr('title');
            var url = $(this).attr('href');
            var type = $(this).attr('type');
            var src = $(this).attr('src');
            var text = $(this).html();
            clickEvent(id, name, title, url, type, src, text);
        });
    });

</script>

<?php /*
<!-- Vue -->
<script src="https://unpkg.com/vue"></script>
 */ ?>

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

<!--  App -->
<script src="/js/app.js"></script>