<?php

function setting($key)
{
    $setting = \App\Setting::where('key', '=', $key)->first();
    if($setting !== null){
        $output = $setting->value;
    }
    else {
        $output = null;
    }
    return $output;
}

function button($path, $text, $type = null, $classes = null, $iconmarkup = null)
{
    if($type == 'new') {
        $classes = $classes." btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-plus\"></i>";
    }
    if($type == 'edit') {
        $classes = $classes." btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = null;
    }
    $output = "<a href='$path' class='$classes'>".ucwords($text)." $iconmarkup</a>";
    return $output;
}