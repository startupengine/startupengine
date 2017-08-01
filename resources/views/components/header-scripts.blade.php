<?php if($defaults !== NULL && $defaults->getHeaderCode() !== NULL) {
    echo $defaults->getHeaderCode();
 }?>

<?php if(env('ENABLE_MIXPANEL_ANALYTICS') == TRUE) { ?>
<!-- start Mixpanel -->
<script type="text/javascript">
    (function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
        0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
        for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
    mixpanel.init("<?php echo env('MIXPANEL_ID'); ?>");

    <?php if(\Auth::user()) { ?>
        mixpanel.identify("<?php echo \Auth::user()->id; ?>");
        mixpanel.people.set({
            "$first_name": "<?php echo \Auth::user()->name; ?>",
            "$created": "<?php echo \Auth::user()->created_at; ?>",
            "$email": "<?php echo \Auth::user()->email; ?>",
            "$gender": "<?php echo \Auth::user()->gender; ?>"
        });
    <?php } ?>
    <?php if(isset($page) && isset($campaign)) { ?>
        mixpanel.track("Campaign", {
            "Campaign Title": '<?php echo $campaign->getTitle(); ?>',
            "Campaign Slug": '<?php echo $campaign->getSlug(); ?>',
    });
    <?php } ?>
    <?php if(isset($page)) { ?>
        mixpanel.track("Page View", {
            "Page Title": "<?php echo $page->getTitle(); ?>",
            "Page Slug": "<?php echo $page->getSlug(); ?>",
            "Page Type": "<?php echo $page->getType(); ?>"
    });
    <?php } ?>
    <?php if( isset($contentItem) && $contentItem->getEmotions() !== null) { ?>
        mixpanel.track("Emotion", {
            "Name": "Sadness",
            "Value": <?php echo $contentItem->getEmotions()['sadness']; ?>
        });
        mixpanel.track("Emotion", {
            "Name": "Joy",
            "Value": <?php echo $contentItem->getEmotions()['joy']; ?>
        });
        mixpanel.track("Emotion", {
            "Name": "Fear",
            "Value": <?php echo $contentItem->getEmotions()['fear']; ?>
        });
        mixpanel.track("Emotion", {
            "Name": "Disgust",
            "Value": <?php echo $contentItem->getEmotions()['disgust']; ?>
        });
        mixpanel.track("Emotion", {
            "Name": "Anger",
            "Value": <?php echo $contentItem->getEmotions()['anger']; ?>
        });
        mixpanel.track("Emotion", {
            "Dominant Emotion": "<?php echo (string) ucfirst($contentItem->getDominantEmotion()); ?>",
        });
    <?php } ?>
    <?php if( isset($contentItem) && $contentItem->getKeywords() !== null) { ?>
        <?php foreach($contentItem->getKeywords() as $keyword) { ?>
        mixpanel.track("Keywords", {
        "Word": "<?php echo urldecode($keyword->text); ?>",
        "Value": <?php echo $keyword->relevance * 100; ?>,
        });
        <?php } ?>
    <?php } ?>
    <?php if( isset($contentItem) && $contentItem->getConcepts() !== null) { ?>
        <?php foreach($contentItem->getConcepts() as $concept) { ?>
        mixpanel.track("Concepts", {
            "Concept": "<?php echo urldecode($concept->text); ?>",
            "Value": <?php echo $concept->relevance * 100; ?>,
        });
        <?php } ?>
    <?php } ?>
    <?php if( isset($contentItem) && $contentItem->getSentiment() !== null) { ?>
        mixpanel.track("Sentiment", {
            "Label": "<?php echo $contentItem->getSentiment()->label; ?>",
            "Value": <?php echo $contentItem->getSentiment()->score; ?>,
        });
    <?php } ?>
</script>
<!-- end Mixpanel -->
<?php } ?>