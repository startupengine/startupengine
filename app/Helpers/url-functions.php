<?php

function appUrl()
{
    if (config('app.env') == 'production') {
        $url = secure_url('/');
    } else {
        $url = url('/');
    }
    return $url;
}
