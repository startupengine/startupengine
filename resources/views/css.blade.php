<?php
$brandColor = setting('site.brandColor', '#4169E1');
$primaryColor = setting('site.$primaryColor');
$secondaryColor = setting('site.$secondaryColor');
?>

.btn-primary {
    background: {{ $brandColor }};
}

.btn-outline-primary {
    border-color: {{ $brandColor }};
    color: {{ $brandColor }};
}

h1::after, h2::after, h3::after {
    background: {{ $brandColor }};
}