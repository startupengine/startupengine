<?php

use \App\Setting;

function setting($str)
{
    $setting = Setting::where('key', '=', $str)->first();
    if($setting !== null){
        $output = $setting->value;
    }
    else {
        $output = null;
    }
    return $output;
}