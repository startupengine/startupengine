<!-- Semantic UI Components-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.js"></script>
<script>
    $( document ).ready(function() {
        $(".showMobileNav").click(function () {
            $('#mobileNav')
                .modal('show');
            console.log('Clicked');
        });
    });
</script>