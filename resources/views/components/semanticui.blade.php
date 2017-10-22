<!-- Semantic UI Components-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
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