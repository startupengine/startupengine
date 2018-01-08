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

function button($path, $text, $type = null, $classes = null)
{
    if($type == null OR $type == 'new' OR $classes == null) {
        $classes = $classes." btn btn-sm btn-secondary-outline ";
    }
    $output = "<a href='$path' class='$classes'>".ucwords($text)."</a>";
    return $output;
}