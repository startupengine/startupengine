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

function button($path, $text, $type = null, $classes = null, $iconmarkup = null, $data = null, $element = null)
{
    if($type == 'new') {
        $classes = $classes." btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-plus-square-o\"></i>";
    }
    if($type == 'edit') {
        $classes = $classes." btn btn-sm btn-round btn-secondary-outline ";
        $iconmarkup = "&nbsp; <i class=\"fa fa-sm fa-edit\"></i>";
    }
    if($element == null) {
        $element = 'a';
    }

    if($path !== null) {
        $path = "href=\"$path\"";
    }

    if($element == 'button') {
        $elementMarkup = 'type="button"';
    }
    else {
        $elementMarkup = null;
    }

    $output = "<$element $elementMarkup $path class='$classes' $data>".ucwords($text)." $iconmarkup</$element>";
    return $output;
}