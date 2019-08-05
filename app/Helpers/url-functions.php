<?php

function appUrl($string = '')
{
    if (config('app.env') == 'production') {
        $url = secure_url($string);
    } else {
        $url = url($string);
    }
    return $url;
}
